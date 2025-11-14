@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">

            {{-- 
              MUDANÇA: O "Jumbotron" de Boas-Vindas agora usa a sua imagem!
              - Corrigi o caminho para 'imagens/BannerCarro.png' (como você pediu)
            --}}
            <div class="bg-cover bg-center h-[500px] flex items-center justify-center text-center rounded-lg shadow-lg relative"
                 style="background-image: url('{{ asset('imagens/BannerCarro.png') }}');">
                
                {{-- Overlay escuro para legibilidade --}}
                <div class="absolute inset-0 bg-black opacity-40 rounded-lg"></div> 

                <div class="relative z-10 p-6 md:p-12 text-white">
                    <h1 class="text-5xl lg:text-7xl font-bold tracking-tight">NOSSOS VEÍCULOS</h1>
                    <p class="text-xl lg:text-2xl mt-4 font-medium">ENCONTRE SEU CARRO PERFEITO</p>
                </div>
            </div>

            {{-- A Grelha (Grid) de 3 Colunas (agora completa) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">

                @forelse ($vehicles as $vehicle)
                    {{-- O Cartão (Card) do Veículo --}}
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                        <a href="{{ route('public.show', $vehicle->id) }}">
                            <img src="{{ $vehicle->main_image_url }}" 
                                 alt="{{ $vehicle->vehicleModel->name }}" 
                                 class="w-full h-80 object-cover">
                        </a>
                        <div class="p-6 flex-grow">
                            <h5 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                {{ $vehicle->vehicleModel->brand->name }} {{ $vehicle->vehicleModel->name }}
                            </h5>
                            <p class="text-md text-gray-600 dark:text-gray-400 mt-1">
                                Cor: {{ $vehicle->color->name }}
                            </p>
                            <p class="text-3xl font-bold text-gray-900 dark:text-white my-4">
                                R$ {{ number_format($vehicle->price, 2, ',', '.') }}
                            </p>
                            <div class="flex justify-between text-md text-gray-600 dark:text-gray-400 border-t border-gray-200 dark:border-gray-700 pt-3">
                                <span>
                                    <strong>Ano:</strong>
                                    {{ $vehicle->year }}
                                </span>
                                <span>
                                    <strong>KM:</strong>
                                    {{ number_format($vehicle->mileage, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6 pt-0">
                            <a href="{{ route('public.show', $vehicle->id) }}" class="inline-flex items-center justify-center w-full px-4 py-4 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-base text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Ver Detalhes
                            </a>
                        </div>
                    </div>
                @empty
                    {{-- Se não houver carros --}}
                    <div class="lg:col-span-3 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-center text-gray-900 dark:text-gray-100">
                            Nenhum veículo encontrado no momento.
                        </div>
                    </div>
                @endforelse {{-- <-- O FIM QUE FALTAVA --}}
        
            </div> {{-- Fim da Grelha (Grid) --}}

        </div>
    </div>
@endsection {{-- <-- O FIM QUE FALTAVA --}}