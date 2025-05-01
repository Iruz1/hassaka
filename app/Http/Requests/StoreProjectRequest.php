<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return in_array(auth()->user()->role->name, ['admin', 'owner']);
    }

    public function rules(): array
    {
        return [
            'date' => 'required|date',
            'project_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'marketing_id' => 'nullable|exists:users,id'
        ];
    }
}
