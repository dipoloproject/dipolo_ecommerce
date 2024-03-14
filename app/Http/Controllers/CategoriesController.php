<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Origin;
use App\Models\MediaFile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;


use Illuminate\Support\Facades\Route;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function ver_todos(){
        

        
        
            //echo "<pre>";var_dump(Route::currentRouteAction());exit;     // devuelve App\Http\Controllers\<controlador@metodo>
            //echo "<pre>";var_dump(Route::currentRouteName());exit;     // devuelve alias de la ruta
            //echo "<pre>";var_dump(Route::getCurrentRoute()->getAction()['controller']);exit;
            //echo "<pre>";var_dump(Route::getCurrentRoute()->getAction());exit;

        $categorias = Product::Get_all_categories();

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
        //$mensaje = Product::Get_all();

        
        //var_dump($mensaje[0]->resultado);exit;


        return view('administration/categories/ver_todos', compact('categorias'));
    }


    public function ajaxpro(){

        session_start();

        function show_badge($cant){
            if($cant>0){
                return '<span   class="badge float-none bg-info" 
                                style="vertical-align: top;">'.$cant.'</span>';
            }else{
                return '';
            }
        }

        
        function membersTree($parentKey){

            $row1= array();
                
            $argumentos=[
                intval($parentKey)
            ];
            //$sql = 'SELECT id, name from item WHERE parent_id="'.$parentKey.'"';
            $categorias_hijas = Category::Buscar_hijos_xidRubroPadre($argumentos);   //echo "<pre>";var_dump($categorias_hijas);
                //var_dump(sizeof($categorias_hijas));exit;

            //var_dump(hide_style("categorias_editar"));//exit;
            
            
            $show_hide_editar= hide_style("categorias.editar");
            $show_hide_eliminar= hide_style("categorias.eliminar");
            

            if(sizeof($categorias_hijas)>0){
                foreach($categorias_hijas as $categoria){


                    // Determina numero en badge
                        $argumentos=[
                            intval($categoria->idRubro)
                        ];
                        $categorias = Category::Buscar_hijos_xidRubroPadre($argumentos);   //echo "<pre>";var_dump($categorias_hijas);
                    //\.Determina numero en badge


                    $id = $categoria->idRubro;
                    $row1[$id]['id'] = $categoria->idRubro;
                    //$row1[$id]['name'] = $categoria->nombreRubro;
                    $row1[$id]['text'] =                        '   <span class="btn p-0" style="margin:15px 15px 15px 0px;">'.$categoria->nombreRubro.'</span>'.
                                                                '  <button  class="m-2 float-right btn btn-danger"
                                                                            style="'.$show_hide_eliminar.'" 
                                                                            onclick="deleteCategoryButtonPressed('.$id.')">
                                                                                <i class="fas fa-trash-alt fa-lg text-white"></i>
                                                                    </button>'.
                                                                '   <button class="m-2 float-right btn btn-primary" 
                                                                            style="'.$show_hide_editar.'"
                                                                            onclick="editCategoryButtonPressed('.$id.')">
                                                                                <i class="fas fa-edit fa-lg text-white"></i>
                                                                    </button>'.
                                                                    show_badge(sizeof($categorias));


                    //  Se determina si el nodo hijo (actual) posee hijos
                        /*  
                            Para así de esa forma determinar de antemano si existirá la propiedad nodes. 
                            De esta manera la categoria tendrá + (contiene hijos) ó NADA    
                        */
                        $argumentos=[
                            intval($id)
                        ];
                        $categorias = Category::Buscar_hijos_xidRubroPadre($argumentos);   //echo "<pre>";var_dump($categorias_hijas);
                        if(sizeof($categorias)>0){
                            $row1[$id]['nodes'] = array_values(membersTree($categoria->idRubro));
                        }
                    
                }
    
            }

            return $row1;
        }




        //require 'db_config.php';
        //$mysqli = new mysqli('localhost', 'root', '123456', 'dipolo');
  
        $parentKey = '0';
        //$sql = "SELECT * FROM item";
      
        //$result = $mysqli->query($sql);
       
        $categorias = Category::Buscar();   //var_dump($categorias);exit;

        //echo sizeof($categorias);exit;

          if(sizeof($categorias) > 0)
          {
              $data = membersTree($parentKey);
          }else{
              $data=["id"=>"0","name"=>"No Members present in list","text"=>"No Members is present in list","nodes"=>[]];
          }
       
        //echo '<pre>';var_dump($data);exit;
      
          echo json_encode(array_values($data));


        //$productos = Product::Buscar();

        /*  Se retorna de esta manera para poder enviar más variables de ser necesario
            Por ejemplo: return response()->json([
                                                'modelos'=> $modelos, 
                                                'variable1'=> 123456,
                                                'variable2'=> true
                                            ]);
        */
            
        /*  Convierte el resultset (vector de objetos) en un vector de vectores asociativos 
        para poder ser leido en archivo javascript*/
            //$elements_to_ajax =modelresult_to_datatables($productos);
            //var_dump($elements_to_ajax);exit;
    
        //  Retorna al archvo show_locations_according_dpto.js un vector de vectores asociativos
            //echo json_encode($elements_to_ajax); //var_dump($array);exit;
    }//\.ajaxpro


    public function crear(){
        //$marcas = Product::Get_all_brands();
        $categorias = Product::Get_all_categories();
        //$origenes = Origin::List_all_origins();

        $create_edit= "create";

        return view('administration/categories/create', compact( 'categorias', 'create_edit'));
    }


    public function subir_categoria(Request $request){

        /*  Mirar contenido de $request (archivos seleccionados)    */
                //return $request->file('archivos')[1];exit;
                //return $request->all();exit;

        //  GUARDADO EN BASE DE DATOS
            $argumentos=[
                            // PARAMETROS OBLIGATORIOS
                                $request->input_nombreRubro,
                                intval($request->input_ordenRubro),
                                $request->input_destacadoRubro,
                                $request->input_menuRubro,
                                $request->input_estadoRubro,
                            // PARAMETROS OPCIONALES
                                intval($request->input_idRubroPadre),
                                $request->input_descripcionRubro,

                        ];                                  //echo "<pre>";var_dump($argumentos);exit;
            $rs_insert = Category::Alta($argumentos);       //echo "<pre>";var_dump($rs_insert);exit;

        //  \.GUARDADO EN BASE DE DATOS


        /*  Se retorna de esta manera para poder enviar más variables de ser necesario
            Por ejemplo: return response()->json([
                                                'modelos'=> $modelos, 
                                                'variable1'=> 123456,
                                                'variable2'=> true
                                            ]);
        */
            return response()->json([
                /*  Aquí sí se definen ambas keys. 
                    La key-value 'mensaje_error'="" quiere decir que NO hubo errores al cargar archivos */
                    'mensaje_error'=> "",
                    'mensaje_creacion_categoria'=> $rs_insert[0]->mensaje
            ]); //  esto se retorn al ajax
    }


    
    public function eliminar_categoria(Request $request){

        /*  Mirar contenido de $request (archivos seleccionados)
            return $request->file('archivos')[1];exit;*/
        
        $idRubro= intval($request->idRubro_ajax);        //echo $request->idRubro_ajax; exit;

        // ELIMINAR registros de la base de datos
            $argumentos=[
                            $idRubro,
                        ];                                  //var_dump($argumentos);exit;
            $rs_delete = Category::Elimina($argumentos);  //echo "<pre>";var_dump($rs_insert_rt_id);exit;


            return response()->json([
                /*  Aquí sí se definen ambas keys. 
                    La key-value 'mensaje_error'="" quiere decir que NO hubo errores al cargar archivos */
                    'mensaje_error'=> "",
                    'mensaje_eliminacion_categoria'=> $rs_delete[0]->mensaje
            ]); //  esto se retorn al ajax
    }





    public function editar(Request $request){
        $marcas = Product::Get_all_brands();
        $categorias = Product::Get_all_categories();
        $origenes = Origin::List_all_origins();

        $create_edit= "edit";

            //var_dump($request['id']);exit;
        // Recuperar PRODUCTO segun id
            $argumentos=[
                intval($request['id'])
            ];
            $rubro= Category::Dame_rubro($argumentos)[0];       //echo "<pre>";var_dump($rubro);exit;

        return view('administration/categories/edit', compact('marcas', 'categorias' ,'origenes', 'create_edit', 'rubro'));
    }



    public function ajax_fetch_rubro_xid(){
        
        $id= intval($_POST['idRubro_ajax']);
        $argumentos=[
                        $id
                    ];
        $producto = Category::Buscar_xid($argumentos);

        /*  Convierte el resultset (vector de objetos) en un vector de vectores asociativos 
        para poder ser leido en archivo javascript*/
            $element_to_ajax= modelresult_to_ajax($producto);

            return response()->json([
                //'hay_registros'=> $hay_registros,
                'rubro'=> $element_to_ajax
            ]); //  esto se retorn al ajax
    }



    public function actualizar_categorias(Request $request){

        /*  Mirar contenido de $request (archivos seleccionados)
            return $request->file('archivos')[1];exit;
        */
        /*  Mirar contenido de $request (todo)
            return $request;exit;
        */

        //  RECUPERA idProducto del campo hidden
            //$idRubro= intval($request->input_hidden_idRubro);

        //  Ver contenido completo de $request (todo)
            //return $request->all();exit;


        //  CONTROLAR que NO sea categoria hija/nieta de si misma
            $permitido= false;  // se inicializa una bandera

            $idRubroPadre= intval($request->input_idRubroPadre);    // guarda el idRubroPadre que se prentede actualizar

            while( $idRubroPadre !=  intval($request->input_hidden_idRubro) && $permitido==false ){
                /* Este ciclo while se detiene si se pretende que el Rubro sea hijo/nieto de si mismo */
                    $argumento=[
                        intval($idRubroPadre),
                    ];

                    if(intval($idRubroPadre)==0){   // el Rubro no tendrá padre (rubro genérico), ó puede ser hijo/nieto del Rubro en cuestión
                        $permitido= true;
                    }else{                          // se obtiene el padre del Rubro padre en cuestión (se analisan padres/abuelos)
                        $rs= Category::Dame_RubroPadre_xidRubroPadre($argumento);
                        $idRubroPadre= $rs[0]->idRubroPadre;
                    }
                
            }

            if($permitido==false){
                //  NO es posible que un Rubro sea  hijo/nieto de si mismo
                    return response()->json([
                        /*  Aquí sí se definen ambas keys. 
                            La key-value 'mensaje_error'="" quiere decir que NO hubo errores al cargar archivos */
                            'mensaje_error'=> "La categoría NO puede ser hija/nieta de sí misma",
                            'mensaje_creacion_categoria'=> ""
                    ]); //  esto se retorn al ajax
                    exit;   // se da fin a la ejecución del código aqui
            }   
            ####posible fin de ejecución
        //\.CONTROLAR que NO sea categoria hija/nieta de si misma

        # Si se llega hasta aquí, es porque ES POSIBLE LA ACTUALIZACION #
        //  ACTUALIZACION EN BASE DE DATOS
            $argumentos=[
                    // PARAMETROS OBLIGATORIOS
                            intval($request->input_hidden_idRubro),
                            $request->input_nombreRubro,
                            intval($request->input_ordenRubro),
                            $request->input_destacadoRubro,
                            $request->input_menuRubro,
                            $request->input_estadoRubro,
                    // PARAMETROS OPCIONALES
                            intval($request->input_idRubroPadre),
                            $request->input_descripcionRubro,
                        ];      //var_dump($argumentos);exit;
            $rs_update = Category::Actualiza($argumentos);  //echo "<pre>";var_dump($rs_update[0]->mensaje);exit;
           

        //  \.ACTUALIZACION EN BASE DE DATOS
        /*  Se retorna de esta manera para poder enviar más variables de ser necesario
            Por ejemplo: return response()->json([
                                                'modelos'=> $modelos, 
                                                'variable1'=> 123456,
                                                'variable2'=> true
                                            ]);
        */
            return response()->json([
                /*  Aquí sí se definen ambas keys. 
                    La key-value 'mensaje_error'="" quiere decir que NO hubo errores al cargar archivos */
                    'mensaje_error'=> "",
                    'mensaje_creacion_categoria'=> $rs_update[0]->mensaje
            ]); //  esto se retorn al ajax
        
        ####fin de ejecución
    }








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





