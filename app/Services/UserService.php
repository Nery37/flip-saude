<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\UserRepository;
use Carbon\Carbon;
use Prettus\Repository\Contracts\RepositoryInterface;
use Illuminate\Support\Facades\DB;

/**
 * UserService.
 */
class UserService extends AppService
{
    protected RepositoryInterface $repository;
    private AuthService $authService;

    /**
     * @param AuthService    $authService
     */
    public function __construct(
        AuthService $authService,
        UserRepository $repository
    ) {
        $this->authService = $authService;
        $this->repository = $repository;
    }

    /**
     * @param array $data
     *
     * @return array
     *
     * @throws \Exception
     */
    public function signup(array $data): array
    {
        try {
            DB::beginTransaction();
            $data['email_verified_at'] = Carbon::now()->format('Y-m-d H:i:s');
            $user = $this->create($data, true);
            $accessToken = $this->authService->generateAccessToken($user);
            DB::commit();
            return ['data' => $accessToken];
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}
