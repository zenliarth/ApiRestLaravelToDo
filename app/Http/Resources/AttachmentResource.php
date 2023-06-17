<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttachmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'task_id' => $this->task_id,
            'path' => $this->path,
            'type' => $this->type,
            'created_at' => $this->created_at->format('m-d-Y'),
            'updated_at' => $this->updated_at->format('m-d-Y'),
        ];
    }
}
