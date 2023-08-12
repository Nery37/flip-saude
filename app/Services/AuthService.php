<?php

declare(strict_types=1);

namespace App\Services;

use App\Entities\User;
use App\Enums\TokenAbilityEnum;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Contracts\RepositoryInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService extends AppService
{
    protected RepositoryInterface $repository;

    /**
     * @param UserRepository          $repository
     */
    public function __construct(
        UserRepository $repository,
    ) {
        $this->repository = $repository;
    }


    /**
     * @param array $data
     *
     * @return array
     *
     * @throws \Exception
     */
    public function login(array $data): array
    {

        $user = $this->repository->where('email', $data['email'])->first();

        if(! $user || ! Hash::check($data['password'], $user->password)){
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect']
            ]);
        }
        $this->logout($user);
        return ['data' => $this->generateAccessToken($user)];
    }

    /**
     * @param User $user
     */
    public function logout(User $user): void
    {
        $user->tokens()->delete();
    }

    /**
     * @param User $user
     *
     * @return array
     */
    public function refreshToken(User $user): array
    {
        $this->logout($user);
        return ['data' => $this->generateAccessToken($user)];
    }

    /**
     * @param Authenticatable $user
     *
     * @return array
     */
    public function generateAccessToken(Authenticatable $user): array
    {
        $accessToken = $user->createToken(
            'access_token',
            [TokenAbilityEnum::ACCESS_API->value],
            Carbon::now()->addMinutes(config('sanctum.expiration'))
        );

        $refreshToken = $user->createToken(
            'refresh_token',
            [TokenAbilityEnum::ISSUE_ACCESS_TOKEN->value],
            Carbon::now()->addMinutes(config('sanctum.rt_expiration'))
        );

        return [
            'access_token' => $accessToken->plainTextToken,
            'refresh_token' => $refreshToken->plainTextToken,
            'token_type' => 'Bearer',
        ];
    }
}
