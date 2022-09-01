<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ToDoResource;
use App\Models\ToDo;
use Illuminate\Http\Request;

class ToDoController extends Controller
{
    public function index()
    {
        $paginate = request('paginate');
        $search_term = request('q', '');

        $sort_direction = request('sort_direction');
        $sort_field = request('sort_field');

        $selectedStatus = request('selectedStatus');

        $todo = ToDo::select([
            'to_dos.*',
            'contact_statuses.name as status_name',
            'contact_types.name as type_name',
            'users.name as user_name',
            'tasks.name as task_name',
            'priorities.name as priority_name',
            'text_colors.color_code as color_name',
            'contacts.name as contact_name'
        ])
            ->join('contacts', 'to_dos.contact_id', '=', 'contacts.id')
            ->join('contact_statuses', 'to_dos.status_id', '=', 'contact_statuses.id')
            ->join('contact_types', 'to_dos.type_id', '=', 'contact_types.id')
            ->join('tasks', 'to_dos.task_id', '=', 'tasks.id')
            ->join('priorities', 'to_dos.priority_id', '=', 'priorities.id')
            ->join('users', 'to_dos.user_id', '=', 'users.id')
            ->join('text_colors', 'to_dos.color_id', '=', 'text_colors.id')
            ->when($selectedStatus, function ($query) use ($selectedStatus) {
                $query->where('to_dos.status_id', $selectedStatus);
            })            
            
            ->orderBy($sort_field, $sort_direction)
            ->search(trim($search_term))
            ->paginate($paginate);

        return ToDoResource::collection($todo);
    }

    public function store(Request $request)
    {
        // $contact = Contact::create($request->validated());

        // return new ContactResource($contact);


        $todo = ToDo::create([
            'priority_id' => $request->priority_id,
            'user_id' => $request->user_id,
            'todo_created' => $request->todo_created,
            'todo_deadline' => $request->todo_deadline,
            'status_id' => $request->status_id,
            'contact_id' => $request->contact_id,
            'type_id' => $request->type_id,
            'task_id' => $request->task_id,
            'remark' => $request->remark,
            'color_id' => $request->color_id ?? '1',
        ]);

        return response()->json([
            'data' => $todo,
            'status' => true,
            'message' => 'Successfully store employee',
        ]);
    }

    public function insert(Request $request)
    {
        // $contact = Contact::create($request->validated());

        // return new ContactResource($contact);


        $todo = ToDo::create([
            'priority_id' => $request->priority_id,
            'todo_created' => $request->todo_created,
            'contact_id' => $request->contact_id,
            'user_id' => $request->user_id,
            'task_id' => $request->task_id,
            'status_id' => $request->status_id,
            'type_id' => $request->type_id,
            'remark' => $request->remark,
            'color_id' => $request->color_id ?? '1',
        ]);

        return response()->json([
            'data' => $todo,
            'status' => true,
            'message' => 'Successfully store employee',
        ]);
    }
    public function show($id)
    {
        $todo = ToDo::find($id);
        return response()->json(['data' => $todo]);
    }

    public function new(ToDo $todo)
    {
        return new ToDoResource($todo);
    }

    public function update(Request $request, ToDo $todo)
    {
        $todo->update([
            'priority_id' => $request->priority_id,
            'date_created' => $request->todo_created,
            'contact_id' => $request->contact_id,
            'user_id' => $request->user_id,
            'task_id' => $request->task_id,
            'status_id' => $request->status_id,
            'type_id' => $request->type_id,
            'remark' => $request->remark,
        ]);


        return response()->json([
            'status' => true,
            'message' => 'Successfully update data To Do ' . $todo->name,
            'data' => $todo,
        ]);
    }

    public function delete(ToDo $todo)
    {
        $todo->delete();
        return response()->json('Contact deleted.');
    }
}
