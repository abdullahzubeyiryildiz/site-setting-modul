<?php

namespace  SettingModul\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['title', 'key', 'value','setting_type'];

    protected $casts = [
        'value' => 'object'
    ];
}
