<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Student;
use App\Models\User;
use App\Policies\StudentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Student::class => StudentPolicy::class
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define("search_student", function (User $user){
            return ($user->search_student===1);
        });

        Gate::define("edit_old_students", function (User $user, Student $student){
            return $student->year>=2020;
        });
    }
}
