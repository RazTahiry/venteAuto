<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Voiture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Achat extends Model
{
    use HasFactory;

    protected $primaryKey = 'numAchat';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'numAchat',
        'idCli',
        'idVoit',
        'date',
        'qte'
    ];

    public function voiture()
    {
        return $this->belongsTo(Voiture::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
