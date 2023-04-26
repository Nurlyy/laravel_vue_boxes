<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactsController extends Controller
{

    public function saveContacts(Request $request){
        // return $request;
        $phone_number = $request->phone_number;
        $email = $request->email;
        $address = $request->address;

        $contact = Contact::findById(0);
        $contact->update([
            'phone_number' => $phone_number,
            'email' => $email,
            'address' => $address
        ]);
        return response()->json(['contacts' => $contact]);
    }

    public function getContacts(){
        return response()->json(['contacts' => Contact::all()->first()]);
    }

}