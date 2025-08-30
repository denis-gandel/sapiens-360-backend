<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nature extends Model
{
    protected $table = 'natures';

    protected $fillable = [
        'name',
        'is_active',
    ];
}
