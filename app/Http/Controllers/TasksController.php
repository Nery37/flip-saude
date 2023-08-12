<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskCreateRequest;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;

/**
 * Class TasksController.
 *
 * @package namespace App\Http\Controllers;
 */
class TasksController extends Controller
{
    /**
     * @var TaskService
     */
    protected $service;

    /**
     * TasksController constructor.
     *
     * @param TaskService $service
     */
    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }

    /**
     * @param TaskCreateRequest $request
     *
     * @return JsonResponse
     */

    public function storeTask(TaskCreateRequest $request): JsonResponse
    {
        try {
            return $this->successCreatedResponse($this->service->createTask($request->user(), $request->all()));
        } catch (\Exception $exception) {
            return $this->undefinedErrorResponse($exception->getMessage(), $exception->getCode());
        }
    }
}
