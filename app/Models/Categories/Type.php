<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
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

    /**
     * @return string
     */
    public function getDisplayNameField() : string
    {
        return $this->name;
    }
}
