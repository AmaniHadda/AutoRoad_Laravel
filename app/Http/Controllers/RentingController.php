<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceEmail;
use App\Models\Invoice;
use App\Models\Renting;
use App\Models\Vehicle;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Stripe;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RentingController extends Controller
{
    public function paiement($vehicle, Request $request)
    {
        $rentedDates = Renting::where('vehicle_id', $vehicle)->pluck('PUD')->toArray();

        return view('FrontOffice.Location.paiement', compact('vehicle','rentedDates'));
    }
    public function stripebackoffice(Request $request, $vehicle)
    {
        $vehicledetails = Vehicle::findOrFail($vehicle);
    
        $validator = Validator::make($request->all(), [
            'PUD' => 'required|date|after_or_equal:today',
            'PUT' => 'required|date_format:H:i',
            'offerType' => 'required|in:hour,day',
            'NbreHours' => 'required_without:NbreDays|nullable|min:1',
            'NbreDays' => 'required_without:NbreHours|nullable|min:1',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
    
        $NbreHours = $request->input('NbreHours', 0);
        $NbreDays = $request->input('NbreDays', 0);
    
        $PUD = Carbon::parse($request->input('PUD'));
        $PUT = Carbon::createFromFormat('H:i', $request->input('PUT'));
        $DOD = $PUD->copy();
        $DOD->setTimeFromTimeString($PUT->format('H:i'));
    
        if ($NbreHours > 0) {
            $DOD->addHours($NbreHours);
        } elseif ($NbreDays > 0) {
            $DOD->addDays($NbreDays);
        }
    
        $rentingPrice = ($NbreHours * $vehicledetails->Price) + ($NbreDays * $vehicledetails->PriceDay);
    
        $rentingData = [
            'PUD' => $PUD,
            'DOD' => $DOD,
            'PUT' => $PUT,
            'Confirmation' => 'not_payed',
            'NbreHours' => $NbreHours,
            'NbreDays' => $NbreDays,
            'vehicle_id' => $vehicle,
            'rentingPrice' => $rentingPrice,
            'user_id' => auth()->id(),
        ];
        Renting::create($rentingData);
    
        $now = now()->toDateString();
        $PUD = $PUD->toDateString();
    
        if ($PUD === $now) {
            $vehicledetails->Status = 'Rented';
            $vehicledetails->Current_Owner=auth()->user()->name;
            $vehicledetails->save();
        }
    
        return redirect('/admin/Rentings');
    }
    public function stripe(Request $request, $vehicle)
    {
        $vehicledetails = Vehicle::findOrFail($vehicle);
        $formvalidation = Validator::make($request->all(), [
            'PUD' => 'required|date|after_or_equal:today',
            'PUT' => 'required|date_format:H:i',
            'offerType' => 'required|in:hour,day',
            'NbreHours' => 'required_without:NbreDays|nullable|min:1',
            'NbreDays' => 'required_without:NbreHours|nullable|min:1',
        ]);
        
        if ($formvalidation->fails()) {
            return redirect()->back()
                ->withErrors($formvalidation)
                ->withInput();
        }
        
        $NbreHours = $request->input('NbreHours', 0);
        $NbreDays = $request->input('NbreDays', 0);

        $PUD = Carbon::parse($request->input('PUD'));
        $PUT = Carbon::createFromFormat('H:i', $request->input('PUT'));
        $DOD = $PUD->copy();
        $DOD->setTimeFromTimeString($PUT->format('H:i'));

        if ($NbreHours > 0) {
            $DOD->addHours($NbreHours);
        } elseif ($NbreDays > 0) {
            $DOD->addDays($NbreDays);
        }
        $rentingPrice = ($NbreHours * $vehicledetails->Price) + ($NbreDays * $vehicledetails->PriceDay);

        $rentingData = [
            'PUD' => $PUD,
            'DOD' => $DOD,
            'PUT' => $PUT,
            'Confirmation' => 'not_payed',
            'NbreHours' => $NbreHours,
            'NbreDays' => $NbreDays,
            'vehicle_id' => $vehicle,
            'rentingPrice' => $rentingPrice,
            'user_id' => auth()->id(),
        ];
        Renting::create($rentingData);
        $now = date('Y-m-d');
        $PUD = date('Y-m-d', strtotime($PUD));
        $rentedDates = Renting::where('vehicle_id', $vehicle)->pluck('PUD')->toArray();
        if ($PUD === $now) {
            $vehicledetails->Status = 'Rented';
            $vehicledetails->Current_Owner=auth()->user()->name;
            $vehicledetails->save();
        }
        return view('FrontOffice.location.paiement', compact('rentingPrice','vehicle','rentedDates'));
    }
    public function stripePaiementInterface($rentingPrice, $vehicle)
    {
        return view('FrontOffice.Location.stripe', compact('rentingPrice'), compact('vehicle'));
    }
    public function generateInvoice($renting, $invoiceAmount)
    {
        $data = [
            'invoice' => (object)[
                'created_at' => now(),
                'amount' => $invoiceAmount,
            ],
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'user_id' => auth()->id(),
            'renting' => $renting,
        ];

        $pdf = PDF::loadView('invoices.invoice_template', $data);
        $pdfContent = $pdf->output();
        $fileName = 'invoice_' . time() . '.pdf';

        Storage::disk('local')->put('uploads/' . $fileName, $pdfContent);

        return $fileName;
    }
    public function stripePost(Request $request, $rentingPrice)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = Stripe\Charge::create([
                "amount" => $rentingPrice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thank you for paying",
            ]);
            $renting = Renting::where('rentingPrice', $rentingPrice)->first();

            if ($renting) {
                $renting->Confirmation = 'payed';
                $renting->save();
                $fileName = $this->generateInvoice($renting, $rentingPrice);
                Mail::to(auth()->user()->email)->send(new InvoiceEmail($fileName));

                Session::flash('success', 'Payment successful!');
            } else {
                Session::flash('error', 'Renting not found for the given price.');
            }

            return view('FrontOffice.Location.stripe', compact('rentingPrice'));
        } catch (Exception $e) {
            Session::flash('error', 'Payment failed. Please try again.');

            return view('FrontOffice.Location.stripe', compact('rentingPrice'));
        }
    }
    public function getEditRenting($Renting_id)
    {
        $Rent = Renting::find($Renting_id);
        return view('BackOffice.Renting.UpdateRenting', compact('Rent'));
    }
    public function update(Request $request, $Renting_id)
    {
        $formvalidation = Validator::make($request->all(), [
            'PUD' => 'required|date|after_or_equal:today',
            'PUT' => 'required',
            'NbreHours' => 'required_without:NbreDays|nullable|min:1',
            'NbreDays' => 'required_without:NbreHours|nullable|min:1',
        ]);
        
        if ($formvalidation->fails()) {
            return redirect()->back()
                ->withErrors($formvalidation)
                ->withInput();
        }
        $Renting = Renting::findOrFail($Renting_id);
        $NbreHours = $Renting->NbreHours = $request->input('NbreHours');
        $NbreDays = $Renting->NbreDays = $request->input('NbreDays');
        $Renting->PUD = $request->input('PUD');
        $Renting->PUT = $request->input('PUT');
        $Renting->rentingPrice = ($NbreHours * $Renting->vehicle->Price) + ($NbreDays * $Renting->vehicle->PriceDay);
        $Renting->Confirmation = $request->input('Confirmation');
        $Renting->STATUS = $request->input('STATUS');
        $Renting['user_id'] = auth()->id();
        $Renting->save();
        return redirect('/admin/Rentings');
    }
    public function delete($Renting_id)
    {
        $Renting = Renting::find($Renting_id);
        $Renting->vehicle->update(['Status' => 'Available']);
        $Renting->delete();

        return redirect('/admin/Rentings')->with('success', 'Renting deleted successfully');
    }
    public function getaddRenting($Vehicle_id)
    {
        return view('BackOffice.Renting.AddRenting', compact('Vehicle_id'));
    }
}
