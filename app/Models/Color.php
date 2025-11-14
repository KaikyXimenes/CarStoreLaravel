<?php

namespace App\Models; // <-- ESTA É A CORREÇÃO!

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Define o relacionamento: Uma Cor TEM MUITOS Veículos.
     * (Isto corrige o erro de "apagar")
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}