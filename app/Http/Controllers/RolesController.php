<?php

namespace App\Http\Controllers;

//  MODELOS 
    use App\Models\Product;
    use App\Models\Role;
    use App\Models\Permission;
    use App\Models\Category;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



     public function ver_todos(){
        //$categorias = Product::Get_all_categories();    
        return view('administration/roles/ver_todos');
    }


    public function ajax_fetch_roles(){
        
        $roles = Role::Listar();

        /*  Se retorna de esta manera para poder enviar más variables de ser necesario
            Por ejemplo: return response()->json([
                                                'modelos'=> $modelos, 
                                                'variable1'=> 123456,
                                                'variable2'=> true
                                            ]);
        */
            
        /*  Convierte el resultset (vector de objetos) en un vector de vectores asociativos 
        para poder ser leido en archivo javascript*/
            $elements_to_ajax =modelresult_to_datatables($roles);
            //var_dump($elements_to_ajax);exit;
    
        //  Retorna al archvo show_locations_according_dpto.js un vector de vectores asociativos
            echo json_encode($elements_to_ajax); //var_dump($array);exit;
    }


    public function ajax_fetch_permisos_xidRol(){
        
        $id= intval($_POST['idRol_ajax']);      //echo $id;exit;
        $argumentos=[
                        $id
                    ];
        $permisos = Permission::Listar_xidRol($argumentos);         //var_dump($permisos);exit;
                                                                    //echo sizeof($permisos);exit;

        //if(sizeof($permisos)>0){
            /*  Convierte el resultset (vector de objetos) en un vector de vectores asociativos 
            para poder ser leido en archivo javascript*/
            $element_to_ajax= modelresult_to_ajax_v2($permisos);       //var_dump($element_to_ajax);exit;    
        //}

        /*  Convierte el resultset (vector de objetos) en un vector de vectores asociativos 
        para poder ser leido en archivo javascript*/
            //$element_to_ajax= modelresult_to_ajax($permisos);       var_dump($element_to_ajax);exit;

            return response()->json([
                //'hay_registros'=> $hay_registros,
                'permisos'=> $element_to_ajax
            ]); //  esto se retorn al ajax
    }



    
    public function ajaxpro_treeview_permissions(){      

        /*function show_badge($cant){
            if($cant>0){
                return '<span   class="badge float-none bg-info" 
                                style="vertical-align: top;">'.$cant.'</span>';
            }else{
                return '';
            }
        }*/

        function membersTree($parentKey){

            $row1= array();
            $argumentos=[
                intval($parentKey)
            ];
            //$sql = 'SELECT id, name from item WHERE parent_id="'.$parentKey.'"';
            $permisos_hijas = Permission::Buscar_hijos_xidPermisoPadre($argumentos);   //echo "<pre>";var_dump($permisos_hijas);
                //var_dump(sizeof($permisos_hijas));exit;


            if(sizeof($permisos_hijas)>0){
                foreach($permisos_hijas as $permiso){

                    // Determina numero en badge
                        $argumentos=[
                            intval($permiso->idPermiso)
                        ];
                        $permisos = Permission::Buscar_hijos_xidPermisoPadre($argumentos);   //echo "<pre>";var_dump($permisos_hijas);
                    //\.Determina numero en badge


                    $id = $permiso->idPermiso;
                    $row1[$id]['id'] = $permiso->idPermiso;
                    //$row1[$id]['name'] = $permiso->nombreRubro;
                    $row1[$id]['text'] =                        '   <span class="btn p-0" style="margin:15px 15px 15px 0px;">'.$permiso->descripcionPermiso.'</span>'.'';
                                                                // '  <button  class="m-2 float-right btn btn-danger"
                                                                //             style=" " 
                                                                //             onclick="deleteCategoryButtonPressed('.$id.')">
                                                                //                 <i class="fas fa-trash-alt fa-lg text-white"></i>
                                                                //     </button>'.
                                                                // '   <button class="m-2 float-right btn btn-primary" 
                                                                //             style=" "
                                                                //             onclick="editCategoryButtonPressed('.$id.')">
                                                                //                 <i class="fas fa-edit fa-lg text-white"></i>
                                                                //     </button>'/*.
                                                                //     show_badge(sizeof($permisos))*/;
                            

                    //  Se determina si el nodo hijo (actual) posee hijos
                        /*  
                            Para así de esa forma determinar de antemano si existirá la propiedad nodes. 
                            De esta manera la permiso tendrá + (contiene hijos) ó NADA    
                        */
                        $argumentos=[
                            intval($id)
                        ];
                        $permisos = Permission::Buscar_hijos_xidPermisoPadre($argumentos);   //echo "<pre>";var_dump($permisos_hijas);
                        if(sizeof($permisos)>0){
                            $row1[$id]['nodes'] = array_values(membersTree($permiso->idPermiso));
                        }
                    
                }
    
            }

            return $row1;
        }




        //require 'db_config.php';
        //$mysqli = new mysqli('localhost', 'root', '123456', 'dipolo');
  
        $parentKey = $_POST['idPermisoPadre_ajax'];
        //$sql = "SELECT * FROM item";
      
        //$result = $mysqli->query($sql);
       

        
        /* Buscar permisos particulares -> se pasa parámetro */
                //echo $_POST['idPermisoPadre_ajax'];exit;
            /*$argumentos=[
                intval($_POST['idPermisoPadre_ajax'])
            ];      //var_dump($argumentos);exit;*/

            //$permisos = Permission::Buscar_hijos_xidPermisoPadre($argumentos);   //var_dump($permisos);exit;
            $permisos = Permission::Buscar();   //var_dump($permisos);exit;

        //echo sizeof($permisos);exit;

          if(sizeof($permisos) > 0)
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




    public function actualizar_permisos_roles(){
        //  Ver contenido completo de $request (todo)
            //return $request->all();exit;
            //var_dump($_POST['array_nuevos_permisos']);exit;
            //var_dump(isset($_POST['array_nuevos_permisos']));exit;

        //  ELIMINACION de ACTUALES permisos -> que serían VIEJOS PERMISOS
            $argumento=[
                        intval($_POST['idRol_ajax']),
                    ];      //var_dump($argumento);exit;
            $rs_delete = Role::Elimina_permisos($argumento);  //echo "<pre>";var_dump($rs_delete[0]->mensaje);exit;        
                $rs = $rs_delete;

        /*  
            SI se tildó algun permiso, SE DA DE ALTA AL PERMISO, de lo contrario, 
            NO se hace nada (sólo se habrán eliminado los permisos como se indica en el paso anterior, 
                            lo cual a nivel semántico está bien porque quiere decir que NO SE TILDÓ NINGUN PERMISO POR LO QUE SE ELIMINAN LOS QUE YA ESTAN EN LA BASE DE DATOS)
        */
            if( isset($_POST['array_nuevos_permisos'])  ){
                //  ALTA DE NUEVOS PERMISOS
                    foreach(    $_POST['array_nuevos_permisos'] as $id_nuevo_permiso){
                        //  ACTUALIZACION EN BASE DE DATOS
                            $argumentos=[
                                // PARAMETROS OBLIGATORIOS
                                        intval($_POST['idRol_ajax']),
                                        $id_nuevo_permiso,
                                    ];      //var_dump($argumentos);exit;
                            $rs_update = Role::Alta_permiso($argumentos);  //echo "<pre>";var_dump($rs_update[0]->mensaje);exit;
                    }   //exit;
                        $rs = $rs_update;
                //  \.ACTUALIZACION EN BASE DE DATOS
            }
        
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
                    'mensaje_alta_permisos_rol'=> $rs[0]->mensaje
            ]); //  esto se retorn al ajax
        
        ####fin de ejecución
    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
