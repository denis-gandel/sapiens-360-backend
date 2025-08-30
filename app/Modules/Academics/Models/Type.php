<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Academics\Models\Institute;

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
