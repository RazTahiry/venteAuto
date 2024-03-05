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
    public function index(Request $request)
    {
        $clients = Client::query();

        if ($search = $request->search) {
            $clients->where('idCli', 'LIKE', '%' . $search . '%')
                ->orWhere('nom', 'LIKE', '%' . $search . '%');
        }

        return view('admin.clients.index', [
            'clients' => $clients->latest()->paginate(100)
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
        try {

            // Auto generation de clé primaire auto-incrementé (type string)
            $dernierClient = Client::latest()->first(); // Obtenir le dernier client dans la BD
            if ($dernierClient) { // Vraie si la table a déjà de données
                $lastId = intval(substr($dernierClient->idCli, 2)); // Id du dernier client
                $nextId = 'C-' . sprintf('%04d', $lastId + 1); // Id suivant = dernier client + 1
            } else { // Si la table est encore vide
                $nextId = 'C-0001';
            }

            $requestData = $request->validated();
            $requestData['idCli'] = $nextId;

            $client = Client::create($requestData);

            return to_route('admin.client.index')->with('success', 'Le client a été ajouté avec succès');
        } catch (\Exception $e) {

            return redirect()->back()->withInput()->withErrors(['error' => 'Erreur lors de l\'ajout du client. Veuillez réessayer.']);
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
        if ($client->achats()->exists()) {
            return to_route('admin.client.index')->with('error', 'Ce client a des achats associés. Vous devez supprimer les achats avant de supprimer ce client.');
        } else {
            $client->delete();
            return to_route('admin.client.index')->with('toast_success', 'Le client a été supprimé');
        }
    }
}
