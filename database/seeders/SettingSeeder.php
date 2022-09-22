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
                'value' => 'Qrken',
                'setting_type' => 'text'
            ],
            [
                'title' => 'Slogan',
                'key' => 'site_info',
                'value' => 'Site Kısa Yazı',
                'setting_type' => 'text'
            ],
            [
                'title' => 'Site Description',
                'key' => 'site_description',
                'value' => 'Site Description',
                'setting_type' => 'text'
            ],
            [
                'title' => 'Site Keywords',
                'key' => 'site_keywords',
                'value' =>  env('APP_NAME').', keyword, keyword2',
                'setting_type' => 'text'
            ],
            [
                'title' => 'Site Url',
                'key' => 'site_url',
                'value' =>  env('APP_URL'),
                'setting_type' => 'text'
            ],
            [
                'title' => 'E-Posta',
                'key' => 'site_email',
                'value' => "pratikyazilimci@gmail.com",
                'setting_type' => 'text'
            ],
            [
                'title' => 'Yükleme Klasörü',
                'key' => 'site_upload',
                'value' => "img",
                'setting_type' => 'text'
            ],
            [
                'title' => 'Logo',
                'key' => 'site_logo',
                'value' => "img/logo.png",
                'setting_type' => 'file'
            ],
            [
                'title' => 'Logo',
                'key' => 'site_dark_logo',
                'value' => "img/logo.png",
                'setting_type' => 'file'
            ],
            [
                'title' => 'Logo',
                'key' => 'site_fav_icon',
                'value' => ["img/logo.png","img/logo1.png"],
                'setting_type' => 'array'
            ],
            [
                'title' => 'Site Version',
                'key' => 'version',
                'value' => '10',
                'setting_type' => 'text'
            ]
        ];

        foreach ($settings as $key => $setting) {
          Setting::firstOrCreate([
                'key' => $setting['key']
            ], [
                'key' => $setting['key'],
                'title' => $setting['title'],
                'value' => $setting['value'],
                'setting_type' => $setting['setting_type'],
            ]);
        }
    }
}
