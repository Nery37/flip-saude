<?php

namespace Tests\Unit;

use App\Entities\Task;
use App\Entities\User;
use App\Enums\StatusEnum;
use App\Repositories\TaskRepository;
use App\Services\TaskService;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TaskServiceTest extends TestCase
{

    protected $mockTaskRepository;
    protected $taskService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->mockTaskRepository = $this->createMock(TaskRepository::class);
        $this->taskService = new TaskService($this->mockTaskRepository);
    }

    public function testCreateSuccessfully()
    {
        DB::beginTransaction();

        $user = User::factory()->create();

        $task = Task::factory()->create([
            'user_id' => $user
        ]);

        $this->mockTaskRepository->expects($this->exactly(2))
        ->method('skipPresenter')
        ->willReturnSelf();

        $this->mockTaskRepository->expects($this->once())
        ->method('create')
        ->willReturn($task);

        $return = [
            'id' => $task->id,
            'title' => $task->title,
            'description' => $task->description,
            'user_id' => $task->user_id,
            'status' => StatusEnum::getById(intval($task->status_id))->getTranslateName(),
            'created_at' => $task->created_at->toDateTimeString(),
            'updated_at' => $task->updated_at->toDateTimeString()
        ];

        $this->mockTaskRepository->expects($this->once())
        ->method('find')
        ->willReturn([
            'data' => $return
        ]);

        $result = $this->taskService->createTask($user, [
            'title' => $task->title,
            'description' => $task->description,
            'status_id' => $task->status_id,
        ]);  

        $this->assertEquals([ 'data' => $return ], $result);
        
        DB::rollBack();
    }


    public function testUpdateSuccessfully()
    {
        DB::beginTransaction();

        $user = User::factory()->create();

        $task = Task::factory()->create([
            'user_id' => $user
        ]);

        $updateTask = [
            'description' => 'Test change description',
        ];

        $task->description = $updateTask['description'];

        $this->mockTaskRepository->expects($this->once())
        ->method('update')
        ->willReturn($task);

        $resultUpdate = $this->taskService->update($updateTask, $task->id); 

        $this->assertEquals($resultUpdate->description, $updateTask['description']);
        
        DB::rollBack();
    }

    public function testDeleteSuccessfully()
    {
        DB::beginTransaction();

        $user = User::factory()->create();

        $task = Task::factory()->create([
            'user_id' => $user
        ]);

        $this->mockTaskRepository->expects($this->once())
        ->method('delete')
        ->willReturnSelf();

        $result = $this->taskService->delete($task->id); 

        $this->assertEquals(['success' => true], $result);
        
        DB::rollBack();
    }

    public function testShowSuccessfully()
    {
        DB::beginTransaction();

        $user = User::factory()->create();

        $task = Task::factory()->create([
            'user_id' => $user
        ]);

        $this->mockTaskRepository->expects($this->once())
        ->method('find')
        ->willReturn($task);

        $result = $this->taskService->find($task->id); 

        $this->assertEquals($task, $result);
        
        DB::rollBack();
    }

    public function testListAllSuccessfully()
    {
        $this->mockTaskRepository->expects($this->once())
            ->method('paginate')
            ->willReturn(['data' => []]);

        $result = $this->taskService->all();

        $expectedResult = ['data' => []];
        $this->assertEquals($expectedResult, $result);
    }
}
