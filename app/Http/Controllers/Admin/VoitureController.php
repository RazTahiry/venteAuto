<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VoitureFormRequest;
use App\Models\Voiture;
use Illuminate\Http\Request;

class VoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $voitures = Voiture::query();

        if ($search = $request->search) {
            $voitures->where('idVoit', 'LIKE', '%'. $search . '%')
                    ->orWhere('Design', 'LIKE', '%'. $search . '%');
        }

        return view('admin.voitures.index', [
            'voitures' => $voitures->latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.voitures.form', [
            'voiture' => new Voiture()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VoitureFormRequest $request)
    {
        try {

            // Auto generation de clé primaire auto-incrementé (type string)
            $dernierVoiture = Voiture::latest()->first(); // Obtenir la dernière voiture dans la BD
            if ($dernierVoiture) { // Vraie si la table a déjà de données
                $lastId = intval(substr($dernierVoiture->idVoit, 2)); // Id de la dernière voiture
                $nextId = 'V-' . sprintf('%04d', $lastId + 1); // Id suivant = dernière voiture + 1
            } else { // Si la table est encore vide
                $nextId = 'V-0001';
            }

            $requestData = $request->validated();
            $requestData['idVoit'] = $nextId;

            $voiture = Voiture::create($requestData);

            return to_route('admin.voiture.index')->with('success', 'Le voiture a été ajouté avec succès');

        } catch (\Exception $e) {

            return redirect()->back()->withInput()->withErrors(['error' => 'Erreur lors de l\'ajout de voiture. Veuillez réessayer.']);

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voiture $voiture)
    {
        return view('admin.voitures.form', [
            'voiture' => $voiture
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VoitureFormRequest $request, Voiture $voiture)
    {
        $voiture->update($request->validated());
        return to_route('admin.voiture.index')->with('success', 'Le voiture a été modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voiture $voiture)
    {
        if ($voiture->achats()->exists()) {
            return to_route('admin.voiture.index')->with('error', 'Cette voiture a des achats associés. Vous devez supprimer les achats avant de supprimer cette voiture.');
        } else {
            $voiture->delete();
            return to_route('admin.voiture.index')->with('toast_success', 'Le voiture a été supprimé');
        }
    }
}
