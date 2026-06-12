<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCertificationRegistrationRequest;
use App\Contracts\CertificationRegistrationServiceInterface;

class CertificationRegistrationController extends Controller
{
    protected $registrationService;

    public function __construct(CertificationRegistrationServiceInterface $registrationService)
    {
        $this->registrationService = $registrationService;
    }

    /**
     * Store a newly created registration in storage.
     */
    public function store(StoreCertificationRegistrationRequest $request)
    {
        try {
            $registration = $this->registrationService->registerFirm($request->validated());
            
            return response()->json([
                'success' => true,
                'message' => 'Registration submitted successfully!',
                'data' => $registration
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while submitting registration.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
