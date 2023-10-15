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



    
    public function subir_archivos_productos(Request $request){

        /*  Mirar contenido de $request (archivos seleccionados)
            return $request->file('archivos')[1];exit;
        */

        try {
            $request->validate([    //  impone condiciones a cada elemento del array archivos
                'archivos'=> 'required|array|min:1',
                'archivos.*'=> 'required|image|max:2048'
            ]);
        } catch (\Illuminate\Validation\ValidationException $th) {
            //var_dump($th->validator->errors());exit;
            
            //return $th->validator->errors()->first();
            //echo  $th->validator->errors()->first();
            //return $th->validator->errors();

            return response()->json([
                'mensaje'=> $th->validator->errors()->first()
            ]);
        }
    
        /*  Ver contenido completo de $request (todo)
            return $request->all();
        */

        //echo "fin";exit;

        $conteo = count($_FILES["archivos"]["name"]);   //var_dump($conteo);exit; // cantidad de archivos a subir
        for ($i = 0; $i < $conteo; $i++) {
            //  Archivo en sí + Extension
                $ubicacionTemporal = $_FILES["archivos"]["tmp_name"][$i];
                $nombreArchivo = $_FILES["archivos"]["name"][$i];
                $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
            // Renombrar archivo
                $nuevoNombre = sprintf("%s_%d.%s", uniqid(), $i, $extension);
            // Mover del temporal al directorio actual
                    //echo $nuevoNombre."<br>";
                    //echo $extension."<br>";
                    //echo filesize($_FILES["archivos"]["tmp_name"][$i])."<br>";  // tamaño en bytes del archivo
                //move_uploaded_file($ubicacionTemporal, $nuevoNombre);
            //  Por cada archivo multimedia seleccionado, guarda en ubicacion destino con el nombre previamente establecido
                $request->file('archivos')[$i]->storeAs('public/archivos_multimedia/', $nuevoNombre);
        }
        // Responder al cliente
            //echo json_encode(true);
        
        //MENSAJES DE ERROR AL CARGAR UN ARCHIVO + TRADUCIR MENSAJES DE ERROR
        
        exit;
                
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


    /*public function subir_archivos_productos(){
        echo "adsf";exit;
        $conteo = count($_FILES["archivos"]["name"]);
        for ($i = 0; $i < $conteo; $i++) {
            $ubicacionTemporal = $_FILES["archivos"]["tmp_name"][$i];
            $nombreArchivo = $_FILES["archivos"]["name"][$i];
            $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
            // Renombrar archivo
                $nuevoNombre = sprintf("%s_%d.%s", uniqid(), $i, $extension);
            // Mover del temporal al directorio actual
                //move_uploaded_file($ubicacionTemporal, $nuevoNombre);
        }
        // Responder al cliente
        echo json_encode(true);
    }*/





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
