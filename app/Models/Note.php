<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Note
 * @package App\Models
 */
class Note extends Model
{
    const TYPE_DECLINED_REASON = 'declined_reason';
    const TYPE_PRIORITY_REASON = 'priority_reason';

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
        'text',
        'idea_id',
        'type',
    ];
}
