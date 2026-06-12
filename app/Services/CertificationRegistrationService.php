<?php

namespace App\Services;

use App\Contracts\CertificationRegistrationServiceInterface;
use App\Contracts\CertificationRegistrationRepositoryInterface;

class CertificationRegistrationService implements CertificationRegistrationServiceInterface
{
    protected $repository;

    public function __construct(CertificationRegistrationRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle the registration of a new certification firm.
     *
     * @param array $data
     * @return mixed
     */
    public function registerFirm(array $data)
    {
        // Business logic could be added here (e.g., dispatching events, sending emails)
        return $this->repository->create($data);
    }
}
