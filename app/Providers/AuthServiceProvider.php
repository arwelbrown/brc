<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Policies\UserPolicy;
use App\Models\User;
use App\Models\Newsletter;
use App\Policies\NewsletterPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class,
        // Submission::class => SubmissionsPolicy::class,
        Newsletter::class => NewsletterPolicy::class,
        // Product::class => ProductsPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
