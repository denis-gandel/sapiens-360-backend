<?php

namespace App\Modules\Courses\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Academics\Models\Institute;

class Level extends Model
{
    protected $table = 'levels';

    protected $keyType = 'uuid';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'description',
        'code',
        'order',
        'tenant_id',
        'program_id',
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'tenant_id');
    }
}
