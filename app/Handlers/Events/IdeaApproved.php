<?php

namespace App\Handlers\Events;

use App\Events\IdeaWasApproved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\IdeaApproved\{
    ToUser,
    ToAdmin
};
use Illuminate\Support\Facades\App;

/**
 * Class IdeaApproved
 * @package App\Handlers\Events
 */
class IdeaApproved
{
    /**
     * @var \App\Repositories\User
     */
    protected $userRepository;

    /**
     * Handle the event.
     *
     * @param IdeaWasApproved  $event
     * @return void
     */
    public function handle(IdeaWasApproved $event)
    {
        $this
            ->notifyUser($event)
            ->notifyAdmins($event);
    }

    /**
     * @param IdeaWasApproved $event
     * @return $this
     */
    protected function notifyUser(IdeaWasApproved $event)
    {
        $user = $event->getIdea()->user()->first();
        if ($user->is_active == 1) {
            $user->notify(new ToUser($event->getIdea()));
        }

        return $this;
    }

    /**
     * @param IdeaWasApproved $event
     * @return $this
     */
    protected function notifyAdmins(IdeaWasApproved $event)
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
