<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Task;

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
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'provided_by' => $this->faker->word(),
            'start_at' => $this->faker->date(),
            'end_at' => $this->faker->date(),
            'status' => $this->faker->randomElement(["hold","pending","in_progress","completed"]),
            'timestamp' => $this->faker->word(),
        ];
    }
}
