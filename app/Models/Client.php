<?php

namespace App\Models;

use App\Models\Achat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $primaryKey = 'idCli';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'idCli',
        'nom',
        'contact'
    ];

    public function achats() {
        return $this->hasMany(Achat::class);
    }
}
