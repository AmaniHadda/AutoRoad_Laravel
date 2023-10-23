<?php

namespace App\Http\Controllers;

use App\Mail\NewContactEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\risque;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class contactController extends Controller
{
    public function ContactsAdmin()
    {
        $donnees = Contact::all();
        return view('listContact', compact('donnees'));
    }
    public function getContact()
    {
        $ajoutContact = Contact::all();
        Log::info($ajoutContact);
        return view('BackOffice.listContact', ['donnees' => $ajoutContact]);
    }
    public function addContact(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:contacts',
            'subject' => 'required',
            'risque_id' => 'required|exists:risques,id',
            'message' => 'required',
        ]);

        $contact = new Contact;
        $contact->name = $req->input('name');
        $contact->email = $req->input('email');
        $contact->subject = $req->input('subject');
        $contact->risque_id = (int) $req->input('risque_id');
        $contact->message = $req->input('message');
        $contact->user_id = auth()->id();
        $contact->save();
        $categoryTitle = Risque::find($req->input('risque_id'))->categorie;
        Mail::send(new NewContactEmail($contact, $categoryTitle));
        return redirect('/')->with('success', 'Contact ajouté avec succès.');
    }
    public function searchContacts(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        $results = Contact::where('email', 'LIKE', "%$searchTerm%")->get();
        return response()->json($results);
    }
    public function updatecontact(Request $req)
    {
        $contact = Contact::find($req->id);
        $req->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);
        if ($contact) {
            $contact->name = $req->name;
            $contact->email = $req->email;
            $contact->subject = $req->subject;
            $contact->message = $req->message;
            $contact->save();

            return redirect('admin/listContact');
        } else {
            return redirect('admin/listContact')->with('error', 'Risque non trouvé.');
        }
    }
    public function getContactId($id)
    {
        $dataContactShow = Contact::find($id);
        return view('BackOffice.modifContact', ['donnees' => $dataContactShow]);
    }
    public function suppContact($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return redirect('admin/listContact');
    }
    public function deleteContact($id)
    {
        $datacontactDelete = Contact::find($id);
        $datacontactDelete->delete();
        return redirect('listContact');
    }
    // public function chart()
    // {
    //     $contactsData = Contact::whereYear('created_at', 2023)->get();
    //     $totalContacts = $contactsData->count();

    //     return view('BackOffice.dashboard', compact('contactsData', 'totalContacts'));
    // }
}
