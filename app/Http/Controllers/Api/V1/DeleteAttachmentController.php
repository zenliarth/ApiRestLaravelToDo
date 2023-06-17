<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Task;
use App\Models\Attachment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DeleteAttachmentController extends Controller
{
    public function __invoke(Request $request, Attachment $attachment)
    {
        $user = auth()->user();

        $allowedToDelete = Task::query()
            ->whereId($attachment->task_id)
            ->whereCreatedBy($user->id)
            ->exists();

        if (! $allowedToDelete) {
            return $this->sendError('Action not authorized.', [], Response::HTTP_FORBIDDEN);
        }

        $attachment->delete();

        $path = Str::after($attachment->path, 'storage/');

        Storage::disk('public')->delete($path);

        return response()->noContent();
    }
}
