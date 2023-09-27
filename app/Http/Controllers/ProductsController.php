<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home(){
        return view('home');
    }

    public function index(){
        return view('administration/index');
        //return view('index');
    }

    public function ver_todos(){
        /*$argumentos = [
            $request->IdCategoriaPadre,
            $request->Categoria,
            $request->Descripcion,
            $request->Orden,
            $request->Destacado,
            $request->Menu,
        ];*/

        // 
        // $mensaje = Product::Get_all($argumentos);
        $mensaje = Product::Get_all();

        
        var_dump($mensaje[0]->resultado);exit;


        return view('administration/ver_todos');
    }

    public function crear(){
        $marcas = Product::Get_all_brands();
        $categorias = Product::Get_all_categories();
        //echo "<pre>";var_dump($categorias);exit;
        //$manco='chupala';
        return view('administration/products/create', compact('marcas', 'categorias'));
        //return view('index');
    }

    public function buscar_xmarca(){
        $idMarca=  $_POST['idMarca_ajax'];
        $argumentos=[
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
            return response()->json([
                //'hay_registros'=> $hay_registros,
                'modelos'=> $modelos
            ]); //  esto se retorn al ajax
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
