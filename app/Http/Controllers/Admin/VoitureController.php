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
    public function index()
    {
        return view('admin.voitures.index', [
            'voitures' => Voiture::orderBy('created_at', 'desc')->paginate(15)
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
        $voiture = Voiture::create($request->validated());
        return to_route('admin.voiture.index')->with('success', 'Le voiture a été ajouté avec succès');
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
        $voiture->delete();
        return to_route('admin.voiture.index')->with('success', 'Le voiture a été supprimé');
    }
}
