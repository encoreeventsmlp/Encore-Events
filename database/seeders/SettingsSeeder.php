<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'facebook_url',
                'value' => '',
                'type' => 'url',
                'group' => 'social',
                'label' => 'Facebook URL',
                'description' => 'Your Facebook page URL',
                'is_active' => true,
            ],
            [
                'key' => 'instagram_url',
                'value' => '',
                'type' => 'url',
                'group' => 'social',
                'label' => 'Instagram URL',
                'description' => 'Your Instagram profile URL',
                'is_active' => true,
            ],
            [
                'key' => 'twitter_url',
                'value' => '',
                'type' => 'url',
                'group' => 'social',
                'label' => 'Twitter URL',
                'description' => 'Your Twitter profile URL',
                'is_active' => true,
            ],
            [
                'key' => 'linkedin_url',
                'value' => '',
                'type' => 'url',
                'group' => 'social',
                'label' => 'LinkedIn URL',
                'description' => 'Your LinkedIn profile URL',
                'is_active' => true,
            ],
            [
                'key' => 'youtube_url',
                'value' => '',
                'type' => 'url',
                'group' => 'social',
                'label' => 'YouTube URL',
                'description' => 'Your YouTube channel URL',
                'is_active' => true,
            ],

            // Contact Information Settings
            [
                'key' => 'company_phone',
                'value' => '+91 123 456 7890',
                'type' => 'phone',
                'group' => 'contact',
                'label' => 'Company Phone',
                'description' => 'Main business phone number',
                'is_active' => true,
            ],
            [
                'key' => 'company_email',
                'value' => 'info@encoreevents.com',
                'type' => 'email',
                'group' => 'contact',
                'label' => 'Company Email',
                'description' => 'Main business email address',
                'is_active' => true,
            ],
            [
                'key' => 'company_address',
                'value' => 'Encore Complex, Arimbra Manangatta',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Company Address',
                'description' => 'Business address',
                'is_active' => true,
            ],
            [
                'key' => 'company_pin',
                'value' => '673638',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Company PIN',
                'description' => 'Postal/ZIP code',
                'is_active' => true,
            ],
            [
                'key' => 'company_website',
                'value' => '',
                'type' => 'url',
                'group' => 'contact',
                'label' => 'Company Website',
                'description' => 'Main company website URL',
                'is_active' => true,
            ],

            // General Settings
            [
                'key' => 'company_name',
                'value' => 'Encore Events',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Company Name',
                'description' => 'Your company name',
                'is_active' => true,
            ],
            [
                'key' => 'company_tagline',
                'value' => 'Creating Memorable Events',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Company Tagline',
                'description' => 'Your company tagline or slogan',
                'is_active' => true,
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
