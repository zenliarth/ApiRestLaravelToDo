<?php

use App\Models\Task;
use App\Models\User;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function PHPUnit\Framework\assertTrue;

it('should get all tasks for the auth user from api', function () {
    $user = User::factory()->create();

    $allTasks = Task::factory(10)->create([
        'created_by' => $user->id,
    ]);

    $response = $this
        ->actingAs($user)
        ->get('/api/v1/tasks', []);

    $response->assertJsonCount($allTasks->count(), 'data');
});

it('should create a new task for auth user from api', function () {
    $user = User::factory()->create();

    $this
        ->actingAs($user)
        ->post('/api/v1/tasks', [
            'title' => 'New Task',
            'description' => 'Task description',
        ]);

    assertDatabaseHas(Task::class, [
        'title' => 'New Task',
        'description' => 'Task description',
        'completed' => false,
    ]);
});

it('should retrieve an specific task for auth user from api', function () {
    $user = User::factory()->create();

    $allTasks = Task::factory(10)->create([
        'created_by' => $user->id,
    ]);

    $randomTask = $allTasks->random();

    $response = $this
        ->actingAs($user)
        ->get("/api/v1/tasks/$randomTask->id", []);

    $response->assertJsonFragment([
        'data' => [
            'id' => $randomTask->id,
            'created_by' => $randomTask->created_by,
            'title' => $randomTask->title,
            'description' => $randomTask->description,
            'completed' => $randomTask->completed,
            'created_at' => $randomTask->created_at->format('m-d-Y'),
            'updated_at' => $randomTask->updated_at->format('m-d-Y'),
            'attachments' => [],
        ],
    ]);
});

it('should update an specific task for auth user from api', function () {
    $user = User::factory()->create();

    $allTasks = Task::factory(10)->create([
        'created_by' => $user->id,
    ]);

    $randomTask = $allTasks->random();

    $expectedEditedTask = [
        'id' => $randomTask->id,
        'title' => 'Edited Task',
        'description' => 'Edited task description',
        'created_by' => $randomTask->created_by,
        'completed' => $randomTask->completed,
        'created_at' => $randomTask->created_at->format('m-d-Y'),
        'updated_at' => $randomTask->updated_at->format('m-d-Y'),
        'attachments' => [],
    ];

    $response = $this
        ->actingAs($user)
        ->put("/api/v1/tasks/$randomTask->id", [
            'title' => 'Edited Task',
            'description' => 'Edited task description',
        ]);

    $response->assertJsonFragment([
        'data' => $expectedEditedTask,
    ]);
});

it('should mark a specific task for auth  user  as completed from api', function () {
    $user = User::factory()->create();
    $task = Task::factory()->create();

    assertTrue(! $task->completed);

    $this
        ->actingAs($user)
        ->patch("/api/v1/tasks/$task->id/complete", [
            'completed' => true,
        ]);

    assertDatabaseHas(Task::class, [
        'completed' => true,
    ]);
});

it('should delete an specific task for auth user from api', function () {
    $user = User::factory()->create();

    $allTasks = Task::factory(10)->create([
        'created_by' => $user->id,
    ]);

    $randomTask = $allTasks->random();

    $this->actingAs($user)
        ->delete("/api/v1/tasks/$randomTask->id", []);

    assertDatabaseMissing(Task::class, [
        'id' => $randomTask->id,
    ]);
});
