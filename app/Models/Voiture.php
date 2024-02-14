<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->hasMany(Achat::class);
    }
}
