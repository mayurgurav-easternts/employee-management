<?php

namespace Tests\Feature\Http\Controllers;

use App\Events\NewTask;
use App\Mail\taskCreated;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TaskController
 */
final class TaskControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $tasks = Task::factory()->count(3)->create();

        $response = $this->get(route('tasks.index'));

        $response->assertOk();
        $response->assertViewIs('task');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TaskController::class,
            'store',
            \App\Http\Requests\TaskStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = $this->faker->name();
        $provided_by = $this->faker->word();
        $start_at = Carbon::parse($this->faker->date());
        $end_at = Carbon::parse($this->faker->date());
        $status = $this->faker->randomElement(/** enum_attributes **/);
        $timestamp = $this->faker->word();

        Event::fake();
        Mail::fake();

        $response = $this->post(route('tasks.store'), [
            'name' => $name,
            'provided_by' => $provided_by,
            'start_at' => $start_at->toDateString(),
            'end_at' => $end_at->toDateString(),
            'status' => $status,
            'timestamp' => $timestamp,
        ]);

        $tasks = Task::query()
            ->where('name', $name)
            ->where('provided_by', $provided_by)
            ->where('start_at', $start_at)
            ->where('end_at', $end_at)
            ->where('status', $status)
            ->where('timestamp', $timestamp)
            ->get();
        $this->assertCount(1, $tasks);
        $task = $tasks->first();

        $response->assertRedirect(route('task.create'));
        $response->assertSessionHas('message', $message);

        Event::assertDispatched(NewTask::class, function ($event) use ($task) {
            return $event->task->is($task);
        });
        Mail::assertSent(taskCreated::class, function ($mail) use ($task) {
            return $mail->task->is($task);
        });
    }
}
