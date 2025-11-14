@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Editar Veículo') }}
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 md:p-10 text-gray-900 dark:text-gray-100">

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Ups!</strong>
                        <span class="block sm:inline">Havia algo de errado com os dados:</span>
                        <ul class="mt-3 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <form action="{{ route('admin.vehicles.update', $vehicle->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-6">
                            {{-- Dropdown de Modelos (pré-selecionado) --}}
                            <div>
                                <x-input-label for="vehicle_model_id" :value="__('Modelo (Marca)')" />
                                <select id="vehicle_model_id" name="vehicle_model_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">-- Selecione um Modelo --</option>
                                    @foreach ($models as $model)
                                        <option value="{{ $model->id }}" 
                                            {{ old('vehicle_model_id', $vehicle->vehicle_model_id) == $model->id ? 'selected' : '' }}>
                                            {{ $model->brand->name }} - {{ $model->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Dropdown de Cores (pré-selecionado) --}}
                            <div>
                                <x-input-label for="color_id" :value="__('Cor')" />
                                <select id="color_id" name="color_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">-- Selecione uma Cor --</option>
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id }}" 
                                            {{ old('color_id', $vehicle->color_id) == $color->id ? 'selected' : '' }}>
                                            {{ $color->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            {{-- Descrição --}}
                            <div>
                                <x-input-label for="description" :value="__('Descrição (Detalhes)')" />
                                <textarea id="description" name="description" rows="5" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ old('description', $vehicle->description) }}</textarea>
                            </div>
                        </div>

                        <div class="space-y-6">
                            {{-- Ano --}}
                            <div>
                                <x-input-label for="year" :value="__('Ano de Fabricação')" />
                                <x-text-input id="year" class="block mt-1 w-full" type="number" name="year" :value="old('year', $vehicle->year)" required />
                            </div>

                            {{-- Quilometragem --}}
                            <div>
                                <x-input-label for="mileage" :value="__('Quilometragem (KM)')" />
                                <x-text-input id="mileage" class="block mt-1 w-full" type="number" name="mileage" :value="old('mileage', $vehicle->mileage)" required />
                            </div>

                            {{-- Valor --}}
                            <div>
                                <x-input-label for="price" :value="__('Valor (R$)')" />
                                <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price', $vehicle->price)" step="0.01" required />
                            </div>
                        </div>
                    </div>

                    <hr class="my-6 border-gray-200 dark:border-gray-700">
                    
                    <h5 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Fotos (URLs)</h5>
                    
                    {{-- Foto Principal --}}
                    <div class="mb-4">
                        <x-input-label for="main_image_url" :value="__('Foto Principal (URL)')" />
                        <x-text-input id="main_image_url" class="block mt-1 w-full" type="url" name="main_image_url" :value="old('main_image_url', $vehicle->main_image_url)" required />
                        <x-input-error :messages="$errors->get('main_image_url')" class="mt-2" />
                    </div>

                    {{-- Fotos Extras (Mínimo 3) --}}
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Fotos Extras (URLs) - Mínimo 3</label>
                        <div id="image-inputs-container" class="mt-2 space-y-2">
                            
                            {{-- Usa as 'images' antigas (de uma falha de validação) OU as 'images' do banco --}}
                            @php
                                // Tenta buscar 'old(images)'. Se não existir, busca as imagens do veículo no banco
                                $images = old('images', $vehicle->images->pluck('url')->toArray());
                                // Garante que temos pelo menos 3 campos, mesmo que 'old' ou 'vehicle' não os tenham
                                $imageCount = max(3, count($images));
                            @endphp

                            @for ($i = 0; $i < $imageCount; $i++)
                                <x-text-input class="block w-full" type="url" name="images[]" :value="$images[$i] ?? ''" placeholder="https://.../foto_extra_{{ $i + 1 }}.jpg" required />
                            @endfor
                        </div>
                        <x-input-error :messages="$errors->get('images')" class="mt-2" />
                        
                        <button type="button" id="add-image-input" class="inline-flex items-center mt-2 px-3 py-1 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            + Adicionar mais uma foto
                        </button>
                    </div>
                    
                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.vehicles.index') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                            Cancelar
                        </a>
                        <x-primary-button class="ms-4">
                            {{ __('Atualizar Veículo') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

{{-- O MESMO JavaScript para o botão "+ Adicionar" --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addButton = document.getElementById('add-image-input');
        const container = document.getElementById('image-inputs-container');
        addButton.addEventListener('click', function () {
            const newInput = document.createElement('input');
            newInput.setAttribute('type', 'url');
            newInput.setAttribute('class', 'block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm');
            newInput.setAttribute('name', 'images[]');
            newInput.setAttribute('placeholder', 'https://.../outra_foto.jpg');
            newInput.setAttribute('required', true);
            container.appendChild(newInput);
        });
    });
</script>
@endpush