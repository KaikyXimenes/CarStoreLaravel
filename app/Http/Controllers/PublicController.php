<?php

namespace App\Http\Controllers;

use App\Models\Vehicle; // Importar o Model que vamos usar
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Exibe a página inicial pública com a lista de todos os veículos.
     */
    public function index()
    {
        // 1. Buscar os dados no banco
        $vehicles = Vehicle::with('vehicleModel.brand', 'color')
                            ->orderBy('created_at', 'desc')
                            ->get();

        // 2. Retornar a view e "passar" os dados para ela
        return view('public.index', [
            'vehicles' => $vehicles
        ]);
    }

    /**
     * Exibe a página de detalhes de um veículo específico.
     */
    public function show(string $id)
    {
        // 1. Buscar o veículo específico pelo ID
        $vehicle = Vehicle::with('vehicleModel.brand', 'color', 'images')
                            ->findOrFail($id);

        // 2. Retornar a view de detalhes e "passar" o veículo para ela
        return view('public.show', [
            'vehicle' => $vehicle
        ]);
    }
}