<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Web_Settings extends Model
{
    protected $table = 'web_settings';

    protected $fillable = [
        'logo',
        'description',
    ];
}
