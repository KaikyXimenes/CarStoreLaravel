<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleImage extends Model
{
    use HasFactory;

    /**
     * O Seeder vai tentar preencher 'vehicle_id' e 'url'.
     * Precisamos de permitir isso.
     *
     * @var array
     */
    protected $fillable = [
        'vehicle_id',
        'url',
    ];

    /**
     * Define o relacionamento: Uma Imagem PERTENCE A UM Veículo.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}