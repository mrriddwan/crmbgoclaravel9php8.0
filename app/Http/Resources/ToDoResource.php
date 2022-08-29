<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ToDoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'todo_created' => $this->todo_created,
            'todo_deadline' => $this->todo_deadline,
            'remark' => substr($this->remark, 0, 20) . '...',
            'user' => $this->user->only('id', 'name'),
            'task' => $this->task->only('id', 'name'),
            'status' => $this->status->only('id', 'name'),
            'type' => $this->type->only('id', 'name'),
            'color' => $this->color->only('id', 'color_code'),
            
        ];
    }
}
