<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContactTypeResource;
use App\Models\ContactType;
use Illuminate\Http\Request;

class ContactTypeController extends Controller
{
    public function index()
    {
        return ContactTypeResource::collection(ContactType::all());
    }
}
