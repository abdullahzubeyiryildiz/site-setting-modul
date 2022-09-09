<?php

namespace SettingModul\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;


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

        $this->publishes([

        ], 'settingmodul');

        $settings = cache()->rememberForever("site_settings", 60, function()
        {
            return \SettingModul\Models\Setting::pluck("value","key")->all();
        });

        return config()->set("site", $settings);
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
