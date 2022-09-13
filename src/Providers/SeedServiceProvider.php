<?php

namespace SettingModul\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;


class SeedServiceProvider extends ServiceProvider
{
    protected $seeds_path =  __DIR__ . '/../../database/seeds';

}
