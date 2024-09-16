<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'provided_by' => ['required', 'string'],
            'start_at' => ['required', 'date'],
            'end_at' => ['required', 'date'],
            'status' => ['required', 'in:hold,pending,in_progress,completed'],
            'timestamp' => ['required', 'string'],
        ];
    }
}
