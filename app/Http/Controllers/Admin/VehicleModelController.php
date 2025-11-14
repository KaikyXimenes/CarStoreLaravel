<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleModel;
use App\Models\Brand;
use Illuminate\Http\Request;

class VehicleModelController extends Controller
{
    /**
     * Mostra a lista de todos os modelos.
     */
    public function index()
    {
        $models = VehicleModel::with('brand')->orderBy('name')->get();
        return view('admin.models.index', ['models' => $models]);
    }

    /**
     * Mostra o formulário para criar um novo modelo.
     */
    public function create()
    {
        $brands = Brand::orderBy('name')->get();
        return view('admin.models.create', ['brands' => $brands]);
    }

    /**
     * Salva o novo modelo no banco de dados.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id'
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'brand_id.required' => 'O campo marca é obrigatório.',
            'brand_id.exists' => 'A marca selecionada é inválida.'
        ]);
        VehicleModel::create($request->all());
        return redirect()->route('admin.models.index')
                         ->with('success', 'Modelo criado com sucesso!');
    }

    /**
     * Mostra o formulário para editar um modelo.
     */
    public function edit(string $id)
    {
        $model = VehicleModel::findOrFail($id);
        $brands = Brand::orderBy('name')->get();
        return view('admin.models.edit', [
            'model' => $model,
            'brands' => $brands
        ]);
    }

    /**
     * Atualiza o modelo no banco de dados.
     */
    public function update(Request $request, string $id)
    {
        $model = VehicleModel::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id'
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'brand_id.required' => 'O campo marca é obrigatório.',
            'brand_id.exists' => 'A marca selecionada é inválida.'
        ]);
        $model->update($request->all());
        return redirect()->route('admin.models.index')
                         ->with('success', 'Modelo atualizado com sucesso!');
    }

    /**
     * Apaga um modelo do banco de dados.
     */
    public function destroy(string $id)
    {
        $model = VehicleModel::findOrFail($id);
        
        if ($model->vehicles()->count() > 0) {
            return redirect()->route('admin.models.index')
                             ->with('error', 'ERRO: Este Modelo não pode ser apagado porque está a ser usado por veículos.');
        }

        $model->delete();
        return redirect()->route('admin.models.index')
                         ->with('success', 'Modelo apagado com sucesso!');
    }
}