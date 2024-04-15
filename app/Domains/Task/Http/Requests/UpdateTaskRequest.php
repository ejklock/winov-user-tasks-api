<?php

namespace App\Domains\Task\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{


    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:512'],
            'completed_at' => ['nullable', 'date', 'before_or_equal:now'],
        ];
    }
}
