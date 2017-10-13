<?php

namespace App\Service;

use Illuminate\Support\Facades\{
    App,
    DB
};
use \App\Models\Auth\{
    Role,
    User
};
use App\Models\IkantamService;
use Junaidnasir\Larainvite\Facades\Invite;

/**
 * Class UserRegistrator
 * @package App\Service
 */
class UserRegistrator
{
    /**
     * @param array $data
     * @return \App\Models\Auth\User
     * @throws \Exception
     */
    public function register(array $data)
    {
        $user = (new User($data));
        $user->is_active = 1;
        DB::beginTransaction();
        try {
            $user->save();
            $role = Role::findOrFail($data['role_id']);
            $user->attachRole($role);
            $this->sendInvite($user);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $user;
    }

    /**
     * @param User $user
     * @param array $data
     * @return User
     * @throws \Exception
     */
    public function update(User $user, array $data)
    {
        $user->fill($data);
        DB::beginTransaction();
        try {
            $user->save();
            $user->roles()->detach();
            $role = Role::findOrFail($data['role_id']);
            $user->attachRole($role);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return $user;
    }

    /**
     * @param $code
     * @return bool
     */
    public function isValidInviteCode($code): bool
    {
        return Invite::isValid($code);
    }

    /**
     * @param $code
     * @param $password
     * @return mixed
     * @throws \Exception
     */
    public function setPassword($code, $password)
    {
        if (Invite::isValid($code)) {
            $invitation = Invite::get($code);
            $user = $invitation->user;
            $user->password = bcrypt($password);
            $user->save();
            Invite::consume($code);
        } else {
            throw new \Exception('Код приглашения неверен.');
        }

        return $user;
    }

    /**
     * @param User $user
     * @return $this
     */
    protected function sendInvite(User $user)
    {
        $refCode = Invite::invite($user->email, $user->id);
        $user->notify(new \App\Notifications\SendInvite($refCode));

        return $this;
    }
}