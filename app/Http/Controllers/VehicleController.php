<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function addvehicle(Request $request)
    {
        $formvalidation = $request->validate([
            'Model' => 'required',
            'Vehicle_Condition' => 'required',
            'Color' => 'required',
            'Image' => 'required|mimes:jpg,png,jpeg,svg|max:5048',
            'Price' => 'required',
            'Fuel_Type' => 'required',
            'Fuel_Consumption' => 'required',
            'Features' => 'required',
        ]);
        $newImg = uniqid() . '-Vehicle' . '.' . $request->Image->extension();
        $request->Image->move(public_path('images/Vehicles'), $newImg);
        $formvalidation['Image'] = $newImg;
        $formvalidation['PriceDay'] = $formvalidation['Price'] * 20;
        $formvalidation['user_id'] = auth()->id();
        Vehicle::create($formvalidation);
        return redirect('/admin/vehicules');
    }
    public function getaddvehicle()
    {
        return view('BackOffice.Vehicle.AddVehicleForm');
    }
    public function getEditvehicle($Vehicle_id)
    {
        $Vehicle = Vehicle::find($Vehicle_id);
        return view('BackOffice.Vehicle.EditVehicle', compact('Vehicle'));
    }
    public function Editvehicle(Request $request, $Vehicle_id)
    {
        $formvalidation = $request->validate([
            'Model' => 'required',
            'Vehicle_Condition' => 'required',
            'Color' => 'required',
            'Image' => 'image|mimes:jpg,png,jpeg,svg|max:5048',
            'Price' => 'required',
            'Fuel_Type' => 'required',
            'Fuel_Consumption' => 'required',
            'Features' => 'required',
            'Status' => 'required',
            'Current_Owner' => 'required',
        ]);

        $vehicle = Vehicle::find($Vehicle_id);

        if ($request->hasFile('Image')) {
            if (file_exists(public_path('images/Vehicles/' . $vehicle->Image))) {
                unlink(public_path('images/Vehicles/' . $vehicle->Image));
            }
            $newImg = uniqid() . '-Vehicle' . '.' . $request->Image->extension();
            $request->Image->move(public_path('images/Vehicles'), $newImg);
            $vehicle->Image = $newImg;
        }
        $vehicle->Model = $formvalidation['Model'];
        $vehicle->Vehicle_Condition = $formvalidation['Vehicle_Condition'];
        $vehicle->Color = $formvalidation['Color'];
        $vehicle->Price = $formvalidation['Price'];
        $vehicle->Fuel_Type = $formvalidation['Fuel_Type'];
        $vehicle->Fuel_Consumption = $formvalidation['Fuel_Consumption'];
        $vehicle->Features = $formvalidation['Features'];
        $vehicle->Status = $formvalidation['Status'];
        $vehicle->Current_Owner = $formvalidation['Current_Owner'];
        $vehicle['user_id'] = auth()->id();

        $vehicle->save();
        return redirect('/admin/vehicules');
    }
    public function deletevehicule($Vehicle_id)
    {
        Vehicle::where('id', $Vehicle_id)->delete();
        return redirect('/admin/vehicules');
    }
    public function ShowVehicle($Vehicle_id)
    {
        $vehicle = Vehicle::find($Vehicle_id);
        return view('BackOffice.Vehicle.DetailsVehicle', compact('vehicle'));
    }
    public function Show($Vehicle_id)
    {
        $vehicle = Vehicle::find($Vehicle_id);

        return view('FrontOffice.Vehicle.details', compact('vehicle'));
    }
    public function filterVehicles(Request $request)
    {
        $query = Vehicle::query();

        // Filter by Model
        if ($request->input('Model')) {
            $query->where('Model', $request->input('Model'));
        }

        // Filter by Price
        if ($request->input('Price')) {
            $query->where('Price', '<=', $request->input('Price'));
        }

        // Filter by Fuel_Type
        if ($request->input('Fuel_Type')) {
            $query->where('Fuel_Type', $request->input('Fuel_Type'));
        }

        // Execute the query
        $listvehicules = $query->get();

        // If no filters are applied, retrieve all vehicles
        if (!$request->hasAny(['Model', 'Price', 'Fuel_Type'])) {
            $listvehicules = Vehicle::all();
        }

        return view('FrontOffice.pricing', compact('listvehicules'));
    }
    public function clearFilters(Request $request)
    {
        $request->merge([
            'Model' => null,
            'Price' => null,
            'Fuel_Type' => null,
        ]);
        $listvehicules = Vehicle::all();

        return view('FrontOffice.pricing', compact('listvehicules'));
    }
}
