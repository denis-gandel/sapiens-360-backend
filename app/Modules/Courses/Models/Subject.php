<?php

namespace App\Modules\Courses\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Academics\Models\Institute;
use App\Modules\Calendar\Models\Event;

class Subject extends Model
{
    protected $table = 'subjects';

    protected $keyType = 'uuid';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'description',
        'code',
        'credits',
        'prerequisites',
        'tenant_id',
    ];

    protected $casts = [
        'prerequisites' => 'array',
    ];

    // Academics
    public function institute()
    {
        return $this->belongsTo(Institute::class, 'tenant_id');
    }

    // Calendar
    public function events()
    {
        return $this->hasMany(Event::class, 'subject_id');
    }
}
