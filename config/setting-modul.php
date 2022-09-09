<?php


$settings = cache()->rememberForever("site_settings", 60, function()
{
    return \SettingModul\Models\Setting::pluck("value","key")->all();
});

return config()->set("site", $settings);

