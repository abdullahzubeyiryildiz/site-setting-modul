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
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'setting-modul');

        Artisan::call('db:seed', [
            '--class' => SettingSeeder::class,
            '--force' => true // <--- add this line
        ]);

        $this->publishes([
            __DIR__ . '/../../resources/lang' => base_path('resources/lang/vendor/setting-modul'),
            $this->configPath() => config_path('setting-modul.php'),
        ], 'settingmodul');



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
