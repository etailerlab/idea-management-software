<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

/**
 * Class Status
 * @package App\Models\Categories
 */
class Status extends Model
{
    const SLUG_ACTIVE = 'active';
    const SLUG_FROZEN = 'frozen';
    const SLUG_COMPLETED = 'completed';

    /**
     * @var $this
     */
    protected static $completedStatus;

    /**
     * @var $this
     */
    protected static $frozenStatus;

    /**
     * @var $this
     */
    protected static $activeStatus;


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
        'slug',
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
        return $this->belongsToMany('App\Models\Idea');
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public static function createNew(string $slug)
    {
        return self::create(
            [
                'slug' => $slug,
                'name' => $slug,
            ]
        );
    }

    /**
     * @return Status
     */
    public static function getCompletedStatus()
    {
        if (!self::$completedStatus) {
            self::$completedStatus = App::make('repository.status')->getBySlug(Status::SLUG_COMPLETED);
        }

        return self::$completedStatus;
    }

    /**
     * @return Status
     */
    public static function getFrozenStatus()
    {
        if (!self::$frozenStatus) {
            self::$frozenStatus = App::make('repository.status')->getBySlug(Status::SLUG_FROZEN);
        }

        return self::$frozenStatus;
    }

    /**
     * @return Status
     */
    public static function getActiveStatus()
    {
        if (!self::$activeStatus) {
            self::$activeStatus = App::make('repository.status')->getBySlug(Status::SLUG_ACTIVE);
        }

        return self::$activeStatus;
    }
}
