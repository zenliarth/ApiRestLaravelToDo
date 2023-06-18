<?php

use App\Models\Attachment;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;

it('should create a new attachment for a task for auth user from api', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    $task = Task::factory()->create([
        'created_by' => $user->id,
    ]);

    $file = UploadedFile::fake()->create('image.png', 256);

    $this
        ->actingAs($user)
        ->post("/api/v1/tasks/$task->id/attachments", [
            'attachments' => [$file],
        ]);

    assertDatabaseHas(Attachment::class, [
        'task_id' => $task->id,
        'type' => 'png',
    ]);
});

it('should delete a new attachment for a task for auth user from api', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    $task = Task::factory()->create([
        'created_by' => $user->id,
    ]);

    $file = UploadedFile::fake()->create('image.png', 256);

    $this
        ->actingAs($user)
        ->post("/api/v1/tasks/$task->id/attachments", [
            'attachments' => [$file],
        ]);

    assertDatabaseHas(Attachment::class, [
        'task_id' => $task->id,
        'type' => 'png',
    ]);

    $attachment = $task->attachments->first();

    $response = $this
        ->actingAs($user)
        ->delete("/api/v1/attachments/$attachment->id", []);

    $response->assertSuccessful();

    assertDatabaseMissing(Attachment::class, [
        'task_id' => $task->id,
        'type' => 'png',
    ]);
});
