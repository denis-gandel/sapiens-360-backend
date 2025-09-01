<?php

namespace App\Modules\Academics\Models;

use Illuminate\Database\Eloquent\Model;

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
