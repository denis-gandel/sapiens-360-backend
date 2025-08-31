<?php

namespace App\Modules\Academics\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Users\Models\User;

class Institute extends Model
{
    protected $table = 'institutes';

    protected $keyType = 'uuid';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'subdomain',
        'location',
        'logo',
        'email',
        'phone',
        'established_year',
        'start_date',
        'end_date',
        'type_id',
        'nature_id',
        'period_id',
        'country_id',
        'state_id',
        'city_id',
        'district_id',
        'is_active',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function nature()
    {
        return $this->belongsTo(Nature::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'tenant_id');
    }
}
