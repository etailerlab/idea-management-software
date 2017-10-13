<?php

namespace App\Handlers\Events;

use App\Events\IdeaWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\IdeaCreated\{
    ToUser,
    ToSuperadmin,
    ToAdmin
};
use Illuminate\Support\Facades\App;

/**
 * Class IdeaCreated
 * @package App\Handlers\Events
 */
class IdeaCreated
{
    /**
     * @var \App\Repositories\User
     */
    protected $userRepository;

    /**
     * Handle the event.
     *
     * @param  IdeaCreated  $event
     * @return void
     */
    public function handle(IdeaWasCreated $event)
    {
        $this
            ->notifyUser($event)
            //->notifyAdmins($event)
            ->notifySuperadmins($event);
    }

    /**
     * @param IdeaWasCreated $event
     * @return $this
     */
    protected function notifyUser(IdeaWasCreated $event)
    {
        $user = $event->getIdea()->user()->first();
        if ($user->is_active == 1) {
            $user->notify(new ToUser($event->getIdea()));
        }

        return $this;
    }

    /**
     * @param IdeaWasCreated $event
     * @return $this
     */
    protected function notifySuperadmins(IdeaWasCreated $event)
    {
        /** @var \App\Models\Auth\User $user */
        foreach ($this->getUserRepository()->getSuperadmins()->get() as $user) {
            $user->notify(new ToSuperadmin($event->getIdea()));
        }

        return $this;
    }

    /**
     * @param IdeaWasCreated $event
     * @return $this
     */
    protected function notifyAdmins(IdeaWasCreated $event)
    {
        /** @var \App\Models\Auth\User $user */
        foreach ($this->getUserRepository()->getAdmins()->get() as $user) {
            $user->notify(new ToAdmin($event->getIdea()));
        }

        return $this;
    }

    /**
     * @return \App\Repositories\User
     */
    protected function getUserRepository() : \App\Repositories\User
    {
        return App::make('repository.user');
    }
}
