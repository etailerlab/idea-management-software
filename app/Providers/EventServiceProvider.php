<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        'App\Events\IdeaWasCreated' => [
            'App\Handlers\Events\IdeaCreated@handle',
        ],
        'App\Events\IdeaWasApproved' => [
            'App\Handlers\Events\IdeaApproved@handle',
        ],
        'App\Events\IdeaWasDeclined' => [
            'App\Handlers\Events\IdeaDeclined@handle',
        ],
        'App\Events\IdeaWasChangedStatus' => [
            'App\Handlers\Events\IdeaChangedStatus@handle',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
