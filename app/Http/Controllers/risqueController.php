<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Risque;

class risqueController extends Controller
{
    public function RisquesAdmin()
    {
        $donnees = Risque::all();
        return view('listRisque', compact('donnees'));
    }

    public function getRisque()
    {
        $ajoutRisque = Risque::all();
        return view('BackOffice.listRisque', ['donnees' => $ajoutRisque]);
    }

    public function addRisque(Request $req)
    {
        $risque = new Risque;
        $req->validate([
            'title' => 'required',
            'description' => 'required',
            'categorie' => 'required',
            'probabilite' => 'required',
        ]);
        $risque->title = $req->title;
        $risque->description = $req->description;
        $risque->categorie = $req->categorie;
        $risque->probabilite = $req->probabilite;
        $risque->user_id = auth()->id();
        $risque->save();

        return redirect('admin/listRisque');
    }

    public function updateRisque(Request $req)
    {
        $risque = Risque::find($req->id);
        $req->validate([
            'title' => 'required',
            'description' => 'required',
            'categorie' => 'required',
            'probabilite' => 'required',
        ]);
        if ($risque) {
            $risque->title = $req->title;
            $risque->description = $req->description;
            $risque->categorie = $req->categorie;
            $risque->probabilite = $req->probabilite;
            $risque->save();

            return redirect('admin/listRisque');
        } else {
            return redirect('admin/listRisque')->with('error', 'Risque non trouvé.');
        }
    }

    public function getRisqueId($id)
    {
        $donnees = Risque::find($id);
        return view('BackOffice.modifRisque', compact('donnees'));
    }

    public function suppRisque($id)
    {
        $risque = Risque::find($id);
        $risque->delete();
        return redirect('admin/listRisque');
    }

    public function deleteRisque($id)
    {
        $dataRisqueDelete = Risque::find($id);
        $dataRisqueDelete->delete();
        return redirect('admin/listRisque');
    }

    public function searchRisques(Request $request)
    {
        $category = $request->input('category');
        $risques = Risque::where('categorie', $category)->get();
        return view('BackOffice.searchRisques', ['risques' => $risques]);
    }
}
