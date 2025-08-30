<?php

namespace App\Modules\Academics\Models;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $table = 'periods';

    protected $fillable = [
        'name',
        'duration',
        'is_active',
    ];

    public function institutes()
    {
        return $this->hasMany(Institute::class);
    }
}
