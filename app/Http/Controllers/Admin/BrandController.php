<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    // ... (index, create, store, edit, update ficam iguais) ...

    public function index()
    {
        $brands = Brand::orderBy('name')->get();
        return view('admin.brands.index', ['brands' => $brands]);
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255|unique:brands'], [
            'name.required' => 'O campo nome é obrigatório.',
            'name.unique' => 'Já existe uma marca com este nome.'
        ]);
        Brand::create($request->all());
        return redirect()->route('admin.brands.index')
                         ->with('success', 'Marca criada com sucesso!');
    }

    public function edit(string $id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit', ['brand' => $brand]);
    }

    public function update(Request $request, string $id)
    {
        $brand = Brand::findOrFail($id);
        $request->validate(['name' => 'required|string|max:255|unique:brands,name,'.$brand->id ], [
            'name.required' => 'O campo nome é obrigatório.',
            'name.unique' => 'Já existe outra marca com este nome.'
        ]);
        $brand->update($request->all());
        return redirect()->route('admin.brands.index')
                         ->with('success', 'Marca atualizada com sucesso!');
    }

    /**
     * MUDANÇA: Atualizámos a função 'destroy'
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        
        // 1. Verifica se esta marca tem "filhos" (Modelos)
        if ($brand->vehicleModels()->count() > 0) {
            // 2. Se tiver, não apaga! Volta para trás com uma mensagem de erro.
            return redirect()->route('admin.brands.index')
                             ->with('error', 'ERRO: Esta Marca não pode ser apagada porque está a ser usada por modelos.');
        }

        // 3. Se não tiver "filhos", apaga normalmente.
        $brand->delete();
        return redirect()->route('admin.brands.index')
                         ->with('success', 'Marca apagada com sucesso!');
    }
}