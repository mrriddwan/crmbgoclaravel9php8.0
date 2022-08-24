<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;


class ContactController extends Controller
{
    public function index()
    {
        // $contacts = Contact::with('category', 'type', 'status', 'incharge', 'user')->paginate(10);
        // $contact = Contact::with('category', 'type', 'status', 'incharge', 'user')->get();
        $contact = (Contact::with('category', 'type', 'status', 'incharge', 'user'))->get();

        return ContactResource::collection($contact);
    }

    public function store(Request $request)
    {
        $contact = Contact::create($request->validated());

        return new ContactResource($contact);
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
            'user' => $request->user_id,
            'status' => $request->status_id,
            'type' => $request->type,
            'industry' => $request->industry,
            'company_name' => $request->company_name,
            'category' => $request->category_id,
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

}