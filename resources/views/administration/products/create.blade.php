<?php



//  FORMACION DE VISTA DE ARBOL EN INPUT SELECT CATEGORÍA/RUBRO
    function createTreeView($parent, $menu, $nivel) {
        //  Determina la cantidad de espacios vacíos a anteponer delante del nombre de cada rubro hijo
            $spaces="";
            $iteraciones=$nivel;
            while($iteraciones>0){
                $spaces.= "&nbsp;&nbsp;&nbsp;";
                $iteraciones--;
            }

        $html = "";
        if (isset($menu['parents'][$parent])) {
            $html .= "";
            foreach ($menu['parents'][$parent] as $itemId) {
                if(!isset($menu['parents'][$itemId])) {
                    $html .= "<option value='".$menu['items'][$itemId]->idRubro."'>".$spaces.$menu['items'][$itemId]->nombreRubro."</option>";
                }
                if(isset($menu['parents'][$itemId])) {
                    $html .= "<option value='".$menu['items'][$itemId]->idRubro."'>".$spaces.$menu['items'][$itemId]->nombreRubro."";
                    $html .= createTreeView( $itemId, $menu, $nivel+1);
                    $html .= "</option>";
                }
            }
            $html .= "";
        }
        return $html;
    }


        $menus = array(
            'items' => array(),
            'parents' => array()
        );
    // Builds the array lists with data from the SQL result
        foreach($categorias as $items ):
            // Create current menus item id into array
            $menus['items'][$items->idRubro] = $items;
            // Creates list of all items with children
            $menus['parents'][$items->idRubroPadre][] = $items->idRubro;
        endforeach;
    // Print all tree view menus 
        //echo  createTreeView(0, $menus, 0);exit;


?>

@include ('administration/templates/header')

<style>
    #galeria{
        display: flex;
    }
    #galeria img{
        width: 85px;
        height: 85px;
        border-radius: 10px;
        box-shadow: 0 0 8px rgba(0,0,0,0.2);
        opacity: 85%;
    }
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Productos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                    <div class="card card-primary formulario">
                        <div class="card-header">
                            <h3 class="card-title text-bold">Formulario de creación</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form enctype='multipart/form-data' method='POST' action="#">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Marca</label>
                                    <select class="form-control select2" 
                                            name="input_marca"        
                                            id="input_marca"
                                            style="width: 100%;">
                                                    <option value="" selected>-</option>
                                        <?php   foreach($marcas as $marca):     ?>
                                                    <option value="{{$marca->idMarca}}">{{$marca->nombreMarca}}</option>    
                                        <?php   endforeach;                     ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Modelo</label>
                                    <select class="form-control select2" 
                                            name="input_modelo"
                                            id="input_modelo"
                                            style="width: 100%;">
                                                    <option value="" selected>-</option>
                                            <!-- EL RESTO DE OPCIONES SE GENERA CON JAVASCRIPT -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Categoría</label>
                                    <select class="form-control select2" 
                                            name="input_categoria"
                                            id="input_categoria"
                                            style="width: 100%;">
                                                    <option value="" selected>-</option>
                                        <?php       
                                                    echo  createTreeView( 0, $menus, 0); 
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nombre</label>
                                    <input  type="text" 
                                            class="form-control" 
                                            name="input_nombre" 
                                            id="input_nombre" 
                                            placeholder="Nombre del producto">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Es destacado</label>
                                    <select class="form-control select2" 
                                            name="input_es_destacado"
                                            id="input_es_destacado"
                                            style="width: 100%;">
                                                    <option value="" selected>-</option>
                                                    <option value="N">NO</option>
                                                    <option value="S">SI</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Stock</label>
                                    <input type="number" class="form-control" name="input_stock" id="input_stock">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Estado</label>
                                    <select class="form-control select2" 
                                            name="input_estado"
                                            id="input_estado"
                                            style="width: 100%;">
                                                    <option value="" selected>-</option>
                                                    <option value="N">Nuevo</option>
                                                    <option value="U">Usado</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Imágenes</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <!-- <input  type="file" 
                                                    class="custom-file-input" 
                                                    name="input_imagen" 
                                                    id="input_imagen"
                                                    name='files[]' multiple> -->
                                            <input  type="file" multiple 
                                                    class="custom-file-input" 
                                                    name="file"
                                                    id="inputArchivos"
                                                    accept="image/*"
                                                    onchange="javascript:updateList(event)">
                                                    <!-- al cargar archivos, se ejecuta la funcion updateList() -->
                                                    
                                            <label  class="custom-file-label" 
                                                    for="exampleInputFile">Elegir archivos</label>
                                            <!-- <output id="list"></output> -->
                                        </div>
                                        <!-- <div class="preview-area" id="preview_files" style="width: 300px;">asdfasdfasdfasfads</div> -->
                                        
                                        <!-- <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div> -->
                                    </div>
                                    <!-- NOTIFICACION-ALERTA sobre archivos precargados (para subir) -->
                                        <div class="alert alert-danger fade mb-0 py-1 mb-2" 
                                            id="input_archivos_alert"
                                            style="background-color:#f8d7da;color:#721c24;" 
                                            role="alert">&nbsp;</div>
                                    <!-- \.NOTIFICACION-ALERTA sobre archivos precargados (para subir) -->
                                    <!-- VISTA PREVIA de archivos precargados -->
                                        <div class="row px-5">
                                            <!-- <div class="col-md-1"></div> -->
                                            <div class="col-md-12">
                                                <label for="exampleInputFile">Vista previa (archivos precargados)</label>
                                                <div class="rounded" 
                                                    id="galeria" 
                                                    style="background-color:#e9ecef;">
                                                    <div id="fileList" style="width:100%;">
                                                        <h5 class="text-center m-0 py-2">No se cargaron archivos</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- \.VISTA PREVIA de archivos precargados -->
                                </div>
                                <!-- <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div> -->
                                
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="button" 
                                        class="btn btn-primary"
                                        id="boton_crear_producto">Crear</button>
                            </div>
                        </form>
                    </div>
                <!-- /.card -->

            </div>
            <!--/.col (left) -->

            <!-- right column -->
                <!-- <div class="col-md-6">
                    Para recuperar lo que habia aqui, revisar AdminLTE/pages/form/general
                </div> -->
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



@include ('administration/templates/footer')


<!-- Archivos propios de la vista -->
	<script src="../../js/administration/datatables_tabla_productos.js"></script>   <!-- scrips para la página -->
    <script src="../../js/administration/utility_functions.js"></script>            <!-- funciones de utilidad -->
    <script src="../../js/administration/products/create_behaviors.js"></script>    <!-- scrip propio de la vista -->

<script>

    // AL CARGAR ARCHIVOS en input de tipo file
        updateList =    function(event) {
                            var input = document.getElementById('inputArchivos');   // referencia al input de tipo file
                            var output = document.getElementById('fileList');       // referencia al div que contendrá la vista previa de los archivos precargados
                            var children = "";                                      // elemento html que representa la/s imagen/es precargadas
                            for (var i = 0; i < input.files.length; ++i) {
                                    var urls = URL.createObjectURL(event.target.files[i]);  // se recorre los archivos precargados y se rescata su url
                                    children += '<img style="padding:5px;" src="'+urls+'">';    // se forma el elemento de vista previa con dicha url obtenida
                            }

                            if(children==""){   //  No se cargó ningún archivo -> se muestra mensaje 
                                children += '<h5 class="text-center m-0 py-2">No se cargaron archivos</h5>';    
                            }
                            output.innerHTML = children;    /*  se introduce elementos de vista previa de archivos cargados en el div. 
                                                                O bién sólo el mensaje "No se cargaron archivos"*/
                        }
    // \.AL CARGAR ARCHIVOS en input de tipo file


    // settings
    /*iziToast.settings({
      timeout: 3000, // default timeout
      resetOnHover: true,
      // icon: '', // icon class
      transitionIn: 'flipInX',
      transitionOut: 'flipOutX',
      position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
      onOpen: function () {
        console.log('callback abriu!');
      },
      onClose: function () {
        console.log("callback fechou!");
      }
    });*/


    // success
    /*iziToast.success({
        timeout: 4000, 
        icon: 'fas fa-check', 
        title: 'Creación exitosa!', 
        //message: 'iziToast.sucess() with custom icon!'
        progressBar:false,      // barra de progreso de cierre
        close: false,           // boton x de cerrar
        closeOnEscape: true,    // cerrar al apretar ESC
        closeOnClick: true,     // cerrar al hacer click sobre alerta
        position:'bottomRight',    /*bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter or center.*/
        /*transitionIn: 'flipInX',
        transitionOut: 'fadeOutRight',/* bounceInLeft, bounceInRight, bounceInUp, bounceInDown, fadeIn, fadeInDown, fadeInUp, fadeInLeft, fadeInRight or flipInX.*/
        /*animateInside: false,
    });*/

    //window.location.href = "{{route('administracion.productos.agregar')}}";
    //iziToast.success({timeout: 5000, icon: 'fa fa-chrome', title: 'OK', message: 'iziToast.sucess() with custom icon!'});


</script>
