<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Achat;
use App\Models\Client;
use App\Models\Voiture;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class dashboardController extends Controller
{
    public function index()
    {
        $ttVoitures = Voiture::all();
        $ttClients = Client::all();
        $ttAchats = Achat::all();

        $nbVoiture = Voiture::count();
        $nbClient = Client::count();
        $nbAchat = Achat::count();

        // Calcul de la date il y a 6 mois à partir d'aujourd'hui
        $dateSixMonthsAgo = now()->subMonths(6);
        // Récupération des achats effectués au cours des 6 derniers mois
        $achats = Achat::where('date', '>=', $dateSixMonthsAgo)
            ->get();
        // Calcul de la recette accumulée chaque mois
        $recetteParMois = $achats->groupBy(function ($achat) {
            Carbon::setLocale('fr');
            return Carbon::parse($achat->date)->translatedFormat('F Y');
        })
            ->map(function ($achats, $key) {
                $recette = 0;
                foreach ($achats as $achat) {
                    $recette += $achat->voiture->prix * $achat->qte;
                }
                return $recette;
            })
            ->sortByDesc(function ($recette, $mois) {
                $moisEnTimestamp = strtotime($mois);
                return $moisEnTimestamp;
            });

        return view('admin.dashboard.index', [
            'ttVoitures' => $ttVoitures,
            'ttClients' => $ttClients,
            'ttAchats' => $ttAchats
        ], compact('nbClient', 'nbVoiture', 'nbAchat', 'recetteParMois'));
    }
}
