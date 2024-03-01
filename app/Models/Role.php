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



}
