<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class UserDev extends Model
{
    use HasFactory;


    
    public static function Existe($argumentos){
        
        $rs_mdl= DB::SELECT('CALL sp_usuarios_existe( ?, ?);', $argumentos);
        //var_dump(sizeof($rs_mdl));exit;

        return $rs_mdl;
    }

}
