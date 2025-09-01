<?php

namespace App\Modules\Academics\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{

    protected $table = 'types';

    protected $fillable = [
        'name',
        'is_active',
    ];

    public function institutes()
    {
        return $this->hasMany(Institute::class);
    }

}
