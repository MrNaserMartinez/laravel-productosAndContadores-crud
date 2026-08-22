<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contador extends Model
{
    protected $table = 'contadores';

    protected $fillable = [
        'numero_contador',
        'direccion',
        'lectura_actual',
    ];
}