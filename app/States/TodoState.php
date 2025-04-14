<?php

namespace App\States;

use Thunk\Verbs\State;

class TodoState extends State
{
    public string $title;

    public ?string $description;

    public bool $isCompleted;

    public int $userId;
}
