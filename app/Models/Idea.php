<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Idea
 * @package App\Models
 */
class Idea extends Model
{
    const NEW = 0;
    const APPROVED = 1;
    const DECLINED = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'type_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @return bool
     */
    public function isDeclined() : bool
    {
        return $this->approve_status === self::DECLINED;
    }

    /**
     * @return bool
     */
    public function isApproved() : bool
    {
        return $this->approve_status === self::APPROVED;
    }

    /**
     * @return bool
     */
    public function isNew() : bool
    {
        return $this->approve_status === self::NEW;
    }

    /**
     * return \App\Models\Note
     */
    public function getDeclineReason()
    {
        return $this->notes()->where('type', '=', \App\Models\Note::TYPE_DECLINED_REASON)->first();
    }

    /**
     * return \App\Models\Note
     */
    public function getPriorityReason()
    {
        return $this->notes()->where('type', '=', \App\Models\Note::TYPE_PRIORITY_REASON)->first();
    }

    /**
     * @return string
     */
    public function getDisplayNameField() : string
    {
        return $this->title;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\Auth\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function coreCompetencies()
    {
        return $this->belongsToMany('App\Models\Categories\CoreCompetency', 'idea_core_competency');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function departments()
    {
        return $this->belongsToMany('App\Models\Categories\Department', 'idea_departament');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function operationalGoals()
    {
        return $this->belongsToMany('App\Models\Categories\OperationalGoal', 'idea_operational_goal');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function strategicObjectives()
    {
        return $this->belongsToMany('App\Models\Categories\StrategicObjective', 'idea_strategic_objective');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo('App\Models\Categories\Type');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo('App\Models\Categories\Status');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany('App\Models\Note');
    }
}
