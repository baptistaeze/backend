<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function index()
    {
        return Contact::latest()->paginate(10);
    }

    public function store(Request $request)
    {
        Contact::create($request->only('name', 'email', 'message'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
    }
}
