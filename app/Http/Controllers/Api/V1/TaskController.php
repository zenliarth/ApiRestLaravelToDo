<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        return TaskResource::collection(Task::all());
    }

    public function create()
    {
        //
    }

    public function store(StoreTaskRequest $request)
    {
        //
    }

    public function show(Task $task)
    {
        return TaskResource::make($task);
    }

    public function edit(Task $task)
    {
        //
    }

 public function update(UpdateTaskRequest $request, Task $task)
 {
     //
 }

    public function destroy(Task $task)
    {
        //
    }
}
