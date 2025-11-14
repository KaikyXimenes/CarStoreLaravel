<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    // ... (index, create, store, edit, update ficam iguais) ...
    public function index()
    {
        $colors = Color::orderBy('name')->get();
        return view('admin.colors.index', ['colors' => $colors]);
    }

    public function create()
    {
        return view('admin.colors.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255|unique:colors'], [
            'name.required' => 'O campo nome é obrigatório.',
            'name.unique' => 'Já existe uma cor com este nome.'
        ]);
        Color::create($request->all());
        return redirect()->route('admin.colors.index')
                         ->with('success', 'Cor criada com sucesso!');
    }

    public function edit(string $id)
    {
        $color = Color::findOrFail($id);
        return view('admin.colors.edit', ['color' => $color]);
    }

    public function update(Request $request, string $id)
    {
        $color = Color::findOrFail($id);
        $request->validate(['name' => 'required|string|max:255|unique:colors,name,'.$color->id], [
            'name.required' => 'O campo nome é obrigatório.',
            'name.unique' => 'Já existe outra cor com este nome.'
        ]);
        $color->update($request->all());
        return redirect()->route('admin.colors.index')
                         ->with('success', 'Cor atualizada com sucesso!');
    }

    /**
     * MUDANÇA: Atualizámos a função 'destroy'
     */
    public function destroy(string $id)
    {
        $color = Color::findOrFail($id);

        // 1. Verifica se esta cor tem "filhos" (Veículos)
        if ($color->vehicles()->count() > 0) {
            // 2. Se tiver, não apaga! Volta para trás com uma mensagem de erro.
            return redirect()->route('admin.colors.index')
                             ->with('error', 'ERRO: Esta Cor não pode ser apagada porque está a ser usada por veículos.');
        }

        // 3. Se não tiver "filhos", apaga normalmente.
        $color->delete();
        return redirect()->route('admin.colors.index')
                         ->with('success', 'Cor apagada com sucesso!');
    }
}