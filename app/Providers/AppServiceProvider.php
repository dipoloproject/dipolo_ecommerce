<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

//  AGREGADO
/*use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Closure;
use Illuminate\Http\Request;*/
//\.AGREGADO

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        
        /*$var= true;
        $novar=false;   //var_dump($novar);exit;
        //$url= $_SERVER['REQUEST_URI'];      //var_dump($url);exit;
        $array_url= explode('/', $url);     //var_dump($array_url);exit;
        $action= $array_url[3];
        $controller= $array_url[2];
        $permission_route= $controller.'.'.$action;     //var_dump($permission_route);exit;

        $items = $this->itemRepo->getItems(session("user_permissions"));    var_dump($items);exit;

        $have_permission = array_search($permission_route, $_SESSION['user_permissions']);       //var_dump($result);exit;
            if($have_permission){
                    //echo 'TIENE PERMISO';exit;
                $enable= true;
            }else{
                //return $next;
                //echo 'NO TIENE PERMISO';//exit;
                $enable= false;
            }


        View::share(['var'=>$var, 'novar'=>$novar, 'enable'=>$enable]);*/
    }
}
