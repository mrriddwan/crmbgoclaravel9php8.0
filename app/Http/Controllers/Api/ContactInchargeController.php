<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactIncharge;
use Illuminate\Http\Request;
use App\Http\Resources\ContactInchargeResource;


class InchargeController extends Controller
{
    public function index()
    {
        $incharge = (ContactIncharge::with('contact'))->get();

        return ContactInchargeResource::collection($incharge);
    }

    public function store(Request $request)
    {
        $contact = ContactIncharge::create($request->validated());

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

    public function update(Request $request, ContactIncharge $incharge)
    {   
        $incharge->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_mobile' => $request->phone_mobile,
            'phone_office' => $request->phone_office,
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
