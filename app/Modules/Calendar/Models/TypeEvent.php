<?php

namespace App\Modules\Calendar\Models;

use Illuminate\Database\Eloquent\Model;

class TypeEvent extends Model
{
    protected $table = 'type_events';

    protected $fillable = [
        'name',
        'code'
    ];

    public function types()
    {
        return $this->hasMany(Event::class, 'type_id');
    }
}
