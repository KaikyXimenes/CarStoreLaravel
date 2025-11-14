<?php

namespace App\Models; // <-- ESTA É A CORREÇÃO!

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'name',
    ];

    /**
     * Define o relacionamento: Um Modelo PERTENCE A UMA Marca.
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Define o relacionamento: Um Modelo TEM MUITOS Veículos.
     * (Isto corrige o erro de "apagar")
     */
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}