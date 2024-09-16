<?php

namespace App\Http\Controllers;

use App\Events\NewTask;
use App\Http\Requests\TaskStoreRequest;
use App\Mail\taskCreated;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(Request $request): Response
    {
        $tasks = Task::all();

        return view('task');
    }

    public function store(TaskStoreRequest $request): Response
    {
        $task = Task::create($request->validated());

        NewTask::dispatch($task);

        Mail::send(new taskCreated($task));

        $request->session()->flash('message', $message);

        return redirect()->route('task.create');
    }
}
