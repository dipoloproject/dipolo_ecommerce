<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Marca extends Model
{
    use HasFactory;

    public static function Alta($argumentos){
        //$rs_mdl=1;
        $rs_mdl= DB::SELECT('CALL sp_marcas_alta(?);', $argumentos);
        //var_dump(sizeof($rs_mdl));exit;

        return $rs_mdl;
    }
}
