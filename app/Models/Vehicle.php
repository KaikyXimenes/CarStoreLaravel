<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    /**
     * Os campos que podem ser preenchidos em massa (pelo Seeder ou por um formulário).
     * @var array
     */
    protected $fillable = [
        'vehicle_model_id',
        'color_id',
        'year',
        'mileage',
        'price',
        'description',
        'main_image_url',
    ];

    /**
     * Define o relacionamento: Um Veículo PERTENCE A UM Modelo.
     * (Ex: O Onix pertence ao Modelo "Onix")
     */
    public function vehicleModel()
    {
        return $this->belongsTo(VehicleModel::class);
    }

    /**
     * Define o relacionamento: Um Veículo PERTENCE A UMA Cor.
     */
    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    /**
     * Define o relacionamento: Um Veículo TEM MUITAS Imagens.
     */
    public function images()
    {
        return $this->hasMany(VehicleImage::class);
    }
}