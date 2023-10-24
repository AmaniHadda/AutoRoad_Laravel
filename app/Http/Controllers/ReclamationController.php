<?php

namespace App\Http\Controllers;
use App\Mail\DriverNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Reclamation;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class ReclamationController extends Controller
{
    // Display a list of reclamations
    public function index()
    {
        $reclamations = Reclamation::all();
        $drivers = User::where('role', 'driver')->get(); // Assuming 'driver' is the role name for drivers
        return view('FrontOffice.reclamations.index', compact('reclamations', 'drivers'));
    }
    


    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'reclamationSubject' => 'required|string',
            'reclamationMessage' => 'required|string',
            'driver' => 'required',
        ]);
    
        $user = Auth::user();
    
        // Check if the user has the "driver" role based on your role attribute
        if ($user->role === 'driver') {
            $driverName = $user->name;
        } else {
            $driver = User::find($validatedData['driver']);
            $driverName = $driver->name;
        }
    
        $validatedData['user_id'] = $user->id;
        $validatedData['subject'] = $validatedData['reclamationSubject'];
        $validatedData['message'] = $validatedData['reclamationMessage'];
        $validatedData['driver_name'] = $driverName; // Set the 'driver_name' attribute
    
        Reclamation::create($validatedData);
    
        return redirect()->route('reclamations')->with('success', 'Reclamation created successfully');
    }
    
    
    
    public function edit(Reclamation $reclamation)
    {
        return view('FrontOffice.reclamations.edit', compact('reclamation'));
    }

    public function update(Request $request, Reclamation $reclamation)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        $reclamation->update($validatedData);

        return redirect()->route('FrontOffice.reclamations.index')->with('success', 'Reclamation updated successfully');
    }

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