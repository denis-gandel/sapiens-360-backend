<?php

namespace App\Modules\Authorization\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'parent_id',
        'path',
        'code',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'category_id');
    }
}
