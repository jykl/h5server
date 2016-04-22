<?php

namespace App\Providers;

use App\Courseware;
use App\Element;
use App\Policies\CoursewarePolicy;
use App\Policies\ElementPolicy;
use App\Policies\TaskPolicy;
use App\Task;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Task::class => TaskPolicy::class,
        Element::class=>ElementPolicy::class,
        Courseware::class=>CoursewarePolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
        

        //
    }
}
