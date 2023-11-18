<?php

namespace App\Http\Controllers;

use App\Models\MediaFile;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MediaFilesController extends Controller
{
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



    public function ver_orden(Request $request){
        //var_dump($request['id']);exit;
        $argumentos=[
            intval($request['id'])
        ];
        $archivos = MediaFile::Dame_archivos_multimedia_xidProducto($argumentos);  //echo "<pre>";var_dump($archivos);exit;
        //$archivos=123;

            //$result = json_encode($producto);
                // convert object $result to array
            //$producto = json_decode($result, true);

        return view('administration/media_files/ver_todos', compact('archivos'));
    }


    public function ajax_fetch_order_media_files(){
        //var_dump($request);exit;

        $sorts=  $_POST['sorts_ajax'];  //var_dump($sorts);exit;

        $position= 1;
        foreach($sorts as $sort){
            //guardar position en registro con id= sort
            //echo $sort;
            $argumentos=[
                            $sort,
                            $position
            ];
            $update = MediaFile::Reordenar_archivo_multimedia($argumentos);
            $position++;
        }
        //exit;
        /*$argumentos=[
                        $idMarca
                    ];
        $modelos = Product::Buscar_xmarca($argumentos);

        /*  Se retorna de esta manera para poder enviar más variables de ser necesario
            Por ejemplo: return response()->json([
                                                'modelos'=> $modelos, 
                                                'variable1'=> 123456,
                                                'variable2'=> true
                                            ]);
        */
        
        $rs_salida_sp= "ok";    //  RESPUESTA TEMPORAL
        return response()->json([
            /*  Aquí sí se definen ambas keys. 
                La key-value 'mensaje_error'="" quiere decir que NO hubo errores al cargar archivos */
                'mensaje_error'=> "",
                'mensaje_reordenacion_archivos'=> $rs_salida_sp
        ]); //  esto se retorn al ajax
        
        
    }



}
