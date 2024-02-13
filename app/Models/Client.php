<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
