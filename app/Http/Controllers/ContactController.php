<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return response()->json($contacts);
    }

    public function updateContact(Request $request){
        if($request->isMethod('post')){

            $contact = Contact::findById($request->id);

            $phone_number = $request->phone_number;
            $email = $request->email;
            $address = $request->address;

            $contact->phone_number = $phone_number;
            $contact->email = $email;
            $contact->address = $address;
            if($contact->save()){
                return 'true';
            }
        }
    }
}