<?php

namespace App\Models; // <-- ESTA É A CORREÇÃO!

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Define o relacionamento: Uma Marca TEM MUITOS Modelos.
     * (Isto corrige o erro de "apagar")
     */
    public function vehicleModels()
    {
        return $this->hasMany(VehicleModel::class);
    }
}