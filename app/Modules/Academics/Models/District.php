<?php

namespace App\Modules\Academics\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';

    protected $fillable = [
        'name',
        'city_id',
        'is_active',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
