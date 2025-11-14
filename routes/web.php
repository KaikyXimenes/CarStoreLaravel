<?php

use Illuminate\Support\Facades\Route;
// Importar os nossos "cérebros" (Controllers)
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\VehicleModelController; // Importa o cérebro
use App\Http\Controllers\Admin\ColorController; 
use App\Http\Controllers\Admin\VehicleController; 

/*
|--------------------------------------------------------------------------
| Rotas Públicas (Área do Visitante)
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'index'])->name('public.index');
Route::get('/veiculo/{id}', [PublicController::class, 'show'])->name('public.show');


/*
|--------------------------------------------------------------------------
| Rotas de Admin (Protegidas)
|--------------------------------------------------------------------------
*/

// Rota do Dashboard (Protegida)
// O "cérebro" do Login (Breeze) procura por esta rota com o nome 'dashboard'
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('dashboard'); // <-- O nome é 'dashboard'


// Rotas de Gestão (CRUDs)
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Rota /admin/dashboard (para o nosso link do "Voltar")
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard'); // O nome fica 'admin.dashboard'

    // Cadastro (CRUD) de Marcas
    Route::resource('brands', BrandController::class);

    // Cadastro (CRUD) de Modelos (DECLARADO APENAS UMA VEZ)
    Route::resource('models', VehicleModelController::class); 

    // Cadastro (CRUD) de Cores
    Route::resource('colors', ColorController::class); 
    
    // Cadastro (CRUD) de Veículos
    Route::resource('vehicles', VehicleController::class); 

});


/*
|--------------------------------------------------------------------------
| Rotas de Autenticação e Perfil (Geridas pelo Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// "Puxa" as rotas de login/registo, etc. do ficheiro auth.php
require __DIR__.'/auth.php';