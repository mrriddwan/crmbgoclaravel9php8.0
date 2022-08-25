<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ContactController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        // $contacts = Contact::with('category', 'type', 'status', 'incharge', 'user')->paginate(10);
        // $contact = Contact::with('category', 'type', 'status', 'incharge', 'user')->get();
        $contact = (Contact::with('category', 'type', 'status', 'incharge', 'user'))->paginate(10);

        return ContactResource::collection($contact);
    }

    public function store(Request $request)
    {
        // $contact = Contact::create($request->validated());

        // return new ContactResource($contact);
        

        $contact = Contact::create([
            'industry' => $request->industry,
            'name' => $request->name,
            'address' => $request->address,
            'remark' => $request->remark,
            'category_id' => $request->category_id,
            'user_id' => 1,
            'type_id' => $request->type_id,
            'status_id' => $request->status_id,
        ]);

        return response()->json([
            'data' => $contact,
            'status' => true,
            'message' => 'Successfully store employee',
        ]);
    }
    public function show($id)
    {   
        // $data = Contact::with('category', 'type', 'status', 'incharge', 'user')
        //         ->where('id', $contact->id)
        //         ->toArray()
        //         ->get();

        // return response()->json([
        //     'status' => true,
        //     'message' => 'Successfully fetch data Contact ',
        //     'data' => $data,
        // ]);

        $contact = Contact::find($id);
        return response()->json($contact);
    }

    public function update(Request $request, Contact $contact)
    {   
        $contact->update([
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
            'message' => 'Successfully fetch data Contact ' . $contact->name,
            'data' => $contact,
        ]);
    }

    public function delete(Contact $contact)
    {
        $contact->delete();
        return response()->json('Contact deleted.');
    }

    public function info(Contact $contact)
    {   
        $contact = Contact::with('category', 'type', 'status', 'incharge', 'user')
                ->where('id', $contact->id)
                ->get();

        $data = $contact->toArray();

        return response()->json([
            'status' => true,
            'message' => 'Successfully fetch data Contact ',
            'data' => $data,
        ]);
    }

}