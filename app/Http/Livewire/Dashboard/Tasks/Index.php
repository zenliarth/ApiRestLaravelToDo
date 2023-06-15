<?php

namespace App\Http\Livewire\Dashboard\Tasks;

use App\Models\Task;
use Livewire\Component;

class Index extends Component
{
    public function getTasksProperty(): array
    {
        return Task::query()
            ->latest()
            ->get()
            ->toArray();
    }

    public function markAsComplete(Task $task): void
    {
        $task->update([
            'completed' => true,
        ]);
    }

    public function deleteTask(Task $task): void
    {
        $task->delete();
    }

    public function render()
    {
        return view('livewire.dashboard.tasks.index');
    }
}
