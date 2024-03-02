<?php

namespace App\Models;

use App\Models\Achat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Voiture extends Model
{
    use HasFactory;

    protected $primaryKey = 'idVoit';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'idVoit',
        'Design',
        'prix',
        'nombre'
    ];

    public function achats() {
        return $this->hasMany(Achat::class, 'idVoit');
    }
}
