<?php

namespace App\Filament\Resources\TodoResource\Pages;

use Filament\Actions;
use App\Events\TodoUpdated;
use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\TodoResource;
use Filament\Resources\Pages\EditRecord;

class EditTodo extends EditRecord
{
    protected static string $resource = TodoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        TodoUpdated::commit(
            todoId: $this->record->id,
            title: $data['title'],
            description: $data['description'] ?? null,
            isCompleted: $data['is_completed'] ?? false,
        );

        return \App\Models\Todo::where('user_id', Auth::id())
            ->latest()
            ->first()
            ->toArray();
    }
}
