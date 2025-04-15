<?php

namespace App\Filament\Resources\TodoResource\Pages;

use App\Filament\Resources\TodoResource;
use App\Events\TodoCreated;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class CreateTodo extends CreateRecord
{
    protected static string $resource = TodoResource::class;

    // Override the create method to use events instead
    protected function handleRecordCreation(array $data): Model
    {
        // Fire the TodoCreated event instead of creating the record through Filament
        TodoCreated::commit(
            todoId: snowflake_id(),
            title: $data['title'],
            description: $data['description'],
            isCompleted: $data['is_completed'],
            userId: Auth::id(),
        );

        // Find the most recently created Todo for the current user
        // This is necessary because Filament expects a model to be returned
        return \App\Models\Todo::where('user_id', Auth::id())
            ->latest()
            ->first();
    }
}
