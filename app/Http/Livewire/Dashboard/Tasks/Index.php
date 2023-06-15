<?php

namespace App\Http\Livewire\Dashboard\Tasks;

use App\Models\Task;
use Livewire\Component;

class Index extends Component
{
    public function getTasksProperty(): array
    {
        return Task::all()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.dashboard.tasks.index');
    }
}
