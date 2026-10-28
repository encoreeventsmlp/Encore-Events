<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TeamMember;
use Illuminate\Support\Facades\Storage;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the existing team member photo to copy
        $existingMember = TeamMember::whereNotNull('photo')->first();
        $sourcePhoto = null;
        
        if ($existingMember && $existingMember->photo) {
            $sourcePhoto = $existingMember->photo;
        }

        $teamMembers = [
            [
                'name' => 'Sarah Johnson',
                'designation' => 'Event Coordinator'
            ],
            [
                'name' => 'Michael Chen',
                'designation' => 'Wedding Planner'
            ],
            [
                'name' => 'Emily Rodriguez',
                'designation' => 'Floral Designer'
            ],
            [
                'name' => 'David Thompson',
                'designation' => 'Catering Manager'
            ],
            [
                'name' => 'Lisa Wang',
                'designation' => 'Photography Director'
            ],
            [
                'name' => 'James Wilson',
                'designation' => 'Audio/Visual Specialist'
            ],
            [
                'name' => 'Maria Garcia',
                'designation' => 'Venue Coordinator'
            ],
            [
                'name' => 'Robert Brown',
                'designation' => 'Transportation Manager'
            ]
        ];

        foreach ($teamMembers as $member) {
            $newMember = TeamMember::firstOrCreate(
                ['name' => $member['name']],
                ['designation' => $member['designation']]
            );
            
            // Copy the existing photo if available
            if ($sourcePhoto && Storage::disk('public')->exists($sourcePhoto)) {
                $extension = pathinfo($sourcePhoto, PATHINFO_EXTENSION);
                $newPhotoName = time() . '_' . uniqid() . '.' . $extension;
                $newPhotoPath = 'team-members/' . $newPhotoName;
                
                // Copy the file
                Storage::disk('public')->copy($sourcePhoto, $newPhotoPath);
                
                // Update the team member with the new photo path
                $newMember->update(['photo' => $newPhotoPath]);
            }
        }
    }
}
