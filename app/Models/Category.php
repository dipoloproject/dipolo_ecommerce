<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;


class Category extends Model
{
    use HasFactory;


    public static function Buscar(){
        
        $rs_mdl= DB::SELECT('CALL sp_categorias_listar();');
        //var_dump(sizeof($rs_mdl));exit;

        return $rs_mdl;
    }



    
    public static function Buscar_hijos_xidRubroPadre($argumentos){
        
        $rs_mdl= DB::SELECT('CALL sp_categorias_buscar_hijos_xidRubroPadre(?);', $argumentos);
        //var_dump(sizeof($rs_mdl));exit;

        return $rs_mdl;
    }

    public static function Alta($argumentos){
        
        $rs_mdl= DB::SELECT('CALL sp_categorias_alta(?, ?, ?, ?, ?, ?, ?);', $argumentos);      //echo "<pre>";var_dump($rs_mdl[0]);exit;
        //var_dump(sizeof($rs_mdl));exit;

        return $rs_mdl;
    }


    public static function Elimina($argumentos){
        
        $rs_mdl= DB::SELECT('CALL sp_categorias_eliminar(?);', $argumentos);      //echo "<pre>";var_dump($rs_mdl[0]);exit;
        //var_dump(sizeof($rs_mdl));exit;

        return $rs_mdl;
    }



    public static function Dame_rubro($argumentos){
        
        $rs_mdl= DB::SELECT('CALL sp_categorias_dame(?);', $argumentos);    //var_dump(sizeof($rs_mdl));exit;

        return $rs_mdl;
    }

    public static function Buscar_xid($argumentos){
        
        $rs_mdl= DB::SELECT('CALL sp_categorias_buscar_id(?);', $argumentos);
        //var_dump(sizeof($rs_mdl));exit;

        return $rs_mdl;
    }


    public static function Actualiza($argumentos){
        
        $rs_mdl= DB::SELECT('CALL sp_categorias_actualizar(?, ?, ?, ?, ?, ?, ?, ?);', $argumentos);      //echo "<pre>";var_dump($rs_mdl[0]);exit;
        //var_dump(sizeof($rs_mdl));exit;

        return $rs_mdl;
    }



}
