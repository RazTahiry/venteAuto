<?php

namespace App\Http\Controllers\Admin;

use App\Models\Achat;
use App\Models\Client;
use App\Models\Voiture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AchatFormRequest;

class AchatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.achats.index', [
            'achats' => Achat::paginate(9)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $voitures = Voiture::all();
        $clients = Client::all();
        return view('admin.achats.form', [
            'achat' => new Achat(),
            'client' => new Client(),
            'voiture' => new Voiture()
        ], compact('voitures', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AchatFormRequest $request)
    {
        $achat = Achat::create($request->validated());
        return to_route('admin.achat.index')->with('success', 'L\'achat a été fait avec succès');
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
    public function edit(Achat $achat)
    {
        $voitures = Voiture::all();
        $clients = Client::all();
        return view('admin.achats.form', [
            'achat' => $achat
        ], compact('voitures', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AchatFormRequest $request, Achat $achat)
    {
        $achat->update($request->validated());
        return to_route('admin.achat.index')->with('success', 'L\'achat a été modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Achat $achat)
    {
        $achat->delete();
        return to_route('admin.achat.index')->with('success', 'L\'achat a été supprimé');
    }
}
