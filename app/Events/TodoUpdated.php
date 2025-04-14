<?php

namespace App\Events;

use App\Models\Todo;
use Thunk\Verbs\Event;
use App\States\TodoState;
use Thunk\Verbs\Attributes\Autodiscovery\StateId;

class TodoUpdated extends Event
{
    #[StateId(TodoState::class)]
    public int $id;

    public string $title;

    public ?string $description;

    public bool $isCompleted;

    public function apply(TodoState $state)
    {
        $state->title = $this->title;
        $state->description = $this->description;
        $state->isCompleted = $this->isCompleted;
    }

    public function handle(TodoState $state)
    {
        // dump([
        //     "ID: $this->id" => Todo::find($this->id)]
        // );

        Todo::findOrFail($this->id)->update([
            'title' => $state->title,
            'description' => $state->description,
            'is_completed' => $state->isCompleted,
        ]);
    }
}
