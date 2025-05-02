<?php

namespace App\Providers;

use App\Models\Document;
use App\Policies\DocumentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Document::class => DocumentPolicy::class,
        // Tambahkan model dan policy lain di sini
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Optional: Tambahkan Gate untuk permission tambahan
        Gate::define('admin-access', function ($user) {
            return $user->is_admin;
        });

        // Auto-discover policies (Laravel 8+)
        // Gate::guessPolicyNamesUsing(function ($modelClass) {
        //     return 'App\\Policies\\' . class_basename($modelClass) . 'Policy';
        // });
    }
}
