<?php

namespace App\Http\Livewire\Dashboard\Tasks;

use App\Models\Attachment;
use App\Models\Task;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Throwable;

class Manage extends Component
{
    use WithFileUploads;

    public ?Task $task;

    public TemporaryUploadedFile|string|null $image = null;

    public bool $editing = false;

    public bool $removeOldFile = false;

    protected array $rules = [
        'task.title' => 'required|string|max:255',
        'task.description' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif,svg|max:2048',
    ];

    public function mount(Task $task): void
    {
        $this->task = ! blank($task->id)
            ? $this->startEdit($task)
            : new Task();
    }

    public function startEdit(Task $task): Task
    {
        $this->editing = true;

        $task->load('attachments');

        return $task;
    }

    public function save(): RedirectResponse|Redirector|null
    {
        $this->validate();

        try {
            DB::transaction(function () {
                $this->task->created_by = auth()->user()->id;
                $this->task->save();

                $this->uploadImage($this->task->id);
            });

            return to_route('dashboard.tasks.index');
        } catch (Throwable $throwable) {
            report($throwable);

            return null;
        }
    }

    public function uploadImage(int $taskId): void
    {
        if (! blank($this->image)) {
            $extension = $this->image->getClientOriginalExtension();
            $fileName = Str::random(36).".$extension";

            $path = $this->image->storeAs('attachments', $fileName, 'public');

            $filePath = Storage::disk('public')->url($path);

            Attachment::query()->create([
                'task_id' => $taskId,
                'name' => $fileName,
                'path' => $filePath,
                'type' => $extension,
            ]);
        }

        if ($this->shouldRemoveOldFile()) {
            $path = Str::after($this->task->attachmentUrl, 'storage/');

            Storage::disk('public')->delete($path);

            $this->task->attachments->first()->delete();
        }
    }

    public function shouldRemoveOldFile(): bool
    {
        return blank($this->image) && $this->editing
            && $this->removeOldFile && ! blank($this->task->attachmentUrl === '');
    }

    public function render(): View
    {
        return view('livewire.dashboard.tasks.manage');
    }
}
