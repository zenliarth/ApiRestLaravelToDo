<?php

namespace App\Http\Livewire\Dashboard\Tasks;

use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Livewire\Component;
use Throwable;

class Manage extends Component
{
    public ?Task $task;

    protected array $rules = [
        'task.title' => 'required|string|max:255',
        'task.description' => 'required|string|max:255',
    ];

    public function mount(Task $task): void
    {
        $this->task = ! blank($task->id) ? $task : new Task();
    }

    public function save(): RedirectResponse|Redirector|null
    {
        $this->validate();

        try {
            $this->task->created_by = auth()->user()->id;
            $this->task->save();

            return to_route('dashboard.tasks.index');
        } catch (Throwable $throwable) {
            report($throwable);

            return null;
        }
    }

    public function render(): View
    {
        return view('livewire.dashboard.tasks.manage');
    }
}
