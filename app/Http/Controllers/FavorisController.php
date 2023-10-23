<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Favoris;
use Illuminate\Http\Request;

class FavorisController extends Controller
{

    public function index()
    {
        $favoris = Favoris::get()->where('user_id', auth()->user()->id);

        return view('FrontOffice.favoris', compact('favoris'));

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $Favoris = Favoris::get()->where('user_id', auth()->user()->id);
        $intNumber = intval($request->input('event_id')); // Conversion en entier

        foreach ($Favoris as $fav) {
            foreach ($fav->events as $ev) {

                if ($ev->id == $intNumber) {
                    return redirect('/event')->with('error', 'Favoris already exist');
                }
            }
        }
        $favoris = Favoris::create([
            'user_id' => auth()->user()->id
        ]);
        $event = Event::find([$request->input('event_id')]);
        $favoris->events()->attach($event);
        return redirect('/event')->with('message', 'Favoris aded successfully');

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        $favori = Favoris::where('user_id', auth()->user()->id)
            ->where('id', $id)
            ->first();
        $favori->events()->detach();
         $favori->delete();
         return redirect('/event/favoris')->with('message', 'Favoris deleted successfully');
        
    }
}