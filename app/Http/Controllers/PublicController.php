<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\TeamMember;
use App\Models\Event;
use App\Models\Review;
use Illuminate\Validation\Rules\Password;

class PublicController extends Controller
{
    public function home()
    {
        $teamMembers = TeamMember::orderBy('created_at', 'desc')->get();
        return view('public.home', compact('teamMembers'));
    }

    public function about()
    {
        $teamMembers = TeamMember::orderBy('created_at', 'desc')->get();
        return view('public.about', compact('teamMembers'));
    }

    public function login()
    {
        $districts = \App\Models\District::orderBy('name')->get();
        return view('public.login', compact('districts'));
    }

    public function loginSubmit(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
        ]);

        $user = User::where('phone', $request->phone)->first();

        if ($user) {
            Auth::login($user);

            if ($user->is_admin) {
                return redirect()->route('admin.dashboard');
            }

            $request->session()->regenerate();

            return redirect()->intended(route('public.event-selection'));
        }

        return back()->withErrors([
            'phone' => 'No account found with this phone number. Please register first.',
        ])->withInput($request->only('phone'));
    }

    public function registerSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:users',
            'event_date' => 'required|date|after:today',
            'district_id' => 'required|exists:districts,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => null,
            'is_admin' => false,
        ]);

        Event::create([
            'user_id' => $user->id,
            'event_date' => $request->event_date,
            'district_id' => $request->district_id,
            'status' => 'pending',
        ]);

        Auth::login($user);

        return redirect()->route('public.event-selection')->with('success', 'Account created successfully!');
    }

    public function privacy()
    {
        return view('public.privacy');
    }

    public function eventSelection()
    {
        $decorationItems = \App\Models\DecorationItem::with(['category', 'subcategory', 'eventTeams'])->get();
        $foodItems = \App\Models\FoodItem::with(['category', 'subcategory'])->get();
        $serviceItems = \App\Models\ServiceItem::with(['category', 'subcategory', 'eventTeams'])->get();

        $subcategories = \App\Models\Subcategory::with('category')->orderBy('name')->get();

        $categories = \App\Models\Category::orderBy('name')->get();

        $lastEstimation = null;
        if (Auth::check()) {
            $lastEstimation = \App\Models\EventEstimation::where('user_id', Auth::id())
                ->latest()
                ->first();
        }

        $seatings = \App\Models\Seating::with('images')->get();

        return view('public.event-selection', compact('decorationItems', 'foodItems', 'serviceItems', 'subcategories', 'categories', 'lastEstimation', 'seatings'));
    }

    public function reEstimate($id)
    {
        $user = Auth::user();
        $estimation = \App\Models\EventEstimation::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        $decorationItems = \App\Models\DecorationItem::with(['category', 'subcategory', 'eventTeams'])->get();
        $foodItems = \App\Models\FoodItem::with(['category', 'subcategory'])->get();
        $serviceItems = \App\Models\ServiceItem::with(['category', 'subcategory', 'eventTeams'])->get();

        $subcategories = \App\Models\Subcategory::with('category')->orderBy('name')->get();

        $categories = \App\Models\Category::orderBy('name')->get();

        \Log::channel('estimation')->info('Re-estimation accessed with detailed data', [
            'estimation_id' => $estimation->id,
            'user_id' => $user->id,
            'original_total_cost' => $estimation->total_cost,
            'original_guest_count' => $estimation->guest_count,
            'selected_items' => $estimation->selected_items,
            'selected_items_count' => count($estimation->selected_items ?? []),
            'decoration_items' => $estimation->decoration_items,
            'food_items' => $estimation->food_items,
            'service_items' => $estimation->service_items,
            'decoration_items_count' => $estimation->decoration_items_count,
            'food_items_count' => $estimation->food_items_count,
            'service_items_count' => $estimation->service_items_count
        ]);

        \Log::channel('estimation')->info('Estimation data for re-estimation', [
            'estimation_id' => $estimation->id,
            'selected_items_structure' => $estimation->selected_items,
            'selected_items_count' => count($estimation->selected_items ?? []),
            'first_item_example' => $estimation->selected_items[0] ?? 'No items'
        ]);

        $seatings = \App\Models\Seating::with('images')->get();

        return view('public.event-selection', compact('decorationItems', 'foodItems', 'serviceItems', 'subcategories', 'categories', 'estimation', 'seatings'));
    }

    public function storeEstimation(Request $request)
    {
        try {
            $request->validate([
                'selected_items' => 'required|string',
                'guest_count' => 'required|integer|min:1',
                'catering_boys' => 'nullable|boolean',
                'seating_id' => 'nullable|exists:seatings,id',
            ]);

            $user = Auth::user();
            $event = $user->events()->first();

            if (!$event) {
                return response()->json([
                    'success' => false,
                    'message' => 'No event found for this user. Please register first.'
                ], 400);
            }

            $selectedItems = json_decode($request->selected_items, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                \Log::channel('estimation')->error('JSON decode error', [
                    'user_id' => $user->id,
                    'json_error' => json_last_error_msg(),
                    'selected_items_raw' => $request->selected_items
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid selected items format.'
                ], 400);
            }

            \Log::channel('estimation')->info('Selected items with quantities', [
                'user_id' => $user->id,
                'selected_items' => $selectedItems,
                'guest_count' => $request->guest_count
            ]);

            if (!is_array($selectedItems) || empty($selectedItems)) {
                \Log::channel('estimation')->warning('No items selected', [
                    'user_id' => $user->id,
                    'selected_items' => $selectedItems
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'No items selected.'
                ], 400);
            }
            $guestCount = $request->guest_count;
            $cateringBoys = filter_var($request->catering_boys, FILTER_VALIDATE_BOOLEAN);

            $totalCost = 0;
            $foodCost = 0;
            $decorationCost = 0;
            $serviceCost = 0;
            $itemDetails = [];

            $decorationItems = [];
            $foodItems = [];
            $serviceItems = [];

            foreach ($selectedItems as $item) {
                $priceText = $item['price'];
                $price = 0;
                $category = $item['category'];
                $quantity = isset($item['quantity']) ? (int) $item['quantity'] : 1;

                if (strpos($priceText, '/person') !== false) {
                    $price = (float) str_replace(['₹', ',', '/person'], '', $priceText) * $guestCount;
                    $foodCost += $price;

                    $foodItem = \App\Models\FoodItem::find($item['id']);
                    $foodItems[] = [
                        'id' => $item['id'],
                        'title' => $item['title'],
                        'price_per_person' => $priceText,
                        'calculated_price' => $price,
                        'guest_count' => $guestCount,
                        'quantity' => 1,
                        'category' => $category,
                        'image' => $foodItem ? $foodItem->image : null
                    ];
                } else {
                    $unitPrice = (float) str_replace(['₹', ','], '', $priceText);
                    $price = $unitPrice * $quantity;

                    if ($category === 'decoration') {
                        $decorationCost += $price;

                        $decorationItem = \App\Models\DecorationItem::find($item['id']);
                        $decorationItems[] = [
                            'id' => $item['id'],
                            'title' => $item['title'],
                            'fixed_price' => $priceText,
                            'unit_price' => $unitPrice,
                            'quantity' => $quantity,
                            'calculated_price' => $price,
                            'category' => $category,
                            'image' => $decorationItem ? $decorationItem->image : null
                        ];
                    } elseif ($category === 'service') {
                        $serviceCost += $price;

                        $serviceItem = \App\Models\ServiceItem::find($item['id']);
                        $serviceItems[] = [
                            'id' => $item['id'],
                            'title' => $item['title'],
                            'fixed_price' => $priceText,
                            'unit_price' => $unitPrice,
                            'quantity' => $quantity,
                            'calculated_price' => $price,
                            'category' => $category,
                            'image' => $serviceItem ? $serviceItem->image : null
                        ];
                    }
                }

                $totalCost += $price;

                $itemImage = null;
                if ($category === 'decoration') {
                    $decorationItem = \App\Models\DecorationItem::find($item['id']);
                    $itemImage = $decorationItem ? $decorationItem->image : null;
                } elseif ($category === 'food') {
                    $foodItem = \App\Models\FoodItem::find($item['id']);
                    $itemImage = $foodItem ? $foodItem->image : null;
                } elseif ($category === 'service') {
                    $serviceItem = \App\Models\ServiceItem::find($item['id']);
                    $itemImage = $serviceItem ? $serviceItem->image : null;
                }

                $itemDetails[] = [
                    'id' => $item['id'],
                    'title' => $item['title'],
                    'category' => $category,
                    'price_per_unit' => $priceText,
                    'calculated_price' => $price,
                    'quantity' => $category === 'food' ? $guestCount : $quantity,
                    'image' => $itemImage
                ];
            }

            $cateringBoysCost = 0;
            $seatingId = null;

            if ($cateringBoys) {
                if ($request->seating_id) {
                    $seating = \App\Models\Seating::find($request->seating_id);
                    if ($seating) {
                        $cateringBoysCost = $guestCount * $seating->catering_boy_per_head;
                        $seatingId = $seating->id;
                    } else {
                        $cateringBoysCost = $guestCount * 200;
                    }
                } else {
                     $cateringBoysCost = $guestCount * 200;
                }
                $totalCost += $cateringBoysCost;
            }

            $estimation = \App\Models\EventEstimation::create([
                'user_id' => $user->id,
                'event_id' => $event->id,
                'guest_count' => $guestCount,
                'catering_boys' => $cateringBoys,
                'seating_id' => $seatingId,
                'selected_items' => $selectedItems,
                'item_details' => $itemDetails,
                'total_cost' => $totalCost,
                'food_cost' => $foodCost,
                'decoration_cost' => $decorationCost,
                'service_cost' => $serviceCost,
                'catering_boys_cost' => $cateringBoysCost,

                'decoration_items' => $decorationItems,
                'food_items' => $foodItems,
                'service_items' => $serviceItems,

                'decoration_items_count' => count($decorationItems),
                'food_items_count' => count($foodItems),
                'service_items_count' => count($serviceItems),

                'decoration_items_cost' => $decorationCost,
                'food_items_cost' => $foodCost,
                'service_items_cost' => $serviceCost,
            ]);

            \Log::channel('estimation')->info('Estimation created successfully with detailed data', [
                'estimation_id' => $estimation->id,
                'user_id' => $user->id,
                'event_id' => $event->id,
                'guest_count' => $guestCount,
                'total_cost' => $totalCost,
                'items_count' => count($selectedItems),
                'decoration_items_count' => count($decorationItems),
                'food_items_count' => count($foodItems),
                'service_items_count' => count($serviceItems),
                'decoration_items' => $decorationItems,
                'food_items' => $foodItems,
                'service_items' => $serviceItems
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Estimation saved successfully!',
                'redirect_url' => route('public.estimation-result', $estimation->id),
                'estimation' => [
                    'id' => $estimation->id,
                    'total_cost' => number_format($totalCost, 2),
                    'guest_count' => $guestCount,
                    'food_cost' => number_format($foodCost, 2),
                    'decoration_cost' => number_format($decorationCost, 2),
                    'service_cost' => number_format($serviceCost, 2),
                    'catering_boys_cost' => number_format($cateringBoysCost, 2),
                    'item_details' => $itemDetails
                ]
            ]);
        } catch (\Exception $e) {
            \Log::channel('estimation')->error('Estimation error: ' . $e->getMessage(), [
                'user_id' => $user->id ?? null,
                'request_data' => $request->all(),
                'exception' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your estimation. Please try again.'
            ], 500);
        }
    }

    public function estimationResult($id)
    {
        $user = Auth::user();
        $estimation = \App\Models\EventEstimation::where('id', $id)
            ->where('user_id', $user->id)
            ->with('event')
            ->firstOrFail();

        return view('public.estimation-result', compact('estimation'));
    }

    public function lastEstimationResult()
    {
        $user = Auth::user();
        $estimation = \App\Models\EventEstimation::where('user_id', $user->id)
            ->with('event')
            ->latest()
            ->first();

        if (!$estimation) {
            return redirect()->route('public.event-selection')->with('error', 'No estimation found. Please create an estimation first.');
        }

        return redirect()->route('public.estimation-result', $estimation->id);
    }

    public function myProfile()
    {
        $user = Auth::user();
        $estimations = \App\Models\EventEstimation::where('user_id', $user->id)
            ->with('event')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $userReview = $user->review;

        return view('public.my-profile', compact('user', 'estimations', 'userReview'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('public.edit-profile', compact('user'));
    }

    public function storeReview(Request $request)
    {
        $user = Auth::user();

        if ($user->review) {
            return redirect()->route('public.my-profile')
                ->with('error', 'You have already submitted a review.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'user_id' => $user->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('public.my-profile')
            ->with('success', 'Thank you for your review!');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture && file_exists(public_path('storage/' . $user->profile_picture))) {
                unlink(public_path('storage/' . $user->profile_picture));
            }

            $file = $request->file('profile_picture');
            $filename = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('profile-pictures', $filename, 'public');
            $user->profile_picture = $path;
        }

        $user->save();

        return redirect()->route('public.my-profile')->with('success', 'Profile updated successfully!');
    }

    public function estimationHistory()
    {
        $user = Auth::user();
        $estimations = \App\Models\EventEstimation::where('user_id', $user->id)
            ->with('event')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('public.estimation-history', compact('estimations'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('public.home');
    }
}
