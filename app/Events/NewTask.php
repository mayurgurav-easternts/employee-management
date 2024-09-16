<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewTask
{
    use Dispatchable, SerializesModels;

    public $task;

    /**
     * Create a new event instance.
     */
    public function __construct($task)
    {
        $this->task = $task;
    }
}
