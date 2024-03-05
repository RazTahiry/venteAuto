<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use App\Models\Achat;
use App\Models\Client;
use App\Models\Voiture;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use NumberToWords\NumberToWords;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AchatFormRequest;

class AchatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $achats = Achat::query();

        if ($premiereDate = $request->premiereDate and $secondDate = $request->secondDate) {
            $achats->whereBetween('date', [$premiereDate, $secondDate]);
        }

        return view('admin.achats.index', [
            'achats' => $achats->latest()->paginate(100)
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

        DB::beginTransaction();

        try {
            $voiture = Voiture::findOrFail($request->idVoit);

            // Vérifier si la quantité d'achat est supérieure à la quantité de voitures disponibles
            if ($request->qte > $voiture->nombre) {

                // Envoyer un message s'il n'y a pas assez de voitures disponibles
                DB::rollBack(); // Annuler la transaction
                return redirect()->back()->withInput()->withErrors(['qte' => 'Quantité insuffisante de voitures disponibles.']);
                return;
            } else {

                // Auto generation de clé primaire auto-incrementé (type string)
                $dernierAchat = Achat::latest()->first(); // Obtenir le dernier achat dans la BD
                if ($dernierAchat) { // Vraie si la table a déjà de données
                    $lastId = intval(substr($dernierAchat->numAchat, 2)); // Id du dernier achat
                    $nextId = 'A-' . sprintf('%04d', $lastId + 1); // Id suivant = dernier achat + 1
                } else { // Si la table est encore vide
                    $nextId = 'A-0001';
                }

                $requestData = $request->validated();
                $requestData['numAchat'] = $nextId;

                $achat = Achat::create($requestData);

                // Soustraire la quantité d'achat au nombre de voitures disponibles
                $voiture->nombre -= $achat->qte;
                $voiture->save();
                DB::commit();

                return to_route('admin.achat.index')->with('success', 'L\'achat a été fait avec succès');
            }
        } catch (\Exception $e) {
            // Annuler la transaction en cas d'erreur

            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Erreur lors de l\'achat. Veuillez réessayer, Erreur: ' . $e->getMessage()]);
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
        $voiture = Voiture::findOrFail($achat->idVoit);

        DB::beginTransaction();

        // Vérifier la quantité d'achat avant et après la modification pour pouvoir mettre à jour le nombre de voitures disponibles
        if ($achat->qte > $request->qte) {

            $diff = ($achat->qte - $request->qte); // Difference entre la quantité d'achat avant et après la modification

            $achat->update($request->validated());
            $voiture->nombre += $diff;
            $voiture->save();

            DB::commit();

            return to_route('admin.achat.index')->with('success', 'L\'achat a été modifié avec succès');
        } else {

            $diff = ($request->qte - $achat->qte); // Difference entre la quantité d'achat avant et après la modification

            // Vérifier si la quantité d'achat est supérieure à la quantité de voitures disponibles
            if ($diff > $voiture->nombre) {

                // Envoyer un message s'il n'y a pas assez de voitures disponibles
                DB::rollBack(); // Annuler la transaction
                return redirect()->back()->withInput()->withErrors(['qte' => 'Quantité insuffisante de voitures disponibles.']);
                return;
            } else {

                $achat->update($request->validated());
                $voiture->nombre -= $diff;
                $voiture->save();

                DB::commit();

                return to_route('admin.achat.index')->with('success', 'L\'achat a été modifié avec succès');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Achat $achat)
    {
        try {

            DB::beginTransaction();

            $achat->delete();
            $voiture = Voiture::findOrFail($achat->idVoit);
            $voiture->nombre += $achat->qte;
            $voiture->save();

            DB::commit();

            return to_route('admin.achat.index')->with('toast_success', 'L\'achat a été supprimé');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Erreur lors de la suppresion de l\'achat... Erreur: ' . $e->getMessage());
        }
    }

    public function chiffreEnLettre($chiffre)
    {
        // create the number to words "manager" class
        $numberToWords = new NumberToWords();

        // build a new number transformer using the RFC 3066 language identifier
        $numberTransformer = $numberToWords->getNumberTransformer('fr');
        $chiffreEnLettre = $numberTransformer->toWords($chiffre);

        return $chiffreEnLettre;
    }


    public function viewPDF(Request $request)
    {
        try {

            $achatId = $request->input('numAchat');
            $achat = Achat::findOrFail($achatId);

            Carbon::setLocale('fr');
            $date = Carbon::parse($achat->date);
            $dateFormatee = $date->translatedFormat('d F Y');

            // Vérifier si l'achat a un client associé
            if ($achat->client) {
                $client = $achat->client;
                $achatsMemeClientEtDate = Achat::where('idCli', $client->idCli)
                    ->whereDate('date', $achat->date)
                    ->get();

                // Numero de la facture
                $numFact = intval(substr($achatsMemeClientEtDate[0]->numAchat, 2));

                $voitures = Voiture::all();
                $clients = Client::all();

                $pdf = PDF::loadView('admin.achats.facture', [
                    'achats' => $achatsMemeClientEtDate,
                    'client' => $client,
                    'dateFormatee' => $dateFormatee,
                    'numFact' => $numFact
                ], compact('voitures', 'clients',));

                return $pdf->stream();
            } else {
                // Gérer le cas où l'achat n'a pas de client associé
                return redirect()->back()->with('error', 'L\'achat n\'a pas de client associé.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la création du facture... Erreur: ' . $e->getMessage());
        }
    }
}
