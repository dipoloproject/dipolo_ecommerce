<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MediaFile extends Model
{
    use HasFactory;



    
    public static function Alta($argumentos){
        $rs_mdl= DB::SELECT('CALL sp_archivosmultimedia_alta( ?, ? );', $argumentos);      //echo "<pre>";var_dump($rs_mdl[0]);exit;
        //var_dump(sizeof($rs_mdl));exit;

        return $rs_mdl;
    }

}
