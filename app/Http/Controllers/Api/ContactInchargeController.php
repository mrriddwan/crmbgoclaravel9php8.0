<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\ContactInchargeRequest;
use Illuminate\Http\Request;
use App\Models\ContactIncharge;
use App\Http\Resources\ContactInchargeResource;

class ContactInchargeController extends Controller
{
    public function index()
    {
        $incharge = (ContactIncharge::with('contact'))->get();

        return ContactInchargeResource::collection($incharge);
    }

    public function store(ContactInchargeRequest $request)
    {
        $contact = ContactIncharge::create(
            $request->validated()
        );

        return new ContactInchargeResource($contact);
    }
    
    public function show(ContactIncharge $incharge)
    {   
        $data = ContactIncharge::with('contact')
                ->where('id', $incharge->id)
                ->get();


        return response()->json([
            'status' => true,
            'message' => 'Successfully fetch data Contact PIC ',
            'data' => $data,
        ]);
    }

    public function update(ContactInchargeRequest $request, ContactIncharge $incharge)
    {   
        $incharge->update([
            $request->validated()
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Successfully fetch data Contact ' . $incharge->name,
            'data' => $incharge,
        ]);
    }

    public function delete(ContactIncharge $incharge)
    {
        $incharge->delete();
        return response()->json('Contact PIC deleted.');
    }
}
