<?php

namespace SettingModul\Database\Seeders;

use Illuminate\Database\Seeder;
use SettingModul\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'title' => 'Başlık',
                'key' => 'site_name',
                'value' => 'Qrken'
            ],
            [
                'title' => 'Slogan',
                'key' => 'site_info',
                'value' => 'Site Kısa Yazı'
            ],
            [
                'title' => 'Site Description',
                'key' => 'site_description',
                'value' => 'Site Description'
            ],
            [
                'title' => 'Site Keywords',
                'key' => 'site_keywords',
                'value' =>  env('APP_NAME').', keyword, keyword2'
            ],
            [
                'title' => 'Site Url',
                'key' => 'site_url',
                'value' =>  env('APP_URL')
            ],
            [
                'title' => 'E-Posta',
                'key' => 'site_email',
                'value' => "pratikyazilimci@gmail.com"
            ],
            [
                'title' => 'Yükleme Klasörü',
                'key' => 'site_upload',
                'value' => "img"
            ],
        ];

        foreach ($settings as $key => $setting) {
            Setting::create($setting);
        }
    }
}
