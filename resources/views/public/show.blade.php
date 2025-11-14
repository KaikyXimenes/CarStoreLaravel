@extends('layouts.app')

@section('content')
<div class="py-12">
    {{-- MUDANÇA: Removi o 'max-w-7xl' para ficar full-width. Adicionei 'px-4 sm:px-6 lg:px-8'. --}}
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 md:p-12 text-gray-900 dark:text-gray-100">

                {{-- Título --}}
                <h2 class="text-4xl font-semibold">
                    {{ $vehicle->vehicleModel->brand->name }} 
                    {{ $vehicle->vehicleModel->name }}
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-400 mt-1">
                    {{ $vehicle->color->name }} | {{ $vehicle->year }}
                </p>

                {{-- Grelha de 2 Colunas (Fotos / Detalhes) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6">

                    {{-- Coluna 1: Fotos --}}
                    <div>
                        {{-- Foto Principal --}}
                        <div class="mb-4">
                            <img src="{{ $vehicle->main_image_url }}" 
                                 class="w-full rounded-lg shadow-md"
                                 alt="Foto Principal">
                        </div>
                        
                        <h4 class="text-2xl font-semibold mb-4">Mais Imagens</h4>
                        <div class="grid grid-cols-3 gap-4">
                            @forelse ($vehicle->images as $image)
                                <div>
                                    <img src="{{ $image->url }}" 
                                         class="w-full rounded shadow" 
                                         alt="Foto Extra">
                                </div>
                            @empty
                                <div class="col-span-3">
                                    <p class="text-gray-600 dark:text-gray-400">Este veículo não possui fotos extras.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- Coluna 2: Informações --}}
                    <div>
                        {{-- Valor --}}
                        <div class="mb-6">
                            <h3 class="text-6xl font-bold">
                                R$ {{ number_format($vehicle->price, 2, ',', '.') }}
                            </h3>
                        </div>

                        {{-- Lista de Detalhes --}}
                        <div class="border-y border-gray-200 dark:border-gray-700 text-lg">
                            <div class="flex justify-between py-4 px-2 border-b border-gray-200 dark:border-gray-700">
                                <strong class="text-gray-600 dark:text-gray-400">Quilometragem</strong>
                                <span class="font-semibold">{{ number_format($vehicle->mileage, 0, ',', '.') }} KM</span>
                            </div>
                            <div class="flex justify-between py-4 px-2 border-b border-gray-200 dark:border-gray-700">
                                <strong class="text-gray-600 dark:text-gray-400">Ano</strong>
                                <span class="font-semibold">{{ $vehicle->year }}</span>
                            </div>
                             <div class="flex justify-between py-4 px-2 border-b border-gray-200 dark:border-gray-700">
                                <strong class="text-gray-600 dark:text-gray-400">Cor</strong>
                                <span class="font-semibold">{{ $vehicle->color->name }}</span>
                            </div>
                             <div class="flex justify-between py-4 px-2 border-b border-gray-200 dark:border-gray-700">
                                <strong class="text-gray-600 dark:text-gray-400">Marca</strong>
                                <span class="font-semibold">{{ $vehicle->vehicleModel->brand->name }}</span>
                            </div>
                             <div class="flex justify-between py-4 px-2">
                                <strong class="text-gray-600 dark:text-gray-400">Modelo</strong>
                                <span class="font-semibold">{{ $vehicle->vehicleModel->name }}</span>
                            </div>
                        </div>

                        {{-- Descrição (Campo de Detalhes) --}}
                        <div class="mt-8">
                            <h5 class="text-2xl font-semibold mb-2">Descrição</h5>
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-lg">
                                {{ $vehicle->description }}
                            </p>
                        </div>

                        {{-- Botão Voltar (Botão Secundário do Tailwind - maior) --}}
                        {{-- MUDANÇA: 'text-xs' para 'text-sm', 'px-4 py-2' para 'px-6 py-3' --}}
                        <a href="{{ route('public.index') }}" class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-sm text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150 mt-8">
                            &larr; Voltar para a lista
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection