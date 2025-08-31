<?php

namespace App\Modules\Courses\Models;

use App\Modules\Academics\Models\Institute;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'programs';

    protected $keyType = 'uuid';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'description',
        'code',
        'degree_type',
        'duration_type',
        'periods',
        'tenant_id',
    ];

    public function levels()
    {
        return $this->hasMany(Level::class, 'program_id');
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'tenant_id');
    }
}
