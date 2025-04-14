<?php

namespace App\Events;

use App\Models\Todo;
use Thunk\Verbs\Event;
use App\States\TodoState;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;

class TodoCreated extends Event
{
    #[StateId(TodoState::class)]
    public int $id;

    public string $title;

    public ?string $description;

    public bool $isCompleted;

    public int $userId;

    public function apply(TodoState $state)
    {
        $state->title = $this->title;
        $state->description = $this->description;
        $state->isCompleted = $this->isCompleted;
        $state->userId = $this->userId;
    }

    public function handle(TodoState $state)
    {
        Todo::create([
            'title' => $state->title,
            'description' => $state->description,
            'is_completed' => $state->isCompleted,
            'user_id' => $state->userId,
        ]);
    }
}
