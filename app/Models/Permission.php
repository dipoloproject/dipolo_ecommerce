<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;      // agregado (no venia incluido cuando se creó el modelo)



class Permission extends Model
{
    use HasFactory;



    public static function Listar_xidRol($argumentos){
        
        $rs_mdl= DB::SELECT('CALL sp_permisos_listar_xidRol(?);', $argumentos);       //var_dump($rs_mdl);exit;

        return $rs_mdl;
    }

    public static function Listar_xusuarioxpassword($argumentos){
        
        $rs_mdl= DB::SELECT('CALL sp_permisos_listar_xusuarioxpassword(?,?);', $argumentos);       //var_dump($rs_mdl);exit;

        return $rs_mdl;
    }


    public static function Buscar(){
        
        $rs_mdl= DB::SELECT('CALL sp_permisos_listar();');
        //var_dump(sizeof($rs_mdl));exit;

        return $rs_mdl;
    }

    public static function Buscar_hijos_xidPermisoPadre($argumentos){
        
        $rs_mdl= DB::SELECT('CALL sp_permisos_buscar_hijos_xidPermisoPadre(?);', $argumentos);
        //var_dump(sizeof($rs_mdl));exit;

        return $rs_mdl;
    }


}
