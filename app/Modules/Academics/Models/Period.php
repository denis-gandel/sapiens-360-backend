<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Academics\Models\Institute;

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
