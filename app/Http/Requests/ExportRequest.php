<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExportRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->hasAnyRole(['admin', 'marketing']);
    }

    public function rules()
    {
        return [
            'platform' => 'nullable|in:tiktok,instagram',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date'
        ];
    }
}
