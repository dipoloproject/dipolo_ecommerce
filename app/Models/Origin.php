<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Origin extends Model
{
    use HasFactory;



    public static function List_all_origins(){
        
        $rs_mdl= DB::SELECT('CALL sp_origenes_buscar();');

        return $rs_mdl;
    }



}
