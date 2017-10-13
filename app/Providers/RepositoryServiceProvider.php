<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRepositories();
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerRepositories()
    {
        foreach ($this->getRepositoriesList() as $name => $className) {
            $className = "\\" . $className;
            $this->app->singleton('repository.' . $name, function ($app) use ($className) {
                return new $className();
            });
        }

    }

    /**
     * @return array
     */
    private function getRepositoriesList() : array
    {
        return [
            'user' => \App\Repositories\User::class,
            'role' => \App\Repositories\Role::class,
            'department' => \App\Repositories\Department::class,
            'coreCompetency' => \App\Repositories\CoreCompetency::class,
            'operationalGoal' => \App\Repositories\OperationalGoal::class,
            'strategicObjective' => \App\Repositories\StrategicObjective::class,
            'type' => \App\Repositories\Type::class,
            'status' => \App\Repositories\Status::class,
            'position' => \App\Repositories\Position::class,
        ];
    }
}
