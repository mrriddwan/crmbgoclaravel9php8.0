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
        // $contacts = Contact::with('category', 'type', 'status', 'incharge', 'user')->paginate(10);
        // $contact = (Contact::with('category', 'type', 'status', 'incharge', 'user'))->paginate(100);
        $todo = ToDo::with('contact', 'user', 'task', 'status', 'type', 'priority', 'color')->get();
        

        return ToDoResource::collection($todo);
    }


    public function insert(Request $request)
    {
        // $contact = Contact::create($request->validated());

        // return new ContactResource($contact);
        

        $todo = ToDo::create([
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
            'data' => $todo,
            'status' => true,
            'message' => 'Successfully store employee',
        ]);
    }
    public function show($id)
    {   
        $todo = ToDo::find($id);
        return response()->json($todo);
    }

    public function new(ToDo $todo){
            return new ToDoResource($todo);    
    }

    public function update(Request $request, ToDo $todo)
    {   
        $todo->update([
            'user_id' => $request->user_id,
            'status_id' => $request->status_id,
            'type_id' => $request->type_id,
            'industry' => $request->industry,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'address' => $request->address,
            'remark' => $request->remark,
        ]);


        return response()->json([
            'status' => true,
            'message' => 'Successfully fetch data Contact ' . $todo->name,
            'data' => $todo,
        ]);
    }

    public function delete(ToDo $todo)
    {
        $todo->delete();
        return response()->json('Contact deleted.');
    }
}
