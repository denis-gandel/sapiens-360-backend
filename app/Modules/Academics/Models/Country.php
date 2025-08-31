<?php

namespace App\Modules\Academics\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'name',
        'is_active',
    ];

    public function states()
    {
        return $this->hasMany(State::class);
    }
}
