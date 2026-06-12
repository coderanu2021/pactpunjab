<?php

namespace App\Contracts;

interface CertificationRegistrationServiceInterface
{
    /**
     * Handle the registration of a new certification firm.
     *
     * @param array $data
     * @return mixed
     */
    public function registerFirm(array $data);
}
