<?php

namespace App\Contracts;

interface CertificationRegistrationRepositoryInterface
{
    /**
     * Create a new certification registration record.
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);
}
