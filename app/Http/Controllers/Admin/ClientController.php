<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientFormRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.clients.index', [
            'clients' => Client::orderBy('created_at', 'desc')->paginate(9)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.clients.form', [
            'client' => new Client()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientFormRequest $request)
    {
        $client = Client::create($request->validated());
        return to_route('admin.client.index')->with('success', 'Le client a été ajouté avec succès');
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
    public function edit(Client $client)
    {
        return view('admin.clients.form', [
            'client' => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientFormRequest $request, Client $client)
    {
        $client->update($request->validated());
        return to_route('admin.client.index')->with('success', 'Le client a été modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return to_route('admin.client.index')->with('success', 'Le client a été supprimé');
    }
}
