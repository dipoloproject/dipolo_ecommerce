<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;      // agregado (no venia incluido cuando se creó el modelo)



class Role extends Model
{
    use HasFactory;


    public static function Listar(){
        
        $rs_mdl= DB::SELECT('CALL sp_roles_listar();');

        return $rs_mdl;
    }

    public static function Alta($argumentos){
        
        $rs_mdl= DB::SELECT('CALL sp_roles_alta(?, ?, ?);', $argumentos);      //echo "<pre>";var_dump($rs_mdl[0]);exit;
        //var_dump(sizeof($rs_mdl));exit;

        return $rs_mdl;
    }

    public static function Elimina_permisos($argumento){
        
        $rs_mdl= DB::SELECT('CALL sp_roles_eliminar_permisos(?);', $argumento);      //echo "<pre>";var_dump($rs_mdl[0]);exit;
        //var_dump(sizeof($rs_mdl));exit;

        return $rs_mdl;
    }

    public static function Alta_permiso($argumentos){
        
        $rs_mdl= DB::SELECT('CALL sp_roles_alta_permiso( ?, ?);', $argumentos);      //echo "<pre>";var_dump($rs_mdl[0]);exit;
        //var_dump(sizeof($rs_mdl));exit;

        return $rs_mdl;
    }


    public static function Dame_rol($argumentos){
        
        $rs_mdl= DB::SELECT('CALL sp_roles_dame(?);', $argumentos);    //var_dump(sizeof($rs_mdl));exit;

        return $rs_mdl;
    }


    public static function Buscar_xid($argumentos){
        
        $rs_mdl= DB::SELECT('CALL sp_roles_dame(?);', $argumentos);
        //var_dump(sizeof($rs_mdl));exit;

        return $rs_mdl;
    }

    public static function Actualiza($argumentos){
        
        $rs_mdl= DB::SELECT('CALL sp_roles_actualizar(?, ?, ?, ?);', $argumentos);      //echo "<pre>";var_dump($rs_mdl[0]);exit;
        //var_dump(sizeof($rs_mdl));exit;

        return $rs_mdl;
    }


    public static function Elimina($argumentos){
        
        $rs_mdl= DB::SELECT('CALL sp_roles_eliminar(?);', $argumentos);      //echo "<pre>";var_dump($rs_mdl[0]);exit;
        //var_dump(sizeof($rs_mdl));exit;

        return $rs_mdl;
    }


}
