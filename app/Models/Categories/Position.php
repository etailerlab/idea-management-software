<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    /**
     * disable update timestamp fields
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'is_active',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\Auth\User');
    }

    /**
     * @return string
     */
    public function getDisplayNameField() : string
    {
        return $this->name;
    }
}
