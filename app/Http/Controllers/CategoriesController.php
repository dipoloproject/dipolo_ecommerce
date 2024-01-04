<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function ver_todos(){

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

        function show_badge($cant){
            if($cant>0){
                return '<span class="badge float-none" style="vertical-align: top;">'.$cant.'</span>';
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
                    $row1[$id]['text'] =                        '   <span class="btn m-2 p-0">'.$categoria->nombreRubro.'</span>'.
                                                                '  <button  class="m-2 float-right btn btn-danger"
                                                                            style=" " 
                                                                            onclick="deleteCategoryButtonPressed('.$id.')">
                                                                                <i class="fas fa-trash-alt fa-lg text-white"></i>
                                                                    </button>'.
                                                                '   <button class="m-2 float-right btn btn-primary" 
                                                                            style=" "
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
