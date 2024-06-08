<?php

namespace App\Providers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\User;
use App\Policies\EducationPolicy;
use App\Policies\ExperiencePolicy;
use App\Policies\UserPolicy;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Experience::class, ExperiencePolicy::class);
        Gate::policy(Education::class, EducationPolicy::class);
    }
}
