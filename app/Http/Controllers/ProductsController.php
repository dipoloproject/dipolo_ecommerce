<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\MediaFile;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        //$mensaje = Product::Get_all();

        
        //var_dump($mensaje[0]->resultado);exit;


        return view('administration/ver_todos');
    }

    public function crear(){
        $marcas = Product::Get_all_brands();
        $categorias = Product::Get_all_categories();

        return view('administration/products/create', compact('marcas', 'categorias'));
    }


    public function editar(Request $request){
        $marcas = Product::Get_all_brands();
        $categorias = Product::Get_all_categories();
        //var_dump($request['id']);exit;
        // Recuperar PRODUCTO segun id
            $argumentos=[
                intval($request['id'])
            ];
            $producto= Product::Dame_producto($argumentos)[0];
                //echo "<pre>";var_dump($producto);exit;
        //  Recuperar ARCHIVOS MULTIMEDIA segun id del producto
            $archivos = MediaFile::Dame_archivos_multimedia_xidProducto($argumentos);
                //$result = json_encode($producto);
                // // convert object $result to array
                //     $array_asoc = json_decode($result, true);
                //     //echo "<pre>"; var_dump($array_asoc);exit;
                //     $producto=$array_asoc;
            //$result = json_encode($producto);
                // convert object $result to array
            //$producto = json_decode($result, true);

        return view('administration/products/edit', compact('marcas', 'categorias', 'producto', 'archivos'));
    }








    public function ajax_fetch_productos(){

        $productos = Product::Buscar();

        /*  Se retorna de esta manera para poder enviar más variables de ser necesario
            Por ejemplo: return response()->json([
                                                'modelos'=> $modelos, 
                                                'variable1'=> 123456,
                                                'variable2'=> true
                                            ]);
        */
            
        /*  Convierte el resultset (vector de objetos) en un vector de vectores asociativos 
        para poder ser leido en archivo javascript*/
            $elements_to_ajax =modelresult_to_datatables($productos);
            //var_dump($elements_to_ajax);exit;
    
        //  Retorna al archvo show_locations_according_dpto.js un vector de vectores asociativos
            echo json_encode($elements_to_ajax); //var_dump($array);exit;
    }


    public function ajax_fetch_producto_xid(){
        
        $id= intval($_POST['idProducto_ajax']);
        $argumentos=[
                        $id
                    ];
        $producto = Product::Buscar_xid($argumentos);

        /*  Convierte el resultset (vector de objetos) en un vector de vectores asociativos 
        para poder ser leido en archivo javascript*/
            $element_to_ajax= modelresult_to_ajax($producto);

            return response()->json([
                //'hay_registros'=> $hay_registros,
                'producto'=> $element_to_ajax
            ]); //  esto se retorn al ajax
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



    
    public function subir_archivos_productos(Request $request){

        /*  Mirar contenido de $request (archivos seleccionados)
            return $request->file('archivos')[1];exit;
        */

        /*  TRY - Si el/los archivos precargados cumplen con las condiciones, pasa al bloque de GUARDADO*/
        /*  CATCH - De lo contrario, captura el mensaje de error y lo envía al AJAX*/
            try {
                /*  Dentro de la funcion validate() se definen condiciones de validación y los correspondientes
                    mensajes de error según corresponda a la condición que no se cumpla */
                    $request->validate( [   //  impone condiciones a cada elemento del array archivos
                                            'archivos'=> 'required|array|min:1',
                                            'archivos.*'=> 'required|image|max:2048'
                                        ],
                                        [   //  define el mensaje de error a mostrar
                                            'archivos.required'=> 'Es necesario cargar un archivo',
                                            'archivos.*.max'=> 'El tamaño del/algún archivo es muy grande'
                                        ]
                                      );
                    
            } catch (\Illuminate\Validation\ValidationException $th) {
                    //var_dump($th->validator->errors());exit;
                return response()->json([
                    'mensaje_error'=> $th->validator->errors()->first(),
                    'mensaje_creacion_producto'=> ""
                    //  NO se define la key 'mensaje_creacion_producto. Ambas keys se definen más adelante'
                ]);
            }

        //return $request->all();exit;
            //var_dump(intval($request->input_marca));exit;
        //  GUARDADO EN BASE DE DATOS
            $argumentos=[
                            // PARAMETROS OBLIGATORIOS
                                intval($request->input_categoria),
                                intval($request->input_modelo),
                                intval($request->input_marca),
                                $request->input_nombre,
                                $request->input_es_destacado,
                                intval($request->input_stock),
                                $request->input_condicion,
                            // PARAMETROS OPCIONALES
                                $request->input_codigo,
                                $request->input_descripcion,    
                                $request->input_origen,
                                floatval($request->input_precio_tachado),
                                floatval($request->input_precio_venta),
                                floatval($request->input_precio_lista),
                                intval($request->input_orden),
                                intval($request->input_vistas)

                        ];                                  //echo "<pre>";var_dump($argumentos);exit;
            $rs_insert_rt_id = Product::Alta($argumentos);  //echo "<pre>";var_dump($rs_insert_rt_id);exit;

                //debbug($rs_insert_rt_id[0]->mensaje);
            if($rs_insert_rt_id[0]->mensaje=='ok'){ // SI LA INSERCION ANTERIOR FUE EXITOSA, se hace los inserts en tabla Archivos_Multimedia
                              
                //  VECTOR/ARRAY que contendrá nombres de archivos cargados/subidos
                    $vector_filesnames= [];     //var_dump($vector_filesnames);exit;
                
                //  GUARDADO de archivos precargados
                    $conteo = count($_FILES["archivos"]["name"]);   //var_dump($conteo);exit; // cantidad de archivos a subir
                    for ($i = 0; $i < $conteo; $i++) {
                        //  Archivo en sí + Extension
                            $ubicacionTemporal = $_FILES["archivos"]["tmp_name"][$i];
                            $nombreArchivo = $_FILES["archivos"]["name"][$i];
                            $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                        // Renombrar archivo
                            $nuevoNombre = sprintf("%s_%d.%s", uniqid(), $i, $extension);
        
                        //  FORMAR vector de nombres de archivos (necesario para guardar en base de datos)
                            array_push($vector_filesnames, $nuevoNombre);
                        // Mover del temporal al directorio actual
                                //echo $nuevoNombre."<br>";
                                //echo $extension."<br>";
                                //echo filesize($_FILES["archivos"]["tmp_name"][$i])."<br>";  // tamaño en bytes del archivo
                            //move_uploaded_file($ubicacionTemporal, $nuevoNombre);
        
                        //  USAR INTERVENTION IMAGE O LO QUE SEA PARA AJUSTAR TAMAÑO DE IMAGENES - O HACER ESTO FUERA DE ESTE LOOP
        
                        //  Por cada archivo multimedia seleccionado, guarda en ubicacion destino con el nombre previamente establecido
                            $request->file('archivos')[$i]->storeAs('public/archivos_multimedia/', $nuevoNombre);   //DESCOMENTAR - NO GUARDA NADA
                    }
                //\.GUARDADO de archivos precargados



                $idProducto= $rs_insert_rt_id[0]->last_id;      //echo "ultimo id:";var_dump($idProducto);exit;
                
                //  VECTOR que contiene los data-id en el orden deseado
                    $order_vector= explode(",",$request->order_list);   //debbug($order_vector);exit;
                    $i=1;   // iniciar contador (data-id del 1er archivo)

                    foreach($vector_filesnames as $filename){
                        $argumentos=[
                                        intval($idProducto),
                                        $filename, 
                                        array_search($i, $order_vector)+1   //posicion del data-id en el vector ordenado = posicion a ocupar el archivo
                                    ];                                  //echo "<pre>";var_dump($argumentos);exit;
                        $rs_insert_mf = MediaFile::Alta($argumentos);   //echo "<pre>";var_dump($rs_insert_mf);exit;
                        $i++;   // data-id del archivo siguiente
                    }   //exit;
            }

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
                    'mensaje_creacion_producto'=> $rs_insert_rt_id[0]->mensaje
            ]); //  esto se retorn al ajax
    }




    public function actualizar_archivos_y_productos(Request $request){

        /*  Mirar contenido de $request (archivos seleccionados)
            return $request->file('archivos')[1];exit;
        */

        //  RECUPERA idProducto del campo hidden
            $idProducto= intval($request->input_hidden_idProducto);

        //  VECTOR/ARRAY que contendrá nombres de archivos cargados/subidos
            $vector_filesnames= [];     //var_dump($vector_filesnames);exit;

        //  Determina si se cargo o no algun archivo nuevo
            if(isset($_FILES["archivos"])){     //  EXISTE la key "archivos" en la variable $_FILES -> hay nuevos archivos cargados
                $cantidad_archivos = count($_FILES["archivos"]["name"]);
            }else{                              // NO existe la key "archivos" en la variable $_FILES
                $cantidad_archivos = 0;
            }

            if($cantidad_archivos>0){   //  HAY archivos nuevos cargados
                /*  TRY - Si el/los archivos precargados cumplen con las condiciones, pasa al bloque de GUARDADO*/
                /*  CATCH - De lo contrario, captura el mensaje de error y lo envía al AJAX*/
                    try {
                        /*  Dentro de la funcion validate() se definen condiciones de validación y los correspondientes
                            mensajes de error según corresponda a la condición que no se cumpla */
                            $request->validate( [   //  impone condiciones a cada elemento del array archivos
                                                    'archivos'=> 'required|array|min:1',
                                                    'archivos.*'=> 'required|image|max:2048'
                                                ],
                                                [   //  define el mensaje de error a mostrar
                                                    'archivos.required'=> 'Es necesario cargar un archivo',
                                                    'archivos.*.max'=> 'El tamaño del/algún archivo es muy grande'
                                                ]
                                            );
                            
                    } catch (\Illuminate\Validation\ValidationException $th) {
                            //var_dump($th->validator->errors());exit;
                        return response()->json([
                            'mensaje_error'=> $th->validator->errors()->first()
                            //  NO se define la key 'mensaje_creacion_producto. Ambas keys se definen más adelante'
                        ]);
                    }
                //\.try/catch

                        
                //  GUARDADO de archivos precargados en SERVIDOR
                    $conteo = count($_FILES["archivos"]["name"]);   //var_dump($conteo);exit; // cantidad de archivos a subir
                    for ($i = 0; $i < $conteo; $i++) {
                        //  Archivo en sí + Extension
                            $ubicacionTemporal = $_FILES["archivos"]["tmp_name"][$i];
                            $nombreArchivo = $_FILES["archivos"]["name"][$i];
                            $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                        // Renombrar archivo
                            $nuevoNombre = sprintf("%s_%d.%s", uniqid(), $i, $extension);

                        //  FORMAR vector de nombres de archivos (necesario para guardar en base de datos)
                            array_push($vector_filesnames, $nuevoNombre);
                        // Mover del temporal al directorio actual
                                //echo $nuevoNombre."<br>";
                                //echo $extension."<br>";
                                //echo filesize($_FILES["archivos"]["tmp_name"][$i])."<br>";  // tamaño en bytes del archivo
                            //move_uploaded_file($ubicacionTemporal, $nuevoNombre);

                        //  USAR INTERVENTION IMAGE O LO QUE SEA PARA AJUSTAR TAMAÑO DE IMAGENES - O HACER ESTO FUERA DE ESTE LOOP

                        //  Por cada archivo multimedia seleccionado, guarda en ubicacion destino con el nombre previamente establecido
                            $request->file('archivos')[$i]->storeAs('public/archivos_multimedia/', $nuevoNombre);   //DESCOMENTAR - NO GUARDA NADA
                    }
                

                    // ELIMINAR archivos del servidor (elimina por nombre de los archivos)
                        $argumentos=[
                            $idProducto,
                        ];
                        $rs_get_mf = MediaFile::Dame_archivos_multimedia_xidProducto($argumentos);      //var_dump($rs_get_mf);exit;

                        foreach($rs_get_mf as $row){
                            //echo $row->nombreArchivoMultimedia."<br>";
                            Storage::delete("public/archivos_multimedia/".$row->nombreArchivoMultimedia."");
                        }
    
                    // ELIMINAR archivos de base de datos (elimina por idProducto)
                        $argumentos=[
                            $idProducto,
                        ];
                        $rs_delete_mf = MediaFile::Elimina($argumentos);    //var_dump($rs_delete_mf);exit;
        
                //  GUARDA EN BASE DE DATOS LOS NUEVOS ARCHIVOS
                    //  VECTOR que contiene los data-id en el orden deseado
                        $order_vector= explode(",",$request->order_list);   //debbug($order_vector);exit;
                        $i=1;   // iniciar contador (data-id del 1er archivo)
        
                        foreach($vector_filesnames as $filename){
                            $argumentos=[
                                            intval($idProducto),
                                            $filename, 
                                            array_search($i, $order_vector)+1   //posicion del data-id en el vector ordenado = posicion a ocupar el archivo
                                        ];                                  //echo "<pre>";var_dump($argumentos);exit;
                            $rs_insert_mf = MediaFile::Alta($argumentos);   //echo "<pre>";var_dump($rs_insert_mf);exit;
                            $i++;   // data-id del archivo siguiente
                        }   //exit;


            }   //  \.if

        //  Ver contenido completo de $request (todo)
            //return $request->all();exit;
                            
        //  ACTUALIZACION EN BASE DE DATOS
            $argumentos=[
                            intval($idProducto),
                            intval($request->input_marca),
                            intval($request->input_modelo),
                            intval($request->input_categoria),
                            $request->input_nombre,
                            $request->input_es_destacado,
                            $request->input_stock,
                            $request->input_condicion
                        ];      //var_dump($argumentos);exit;
            $rs_insert_rt_id = Product::Actualiza($argumentos);  //echo "<pre>";var_dump($rs_insert_rt_id);exit;
           

        //  \.ACTUALIZACION EN BASE DE DATOS
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
                    'mensaje_creacion_producto'=> $rs_salida_sp
            ]); //  esto se retorn al ajax
    }



    
    public function eliminar_producto(Request $request){

        /*  Mirar contenido de $request (archivos seleccionados)
            return $request->file('archivos')[1];exit;*/
        
        $idProducto= intval($request->idProducto_ajax);

        //echo $request->idProducto_ajax; exit;

        // ELIMINAR archivos del servidor (elimina por nombre de los archivos)
            $argumentos=[
                            $idProducto,
            ];
            $rs_get_mf = MediaFile::Dame_archivos_multimedia_xidProducto($argumentos);      //var_dump($rs_get_mf);exit;

            foreach($rs_get_mf as $row){
                //echo $row->nombreArchivoMultimedia."<br>";
                Storage::delete("public/archivos_multimedia/".$row->nombreArchivoMultimedia."");
            }

        // ELIMINAR registros de la base de datos
            $argumentos=[
                            $idProducto,
                        ];                                  //var_dump($argumentos);exit;
            $rs_delete = Product::Elimina($argumentos);  //echo "<pre>";var_dump($rs_insert_rt_id);exit;



            $rs_salida_sp= "ok";    //  RESPUESTA TEMPORAL
            return response()->json([
                /*  Aquí sí se definen ambas keys. 
                    La key-value 'mensaje_error'="" quiere decir que NO hubo errores al cargar archivos */
                    'mensaje_error'=> "",
                    'mensaje_eliminacion_producto'=> $rs_salida_sp
            ]); //  esto se retorn al ajax
    }




    public function producto(Request $request){
        //var_dump($request['id']);exit;
        $argumentos=[
            intval($request['id'])
        ];
        $producto = Product::Dame_producto($argumentos);  //echo "<pre>";var_dump($producto);exit;
        //$producto = 123;

            //$result = json_encode($producto);
                // convert object $result to array
            //$producto = json_decode($result, true);

        return view('single_product', compact('producto'));
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
