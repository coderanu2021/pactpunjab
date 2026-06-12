<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\CertificationRegistrationServiceInterface;
use App\Services\CertificationRegistrationService;
use App\Contracts\CertificationRegistrationRepositoryInterface;
use App\Repositories\CertificationRegistrationRepository;

class SolidServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CertificationRegistrationServiceInterface::class, CertificationRegistrationService::class);
        $this->app->bind(CertificationRegistrationRepositoryInterface::class, CertificationRegistrationRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
