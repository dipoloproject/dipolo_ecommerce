<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle(Request $request, Closure $next) {
        session_start();    // para poder ingresar a las variables de sesion

        if( !isset($_SESSION['user_login']) ){     // redirigir a pantalla de LOGUEO
            return redirect('/login');
        }else{
            return $next($request);             // REDIRIGIR a página solicitada
        }
        // if-else
    }   // function handle

}
