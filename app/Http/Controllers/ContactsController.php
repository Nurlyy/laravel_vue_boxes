<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactsController extends Controller
{

    public function saveContacts(Request $request){
        $username = $request->username;
        $email = $request->email;
        $address = $request->address;

        $contact = Contact::all()->first();
        $contact->update([
            'username' => $username,
            'email' => $email,
            'address' => $address
        ]);
        return response()->json(['contacts' => $contact]);
    }

    public function getContacts(){
        return response()->json(['contacts' => Contact::all()->first()]);
    }

}