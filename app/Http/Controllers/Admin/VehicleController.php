<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;        // O Model que vamos gerir
use App\Models\VehicleModel;  // O Model que vamos usar (dropdown)
use App\Models\Color;         // O Model que vamos usar (dropdown)
use App\Models\VehicleImage;  // O Model das fotos extras
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Vamos usar para "transações"

class VehicleController extends Controller
{
    /**
     * Mostra a lista de todos os veículos.
     */
    public function index()
    {
        // 1. Busca os veículos, já carregando os "parentes"
        // Repare como buscamos o 'brand' (avô) através do 'vehicleModel' (pai)
        $vehicles = Vehicle::with('vehicleModel.brand', 'color')
                            ->orderBy('created_at', 'desc')
                            ->get();

        // 2. Retorna a "tela" (view) da lista
        return view('admin.vehicles.index', [
            'vehicles' => $vehicles
        ]);
    }

    /**
     * Mostra o formulário para criar um novo veículo.
     */
    public function create()
    {
        // 1. Precisamos de buscar todos os Modelos (com as suas Marcas)...
        $models = VehicleModel::with('brand')->orderBy('name')->get();
        // 2. ...e todas as Cores...
        $colors = Color::orderBy('name')->get();
        
        // 3. ...para popular os <select> (dropdowns) no formulário
        return view('admin.vehicles.create', [
            'models' => $models,
            'colors' => $colors
        ]);
    }

    /**
     * Salva o novo veículo no banco de dados.
     */
    public function store(Request $request)
    {
        // 1. Validar os dados (esta é a nossa maior validação!)
        $request->validate([
            'vehicle_model_id' => 'required|exists:vehicle_models,id',
            'color_id' => 'required|exists:colors,id',
            'year' => 'required|integer|min:1900|max:'.(date('Y') + 1), // Obrigatório
            'mileage' => 'required|integer|min:0', // Obrigatório
            'price' => 'required|numeric|min:0', // Obrigatório
            'description' => 'required|string',
            'main_image_url' => 'required|url',
            
            // Validação das Fotos Extras (Mínimo 3)
            'images' => 'required|array|min:3', // Tem de ser um array e ter no mínimo 3
            'images.*' => 'required|url' // Cada item no array tem de ser um URL
        ], [
            'vehicle_model_id.required' => 'O campo Modelo é obrigatório.',
            'color_id.required' => 'O campo Cor é obrigatório.',
            'year.required' => 'O campo Ano é obrigatório.',
            'mileage.required' => 'O campo Quilometragem é obrigatório.',
            'price.required' => 'O campo Valor é obrigatório.',
            'description.required' => 'O campo Descrição é obrigatório.',
            'main_image_url.required' => 'O campo Foto Principal (URL) é obrigatório.',
            'images.required' => 'É obrigatório enviar as fotos extras.',
            'images.min' => 'É obrigatório enviar no mínimo 3 fotos extras.',
            'images.*.url' => 'Todas as fotos extras devem ser um URL válido.'
        ]);

        // 2. Criar o Veículo e as suas Fotos (usando uma "Transação")
        // Uma transação garante que, se houver um erro a salvar as fotos,
        // o veículo também não é salvo. (Tudo ou nada)
        try {
            DB::beginTransaction();

            // 2a. Criar o Veículo principal
            $vehicle = Vehicle::create([
                'vehicle_model_id' => $request->vehicle_model_id,
                'color_id' => $request->color_id,
                'year' => $request->year,
                'mileage' => $request->mileage,
                'price' => $request->price,
                'description' => $request->description,
                'main_image_url' => $request->main_image_url,
            ]);

            // 2b. Loop para salvar as Fotos Extras
            foreach ($request->images as $imageUrl) {
                // Salva a foto, já ligando ao ID do veículo que acabámos de criar
                VehicleImage::create([
                    'vehicle_id' => $vehicle->id,
                    'url' => $imageUrl
                ]);
            }

            // 3. Se correu tudo bem, "confirma" as operações no banco
            DB::commit();

        } catch (\Exception $e) {
            // 4. Se deu erro, "desfaz" tudo o que foi feito
            DB::rollBack();
            // E devolve o utilizador com uma mensagem de erro
            return redirect()->back()
                             ->with('error', 'Erro ao salvar o veículo: ' . $e->getMessage())
                             ->withInput(); // Devolve os dados para o formulário
        }
        
        // 5. Redirecionar de volta para a lista (com mensagem de sucesso)
        return redirect()->route('admin.vehicles.index')
                         ->with('success', 'Veículo criado com sucesso!');
    }

    /**
     * Mostra o formulário para editar um veículo.
     */
    public function edit(string $id)
    {
        // 1. Encontrar o veículo (já com as fotos extras)
        $vehicle = Vehicle::with('images')->findOrFail($id);
        
        // 2. Buscar os dropdowns
        $models = VehicleModel::with('brand')->orderBy('name')->get();
        $colors = Color::orderBy('name')->get();

        // 3. Retornar a "tela" (view) de edição
        return view('admin.vehicles.edit', [
            'vehicle' => $vehicle,
            'models' => $models,
            'colors' => $colors
        ]);
    }

    /**
     * Atualiza o veículo no banco de dados.
     */
    public function update(Request $request, string $id)
    {
        // 1. Encontrar o Veículo
        $vehicle = Vehicle::findOrFail($id);

        // 2. Validar os dados (igual ao 'store')
        $request->validate([
            'vehicle_model_id' => 'required|exists:vehicle_models,id',
            'color_id' => 'required|exists:colors,id',
            'year' => 'required|integer|min:1900|max:'.(date('Y') + 1),
            'mileage' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'main_image_url' => 'required|url',
            'images' => 'required|array|min:3',
            'images.*' => 'required|url'
        ]);

        // 3. Atualizar (usando Transação)
        try {
            DB::beginTransaction();

            // 3a. Atualizar os dados do Veículo principal
            $vehicle->update([
                'vehicle_model_id' => $request->vehicle_model_id,
                'color_id' => $request->color_id,
                'year' => $request->year,
                'mileage' => $request->mileage,
                'price' => $request->price,
                'description' => $request->description,
                'main_image_url' => $request->main_image_url,
            ]);

            // 3b. Apagar TODAS as fotos extras antigas...
            $vehicle->images()->delete();

            // 3c. ...e recriar com as novas que vieram do formulário
            foreach ($request->images as $imageUrl) {
                VehicleImage::create([
                    'vehicle_id' => $vehicle->id,
                    'url' => $imageUrl
                ]);
            }

            // 4. Se correu tudo bem, "confirma"
            DB::commit();

        } catch (\Exception $e) {
            // 5. Se deu erro, "desfaz"
            DB::rollBack();
            return redirect()->back()
                             ->with('error', 'Erro ao atualizar o veículo: ' . $e->getMessage())
                             ->withInput();
        }

        // 6. Redirecionar de volta para a lista (com mensagem de sucesso)
        return redirect()->route('admin.vehicles.index')
                         ->with('success', 'Veículo atualizado com sucesso!');
    }

    /**
     * Apaga um veículo do banco de dados.
     */
    public function destroy(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        
        try {
            DB::beginTransaction();
            
            // 1. Apagar as Fotos Extras (filhos)
            $vehicle->images()->delete();
            
            // 2. Apagar o Veículo (pai)
            $vehicle->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                             ->with('error', 'Erro ao apagar o veículo: ' . $e->getMessage());
        }

        // 3. Redirecionar de volta para a lista (com mensagem de sucesso)
        return redirect()->route('admin.vehicles.index')
                         ->with('success', 'Veículo apagado com sucesso!');
    }
}