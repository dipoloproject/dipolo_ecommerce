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

    public function handle(Request $request, Closure $next, string $roles_ruta) {
        session_start();    // para poder ingresar a las variables de sesion

                //echo get_class(\Request::route()->getController());exit;
                //echo substr($request, 0, strpos($request, '/'));exit;

        //  RECUPERA LA ACCION de la ruta DESTINO
            $name_route= $request->route()->getName();  //exit;
            $action= substr($name_route, strrpos($name_route, '.') + 1);//exit;
        
        //  RECUPERA el CONTROLADOR de la ruta DESTINO
            $array= explode('.', $name_route);
            $controller= $array['1'];
                //var_dump($array= explode('.', $name_route));exit;
                //echo $controller = $array['1'];exit;
                //echo substr($action, 0, strpos($action, '.'));exit;
        //  FORMA EL NOMBRE DEL PERMISO
            $permission_route= $controller.'.'.$action;    //echo $permission_route;exit;
       

            //echo "<pre>";var_dump($_SESSION['user_permissions']);exit;
            //echo "<pre>";var_dump($permission_route);exit;

        //echo "<pre>";var_dump(explode('|',$roles));exit; // esta linea ME SIRVE
        $array_roles_route=explode('|',$roles_ruta);
        //echo "Roles de la ruta<pre>";var_dump($array_roles_route);//exit;
        
        //$result = array_search("$Controller@$Action",);
       //echo $result;   exit;

        /* Consulta si el usuario inició sesión*/
        if( !isset($_SESSION['user_login']) ){     // redirigir a pantalla de LOGUEO
            return redirect('/login');
        }else{
            /* Consulta si el usuario que se logueó tiene permiso */
            $have_permission = array_search($permission_route, $_SESSION['user_permissions']);       //var_dump($result);exit;
            if($have_permission){
                    //echo 'TIENE PERMISO';exit;
                //return $next($request);             // REDIRIGIR a página solicitada
                //$_SESSION['enable']= true;
            }else{
                //return $next;
                //echo 'NO TIENE PERMISO';//exit;
                //return $next($request);             // REDIRIGIR a página solicitada
                //$_SESSION['enable']= false;
            }
            return $next($request);             // REDIRIGIR a página solicitada
        }
        // if-else
    }   // function handle

}
