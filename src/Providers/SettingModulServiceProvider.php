<?php

namespace SettingModul\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
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

        if (Schema::hasTable('settings')) {
            Artisan::call('db:seed', [
                '--class' => SettingSeeder::class,
                '--force' => true // <--- add this line
            ]);
        }


        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'settingmodul');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'settingmodul');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->publishes([
            __DIR__ . '/../../resources/views' => base_path('resources/views/vendor/settingmodul'),
            __DIR__ . '/../../resources/lang' => base_path('resources/lang/vendor/settingmodul'),
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
