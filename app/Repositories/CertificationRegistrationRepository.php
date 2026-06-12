<?php

namespace App\Repositories;

use App\Contracts\CertificationRegistrationRepositoryInterface;
use App\Models\CertificationRegistration;

class CertificationRegistrationRepository implements CertificationRegistrationRepositoryInterface
{
    protected $model;

    public function __construct(CertificationRegistration $model)
    {
        $this->model = $model;
    }

    /**
     * Create a new certification registration record.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }
}
