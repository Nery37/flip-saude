<?php

declare(strict_types=1);

namespace Database\Factories\Entities;

use App\Entities\Task;
use App\Entities\User;
use App\Enums\StatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->name(),
            'user_id' => User::factory()->create(),
            'description' => $this->faker->text(200),
            'status_id' => StatusEnum::CONCLUDED->value,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
