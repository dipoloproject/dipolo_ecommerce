<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;


    public static function Get_all(){
        
        $rs_mdl= DB::SELECT('CALL sp_return_something();');

        return $rs_mdl;
    }


    public static function Get_all_brands(){
        
        $rs_mdl= DB::SELECT('CALL sp_marcas_buscar();');

        return $rs_mdl;
    }

    public static function Get_all_categories(){
        
        $rs_mdl= DB::SELECT('CALL sp_rubros_buscar();');

        return $rs_mdl;
    }


    public static function Buscar_xmarca($argumentos){
        
        $rs_mdl= DB::SELECT('CALL sp_modelos_buscar_xmarca(?);', $argumentos);
        //var_dump(sizeof($rs_mdl));exit;

        return $rs_mdl;
    }
}   //\.class Product extends Model
