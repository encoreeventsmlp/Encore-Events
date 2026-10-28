<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\EventTeamController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DecorationItemController;
use App\Http\Controllers\Admin\ServiceItemController;
use App\Http\Controllers\Admin\FoodItemController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\GlobalSearchController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ReportController;

Route::prefix('')->name('public.')->group(function () {
    Route::get('/', [PublicController::class, 'home'])->name('home');
    Route::get('/about', [PublicController::class, 'about'])->name('about');
    Route::get('/login', [PublicController::class, 'login'])->name('login');
    Route::post('/login', [PublicController::class, 'loginSubmit'])->name('login.submit');
    Route::post('/register', [PublicController::class, 'registerSubmit'])->name('register.submit');
    Route::get('/privacy-policy', [PublicController::class, 'privacy'])->name('privacy');
    Route::post('/logout', [PublicController::class, 'logout'])->name('logout');

    // Authenticated routes
    Route::middleware(['auth'])->group(function () {
        Route::get('/event-selection', [PublicController::class, 'eventSelection'])->name('event-selection');
        Route::get('/event-selection/re-estimate/{id}', [PublicController::class, 'reEstimate'])->name('event-selection.re-estimate');
        Route::post('/event-selection/estimate', [PublicController::class, 'storeEstimation'])->name('event-selection.estimate');
        Route::get('/estimation-result/{id}', [PublicController::class, 'estimationResult'])->name('estimation-result');
        Route::get('/estimation-result', [PublicController::class, 'lastEstimationResult'])->name('estimation-result.last');
        Route::get('/my-profile', [PublicController::class, 'myProfile'])->name('my-profile');
        Route::get('/my-profile/edit', [PublicController::class, 'editProfile'])->name('my-profile.edit');
        Route::post('/my-profile/update', [PublicController::class, 'updateProfile'])->name('my-profile.update');
        Route::post('/my-profile/review', [PublicController::class, 'storeReview'])->name('my-profile.review');
        Route::get('/event-selection/history', [PublicController::class, 'estimationHistory'])->name('event-selection.history');
    });
});

Route::get('/sitemap.xml', function () {
    $urls = [
        route('public.home'),
        route('public.about'),
        route('public.login'),
        route('public.privacy'),
    ];

    return response()->view('public.sitemap', [
        'urls' => $urls,
        'lastmod' => now()->toAtomString(),
    ])->header('Content-Type', 'application/xml');
})->name('sitemap');

Route::get('/home', [HomeController::class, 'index'])->name('home.legacy');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::get('/search', [GlobalSearchController::class, 'search'])->name('search');

        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile/picture', [ProfileController::class, 'removeProfilePicture'])->name('profile.remove-picture');

        Route::resource('event-teams', EventTeamController::class);
        Route::post('event-teams/{id}/restore', [EventTeamController::class, 'restore'])->name('event-teams.restore');

        Route::resource('categories', CategoryController::class);
        Route::post('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');

        Route::resource('subcategories', SubcategoryController::class);
        Route::post('subcategories/{id}/restore', [SubcategoryController::class, 'restore'])->name('subcategories.restore');
        Route::get('subcategories/by-category/{categoryId}', [SubcategoryController::class, 'getByCategory'])->name('subcategories.by-category');
        Route::resource('decoration-items', DecorationItemController::class);
        Route::post('decoration-items/{id}/restore', [DecorationItemController::class, 'restore'])->name('decoration-items.restore');

        Route::resource('service-items', ServiceItemController::class);
        Route::post('service-items/{id}/restore', [ServiceItemController::class, 'restore'])->name('service-items.restore');

        Route::resource('food-items', FoodItemController::class);
        Route::post('food-items/{id}/restore', [FoodItemController::class, 'restore'])->name('food-items.restore');

        Route::resource('settings', SettingController::class);
        Route::post('settings/bulk-update', [SettingController::class, 'bulkUpdate'])->name('settings.bulk-update');

        Route::resource('team-members', TeamMemberController::class);
        Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
        Route::get('/clients/{id}', [ClientController::class, 'show'])->name('clients.show');

        Route::get('/estimations/{id}', [ClientController::class, 'showEstimation'])->name('estimations.show');

        Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
        Route::get('/reviews/{review}', [ReviewController::class, 'show'])->name('reviews.show');
        Route::post('/reviews/{review}/approve', [ReviewController::class, 'approve'])->name('reviews.approve');
        Route::post('/reviews/{review}/reject', [ReviewController::class, 'reject'])->name('reviews.reject');
        Route::post('/reviews/{review}/reset', [ReviewController::class, 'reset'])->name('reviews.reset');
        Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

        Route::resource('galleries', GalleryController::class);
        Route::post('galleries/update-order', [GalleryController::class, 'updateOrder'])->name('galleries.update-order');

        Route::get('/reports/estimations', [ReportController::class, 'estimationReport'])->name('reports.estimations');
        Route::resource('seatings', \App\Http\Controllers\Admin\SeatingController::class);
        Route::delete('seatings/image/{id}', [\App\Http\Controllers\Admin\SeatingController::class, 'destroyImage'])->name('seatings.image.destroy');
    });
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return 'Cache cleared!';
});
