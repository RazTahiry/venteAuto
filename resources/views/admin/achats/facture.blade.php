<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facture-{{ sprintf('%03d', $numFact) }}</title>
    <style>
        .titreFacture {
            text-align: center;
            margin-bottom: 40px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 40px;
            margin-bottom: 40px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
        }

        #void {
            border: none !important;
        }
    </style>
</head>

<body>
    <h3 class="titreFacture">Facture N°{{ sprintf('%03d', $numFact) }}</h3>
    <p>Date de facturation : {{ $dateFormatee }}</p>
    <p>Nom du Client : {{ $client->nom }}</p>
    <p>Contact : {{ $client->contact }} </p>

    <table>
        <thead>
            <tr>
                <td>Désignation</td>
                <td style="text-align: center">Quantité</td>
                <td style="text-align: center">Prix Unitaire</td>
                <td style="text-align: center">Total</td>
            </tr>
        </thead>
        <tbody>
            @php
                $totalGeneral = 0;
            @endphp
            @foreach ($achats as $achat)
                <tr>
                    <td>{{ $achat->voiture->Design }}</td>
                    <td style="text-align: center">{{ $achat->qte }}</td>
                    <td style="text-align: right">{{ number_format($achat->voiture->prix, thousands_separator: '.') }}
                        Ar</td>
                    <td style="text-align: right">
                        {{ number_format($achat->qte * $achat->voiture->prix, thousands_separator: '.') }} Ar</td>
                </tr>
                @php
                    $totalGeneral += $achat->qte * $achat->voiture->prix;
                @endphp
            @endforeach
            <tr>
                <td colspan="3" id="void"></td>
                <td style="text-align: right">{{ number_format($totalGeneral, thousands_separator: '.') }} Ar</td>
            </tr>
        </tbody>
    </table>

    <p>Arrêté par la présente facture à la somme de
        {{ app('App\Http\Controllers\Admin\AchatController')->chiffreEnLettre($totalGeneral) }} ariary.</p>
</body>

</html>
