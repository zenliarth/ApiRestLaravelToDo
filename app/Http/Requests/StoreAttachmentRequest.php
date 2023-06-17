<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttachmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'task' => 'exists:tasks,id',
            'attachments' => 'required|array',
            'attachments.*' => 'image|mimes:jpeg,png,jpg,webp,svg|max:2048',
        ];
    }
}
