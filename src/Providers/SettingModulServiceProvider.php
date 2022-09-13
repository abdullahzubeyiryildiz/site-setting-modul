<?php

namespace SettingModul\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use SettingModul\Providers\SeedServiceProvider;


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
        $this->app->register(SeedServiceProvider::class);

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
