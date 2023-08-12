<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SignupRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class UsersController.
 */
class UsersController extends Controller
{
    protected $service;

    /**
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @param SignupRequest $request
     *
     * @return JsonResponse
     */
    public function signup(SignupRequest $request): JsonResponse
    {
        try {
            return $this->successCreatedResponse($this->service->signup($request->all()));
        } catch (\Exception $exception) {
            return $this->undefinedErrorResponse($exception->getMessage(), $exception->getCode());
        }
    }
}
