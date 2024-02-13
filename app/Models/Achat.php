<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
