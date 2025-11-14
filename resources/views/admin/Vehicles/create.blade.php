@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Adicionar Novo Veículo') }}
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 md:p-10 text-gray-900 dark:text-gray-100">

                {{-- Mostrar erros de validação (Tailwind) --}}
                @if ($errors->any())
                    <div class="mb-4 bg-red-600 text-white font-bold px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">Ups! Havia algo de errado com os dados:</span>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-4 bg-red-600 text-white font-bold px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <form action="{{ route('admin.vehicles.store') }}" method="POST">
                    @csrf 
                    
                    {{-- Grelha de 2 Colunas para o formulário --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        {{-- Coluna 1 do Formulário --}}
                        <div class="space-y-6">
                            {{-- Dropdown de Modelos (com Marcas) --}}
                            <div>
                                <label for="vehicle_model_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Modelo (Marca)</label>
                                <select id="vehicle_model_id" name="vehicle_model_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">-- Selecione um Modelo --</option>
                                    @foreach ($models as $model)
                                        <option value="{{ $model->id }}" {{ old('vehicle_model_id') == $model->id ? 'selected' : '' }}>
                                            {{ $model->brand->name }} - {{ $model->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Dropdown de Cores --}}
                            <div>
                                <label for="color_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Cor</label>
                                <select id="color_id" name="color_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">-- Selecione uma Cor --</option>
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id }}" {{ old('color_id') == $color->id ? 'selected' : '' }}>
                                            {{ $color->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            {{-- Descrição --}}
                            <div>
                                <label for="description" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Descrição (Detalhes)</label>
                                <textarea id="description" name="description" rows="5" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ old('description') }}</textarea>
                            </div>
                        </div>

                        {{-- Coluna 2 do Formulário --}}
                        <div class="space-y-6">
                            {{-- Ano --}}
                            <div>
                                <label for="year" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Ano de Fabricação</label>
                                <input type="number" id="year" name="year" value="{{ old('year') }}" required placeholder="Ex: 2023"
                                       class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            </div>

                            {{-- Quilometragem --}}
                            <div>
                                <label for="mileage" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Quilometragem (KM)</label>
                                <input type="number" id="mileage" name="mileage" value="{{ old('mileage') }}" required placeholder="Ex: 15000"
                                       class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            </div>

                            {{-- Valor --}}
                            <div>
                                <label for="price" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Valor (R$)</label>
                                <input type="number" id="price" name="price" value="{{ old('price') }}" step="0.01" required placeholder="Ex: 82000.00"
                                       class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            </div>
                        </div>
                    </div>

                    <hr class="my-6 border-gray-200 dark:border-gray-700">
                    
                    <h5 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Fotos (URLs)</h5>
                    
                    {{-- Foto Principal --}}
                    <div class="mb-4">
                        <label for="main_image_url" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Foto Principal (URL)</label>
                        <input type="url" id="main_image_url" name="main_image_url" value="{{ old('main_image_url') }}" required placeholder="https://.../foto_principal.jpg"
                               class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    </div>

                    {{-- Fotos Extras (Mínimo 3) --}}
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Fotos Extras (URLs) - Mínimo 3</label>
                        <div id="image-inputs-container" class="mt-2 space-y-2">
                            <input type="url" name="images[]" value="{{ old('images.0') }}" placeholder="https://.../foto_extra_1.jpg" required
                                   class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <input type="url" name="images[]" value="{{ old('images.1') }}" placeholder="https://.../foto_extra_2.jpg" required
                                   class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <input type="url" name="images[]" value="{{ old('images.2') }}" placeholder="https://.../foto_extra_3.jpg" required
                                   class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            
                            {{-- AQUI ESTÁ A PARTE QUE DAVA ERRO (mas agora não tem problema) --}}
                            @if (old('images') && count(old('images')) > 3)
                                @for ($i = 3; $i < count(old('images')); $i++)
                                    <input type="url" name="images[]" value="{{ old('images.'.$i) }}" placeholder="https://.../foto_extra_{{ $i + 1 }}.jpg" required
                                           class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                @endfor
                            @endif
                        </div>
                        
                        {{-- Botão JavaScript para adicionar mais fotos --}}
                        <button type="button" id="add-image-input" class="inline-flex items-center mt-2 px-3 py-1 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            + Adicionar mais uma foto
                        </button>
                    </div>
                    
                    {{-- Botões de Ação --}}
                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.vehicles.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                            Cancelar
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-4">
                            Guardar Veículo
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

{{-- O JavaScript (não precisa de mudança, pois o ID 'add-image-input' é o mesmo) --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addButton = document.getElementById('add-image-input');
        const container = document.getElementById('image-inputs-container');
        addButton.addEventListener('click', function () {
            // Cria um novo 'input'
            const newInput = document.createElement('input');
            newInput.setAttribute('type', 'url');
            // Adiciona as classes do Tailwind (copiadas dos inputs acima)
            newInput.setAttribute('class', 'block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm');
            newInput.setAttribute('name', 'images[]');
            newInput.setAttribute('placeholder', 'https://.../outra_foto.jpg');
            newInput.setAttribute('required', true);
            
            // Adiciona o 'input' novo ao "contentor"
            container.appendChild(newInput);
        });
    });
</script>
@endpush

@endsection