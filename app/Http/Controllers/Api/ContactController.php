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
        $paginate = request('paginate');
        $search_term = request('q', '');

        $sort_direction = request('sort_direction');
        $sort_field = request('sort_field');

        $selectedStatus = request('selectedStatus');

        $contact = Contact::select([
            'contacts.*',
            'contact_statuses.name as status_name',
            'contact_types.name as type_name',
            'users.name as user_name',
            'contact_categories.name as category_name',
            'contact_industries.name as industry_name'
        ])          
            ->join('contact_statuses', 'contacts.status_id', '=', 'contact_statuses.id')
            ->join('contact_types', 'contacts.type_id', '=', 'contact_types.id')
            ->join('contact_categories', 'contacts.category_id', '=', 'contact_categories.id')
            ->join('contact_industries', 'contacts.industry_id', '=', 'contact_industries.id')
            ->join('users', 'contacts.user_id', '=', 'users.id')
            ->when($selectedStatus, function ($query) use ($selectedStatus) {
                $query->where('contacts.status_id', $selectedStatus);
            })                       
            ->orderBy($sort_field, $sort_direction)
            ->search(trim($search_term))
            ->distinct()
            ->paginate($paginate);

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
        $contact = Contact::find($id);
        return response()->json(["data"=> $contact]);
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
            'industry_id' => $request->industry_id,
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
        $contact = Contact::with('category', 'type', 'status', 'incharge', 'user', 'todo', 'industry')
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