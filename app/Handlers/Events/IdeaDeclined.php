<?php

namespace App\Handlers\Events;

use App\Events\IdeaWasDeclined;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\IdeaDeclined\{
    ToUser
};
use Illuminate\Support\Facades\App;

/**
 * Class IdeaDeclined
 * @package App\Handlers\Events
 */
class IdeaDeclined
{
    /**
     * @var \App\Repositories\User
     */
    protected $userRepository;

    /**
     * @var \App\Models\Note
     */
    protected $reason;

    /**
     * Handle the event.
     *
     * @param  IdeaWasDeclined  $event
     * @return void
     */
    public function handle(IdeaWasDeclined $event)
    {
        $this->notifyUser($event);
    }

    /**
     * @param IdeaWasDeclined $event
     * @return $this
     */
    protected function notifyUser(IdeaWasDeclined $event)
    {
        $user = $event->getIdea()->user()->first();
        if ($user->is_active == 1) {
            $user->notify(new ToUser($event->getIdea(), $this->getDeclineReason($event)));
        }

        return $this;
    }

    /**
     * @param IdeaWasDeclined $event
     * @return \App\Models\Note
     */
    protected function getDeclineReason(IdeaWasDeclined $event)
    {
        if (!$this->reason) {
            $this->reason = $event->getIdea()->getDeclineReason();
        }

        return $this->reason;
    }

    /**
     * @return \App\Repositories\User
     */
    protected function getUserRepository() : \App\Repositories\User
    {
        return App::make('repository.user');
    }
}
