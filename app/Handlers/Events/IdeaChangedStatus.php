<?php

namespace App\Handlers\Events;

use App\Events\IdeaWasChangedStatus;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Categories\Status;
use App\Notifications\IdeaChangedStatus\ToUser;
use Illuminate\Support\Facades\App;

/**
 * Class IdeaChangedStatus
 * @package App\Handlers\Events
 */
class IdeaChangedStatus
{
    /**
     * Handle the event.
     *
     * @param  IdeaWasChangedStatus  $event
     * @return void
     */
    public function handle(IdeaWasChangedStatus $event)
    {
        $this->notifyUser($event);
        $this->unpinPriority($event);
    }

    /**
     * @param IdeaWasChangedStatus $event
     * @return $this
     */
    protected function notifyUser(IdeaWasChangedStatus $event)
    {
        $user = $event->getIdea()->user()->first();
        if ($user->is_active == 1) {
            $user->notify(new ToUser($event->getIdea()));
        }

        return $this;
    }

    /**
     * @param IdeaWasChangedStatus $event
     * @return $this
     */
    protected function unpinPriority(IdeaWasChangedStatus $event)
    {
        $idea = $event->getIdea();
        $statuses = [
            App::make('repository.status')->getBySlug(Status::SLUG_COMPLETED)->id,
            App::make('repository.status')->getBySlug(Status::SLUG_FROZEN)->id,
        ];
        if ($idea->is_priority && in_array($idea->status_id, $statuses)) {
            $idea->is_priority = 0;
            $idea->save();
        }

        return $this;
    }
}
