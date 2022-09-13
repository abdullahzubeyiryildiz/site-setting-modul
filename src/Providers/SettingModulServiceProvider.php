<?php

namespace SettingModul\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;

use SettingModul\Database\Seeders\SettingSeeder;

class SettingModulServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        Artisan::call('db:seed', [
            '--class' => SettingSeeder::class,
            '--force' => true // <--- add this line
        ]);
       /*
        $this->publishes([

        ], 'settingmodul');
        */


        //  config()->set("site", \SettingModul\Models\Setting::pluck("value","key")->all());
    }

    protected function configPath()
    {
       return __DIR__ . '/../../config/setting-modul.php';
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            $this->configPath(),
            'setting-modul'
        );

    }
}
