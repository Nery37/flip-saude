<?php

declare(strict_types=1);

namespace App\Services;

use App\Entities\User;
use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\DB;

class TaskService extends AppService
{
    /**
     * @param TaskRepository $repository
     */
    public function __construct(
        TaskRepository $repository,
    ) {
        $this->repository = $repository;
    }

    /**
     * @param User  $user
     * @param array $data
     * @param bool  $skipPresenter
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function createTask(User $user, array $data, bool $skipPresenter = false): mixed
    {
        try {
            DB::beginTransaction();
            $data['user_id'] = $user->id;
            $task = $this->repository->skipPresenter()->create($data);
            DB::commit();
            return $this->repository->skipPresenter($skipPresenter)->find($task->id);
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

}
