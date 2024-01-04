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



}
