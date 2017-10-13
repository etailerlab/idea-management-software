<?php

namespace App\Models\Auth;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Junaidnasir\Larainvite\InviteTrait;
use App\Models\Idea;
use App\Models\Categories\Status;

/**
 * Class User
 * @package App\Models\Auth
 */
class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;
    use InviteTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'department_id',
        'position_id',
        'is_active'
    ];

    /**
     * @var array
     */
    protected $guarded = [
        'id',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return string
     */
    public function getFullName() : string
    {
        return $this->last_name . ' ' . $this->name;
    }
    /**
     * @return int
     */
    public function countActiveIdeas() : int
    {
        $status = Status::getActiveStatus();
        return Idea::where('status_id', '=', isset($status) ? $status->id : 0)
            ->where('approve_status', '=', Idea::APPROVED)
            ->where('user_id', '=', $this->id)
            ->count();
    }

    /**
     * @return int
     */
    public function countFrozenIdeas() : int
    {
        $status = Status::getFrozenStatus();
        return Idea::where('status_id', '=', isset($status) ? $status->id : 0)
            ->where('approve_status', '=', Idea::APPROVED)
            ->where('user_id', '=', $this->id)
            ->count();
    }

    /**
     * @return int
     */
    public function countCompletedIdeas() : int
    {
        $status = Status::getCompletedStatus();
        return Idea::where('status_id', '=', isset($status) ? $status->id : 0)
            ->where('approve_status', '=', Idea::APPROVED)
            ->where('user_id', '=', $this->id)
            ->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('App\Models\Categories\Department');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function position()
    {
        return $this->belongsTo('App\Models\Categories\Position');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ideas()
    {
        return $this->hasMany('App\Models\Idea');
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\ResetPassword($token));
    }
}
