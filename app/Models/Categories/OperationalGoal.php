<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class OperationalGoal extends Model
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function ideas()
    {
        return $this->belongsToMany('App\Models\Idea', 'idea_operational_goal');
    }
}
