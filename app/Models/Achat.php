<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Voiture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Achat extends Model
{
    use HasFactory;

    protected $primaryKey = 'numAchat';

    protected $keyType = 'string';

    public $incrementing = true;

    protected $fillable = [
        'numAchat',
        'idCli',
        'idVoit',
        'date',
        'qte'
    ];

    public function voiture() : belongsTo
    {
        return $this->belongsTo(Voiture::class, 'idVoit');
    }

    public function client() : BelongsTo
    {
        return $this->belongsTo(Client::class, 'idCli');
    }
}
