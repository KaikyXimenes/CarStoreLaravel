<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Precisamos de importar o Auth
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Verifica se o utilizador está logado E se é um admin
        if (Auth::check() && Auth::user()->is_admin) {
            // 2. Se for, deixa o pedido continuar (ir para o Dashboard)
            return $next($request);
        }

        // 3. Se não for admin, redireciona para a página inicial
        //    com uma mensagem de erro (que podemos mostrar no futuro)
        return redirect('/')->with('error', 'Acesso Negado. Você não é um Administrador.');
    }
}