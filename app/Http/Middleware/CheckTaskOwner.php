<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Repositories\TaskRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckTaskOwner
{
    protected TaskRepository $repository;

    /**
     * @param TaskRepository $repository
    */
    public function __construct(
        TaskRepository $repository,
    ) {
        $this->repository = $repository;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request  $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, \Closure $next): mixed
    {
        $task = $this->repository->skipPresenter()->find($request->route('id'));
        if (!$task || Auth::id() !== $task->user_id) {
            return response()->json(['error' => 'Usuário sem permissão'], 403);
        }

        return $next($request);
    }
}
