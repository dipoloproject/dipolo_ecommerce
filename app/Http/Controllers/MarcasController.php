<?php

namespace App\Http\Controllers;

use App\Models\Marca;

use Illuminate\Http\Request;

class MarcasController extends Controller
{

    public function crear()
    {

        return view('administration/marcas/create');
    }

    public function guardar()
    {

        $campos = json_decode($_POST['campos_ajax']);   //echo "<pre>";   var_dump($campos);exit;
    
        
        $nombre= $campos->input_nombre;
        
        
        $argumentos=[
            $nombre
        ];
        
        $rs_marca = Marca::Alta($argumentos);

        /*  Se retorna de esta manera para poder enviar más variables de ser necesario
        Por ejemplo: return response()->json([
                                            'modelos'=> $modelos, 
                                            'variable1'=> 123456,
                                            'variable2'=> true
                                        ]);
        */
        var_dump($rs_marca);exit;

        return response()->json([
            //'hay_registros'=> $hay_registros,
            'rs_marca'=> $rs_marca
        ]); //  esto se retorn al ajax


    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
