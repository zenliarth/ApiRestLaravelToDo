<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreAttachmentRequest;
use App\Http\Resources\AttachmentResource;
use App\Models\Attachment;
use App\Models\Task;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StoreAttachmentController extends BaseController
{
    public function __invoke(StoreAttachmentRequest $request, Task $task)
    {
        $allowedToCreate = Task::query()
            ->whereId($task->id)
            ->whereCreatedBy(auth()->user()->id)
            ->exists();

        if (! $allowedToCreate) {
            return $this->sendError('Action not authorized.', [], Response::HTTP_FORBIDDEN);
        }

        if ($request->hasFile('attachments')) {
            $attachments = [];

            foreach ($request->file('attachments') as $attachment) {
                $mimeType = $attachment->getClientMimeType();
                $isImage = strpos($mimeType, 'image/') === 0;

                if ($isImage) {
                    $extension = $attachment->getClientOriginalExtension();
                    $fileName = Str::random(36).".$extension";

                    $path = $attachment->storeAs('attachments', $fileName, 'public');

                    $filePath = Storage::disk('public')->url($path);

                    $attachment = Attachment::query()->create([
                        'task_id' => $task->id,
                        'name' => $fileName,
                        'path' => $filePath,
                        'type' => $extension,
                    ]);

                    $attachments[] = $attachment;
                }
            }

            return $this->sendResponse(
                AttachmentResource::collection($attachments),
                'Attachment successfully uploaded'
            );
        }
    }
}
