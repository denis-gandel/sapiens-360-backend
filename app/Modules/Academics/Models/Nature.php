<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Academics\Models\Institute;

class Nature extends Model
{
    protected $table = 'natures';

    protected $fillable = [
        'name',
        'is_active',
    ];

    public function institutes()
    {
        return $this->hasMany(Institute::class);
    }
}
