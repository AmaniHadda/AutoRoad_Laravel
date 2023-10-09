<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reclamation;
use Illuminate\Support\Facades\Auth;


class ReclamationController extends Controller
{
    // Display a list of reclamations
    public function index()
    {
        $reclamations = Reclamation::all();
        return view('FrontOffice.reclamations.index', compact('reclamations'));
    }

    // Show the form for creating a new reclamation
    public function create()
    {
        return view('FrontOffice.reclamations.create');
    }

    // Store a newly created reclamation in the database
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'reclamationSubject' => 'required|string',
            'reclamationMessage' => 'required|string',
            // Add more validation rules as needed
        ]);
    
        // Add 'user_id' to the validated data
        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['subject']= $validatedData['reclamationSubject'];
        $validatedData['message']= $validatedData['reclamationMessage'];

        // Create the reclamation with the updated data
        Reclamation::create($validatedData);

    
        return redirect()->route('reclamations')->with('success', 'Reclamation created successfully');
    }
    
    
    // Show the form for editing a reclamation
    public function edit(Reclamation $reclamation)
    {
        return view('FrontOffice.reclamations.edit', compact('reclamation'));
    }

    // Update the specified reclamation in the database
    public function update(Request $request, Reclamation $reclamation)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'subject' => 'required|string',
            'message' => 'required|string',
            // Add more validation rules as needed
        ]);

        $reclamation->update($validatedData);

        return redirect()->route('FrontOffice.reclamations.index')->with('success', 'Reclamation updated successfully');
    }

    // Remove the specified reclamation from the database
    public function destroy(Reclamation $reclamation)
    {
        $reclamation->delete();

        return redirect()->back()->with('success', 'Reclamation deleted successfully.');
    }


    public function markAsTreated($id)
    {
        $reclamation = Reclamation::findOrFail($id);
        $reclamation->treated = true;
        $reclamation->save();
        
        return redirect()->back()->with('success', 'Reclamation marked as treated.');
    }
    
    public function markAsNotTreated($id)
    {
        $reclamation = Reclamation::findOrFail($id);
        $reclamation->treated = false;
        $reclamation->save();
        
        return redirect()->back()->with('success', 'Reclamation marked as not treated.');
    }



}