<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends BaseController
{
    public function index()
    {
        return TaskResource::collection(
            Task::query()
                ->with('createdBy')
                ->whereCreatedBy(auth()->user()->id)
                ->get()
        );
    }

    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth()->user()->id;

        $task = Task::create($data);

        return $this->sendResponse(TaskResource::make($task), 'Task created successfully');
    }

    public function show(Task $task)
    {
        return TaskResource::make($task);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());

        return TaskResource::make($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->noContent();
    }
}
