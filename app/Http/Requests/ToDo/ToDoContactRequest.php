<?php

namespace App\Http\Requests\ToDo;

use Illuminate\Foundation\Http\FormRequest;

class ToDoContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'todo_created' => ['required', 'date'],
            'contact_id'=> ['required', 'int'],
            'user_id' => ['required', 'int'],
            'task_id'=> ['required', 'int'],
        ];
    }
}
