<?php

//echo "<pre>";var_dump($categorias);exit;

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
        margin: 5px;
    }


    /*Estilos para OCULTAR flechas de inputs de type=number*/
        /* Chrome, Safari, Edge, Opera */
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

        /* Firefox */
            input[type=number] {
                -moz-appearance: textfield;
            }
    /*\.Estilos para OCULTAR flechas de inputs de type=number*/

</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Producto</h1>
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
                            <div class="row">
                                <!-- PRIMERA COLUMNA -->
                                <div class="col-md-6">
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
                                                            echo  createTreeView( null, $menus, 0); 
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nombre</label>
                                            <input  type="text" 
                                                    class="form-control" 
                                                    name="input_nombre" 
                                                    id="input_nombre" 
                                                    placeholder="Nombre del producto"
                                                    value="">
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
                                            <input  type="number" class="form-control" 
                                                    name="input_stock" id="input_stock"
                                                    step="1" min="0" oninput="validity.valid||(value='');"
                                                    value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Condición</label>
                                            <select class="form-control select2" 
                                                    name="input_condicion"
                                                    id="input_condicion"
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
                                                            <div id="fileList_create"
                                                                class="row d-flex justify-content-center" 
                                                                style="width:100%;">
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
                                </div><!-- /.col-md-6 -->
                                <!-- SEGUNDA COLUMNA -->
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Código</label>&nbsp;<span class="text-secondary">(opcional)</span>
                                            <input  type="text" 
                                                    class="form-control" 
                                                    name="input_codigo" 
                                                    id="input_codigo" 
                                                    placeholder="Código del producto"
                                                    value="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Descripción</label>&nbsp;<span class="text-secondary">(opcional)</span>
                                            <input  type="text" 
                                                    class="form-control" 
                                                    name="input_descripcion" 
                                                    id="input_descripcion" 
                                                    placeholder="Descripción del producto"
                                                    value="">
                                        </div>

                                        <!-- NO SE MOSTRARÁ SUBCATEGORÍA. esto ya se establece en el input Categoría -->
                                        <!-- <div class="form-group">
                                            <label for="exampleInputPassword1">Sub-categoría</label>&nbsp;<span class="text-secondary">(opcional)</span>
                                            <select class="form-control select2" 
                                                    name="input_subcategoria"
                                                    id="input_subcategoria"
                                                    style="width: 100%;">
                                                            <option value="" selected>-</option>
                                            </select>
                                        </div> -->
                                        
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Origen</label>&nbsp;<span class="text-secondary">(opcional)</span>
                                            <select class="form-control select2" 
                                                    name="input_origen"
                                                    id="input_origen"
                                                    style="width: 100%;">
                                                            <option value="" selected>-</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Precio tachado</label>&nbsp;<span class="text-secondary">(opcional)</span>
                                            <input  type="number" 
                                                    class="form-control" 
                                                    name="input_precio_tachado" 
                                                    id="input_precio_tachado"
                                                    placeholder="0.00"
                                                    oninput="limitDecimalPlaces(event, 2)">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Precio venta</label>&nbsp;<span class="text-secondary">(opcional)</span>
                                            <input  type="number" 
                                                    class="form-control" 
                                                    name="input_precio_venta" 
                                                    id="input_precio_venta"
                                                    placeholder="0.00"
                                                    oninput="limitDecimalPlaces(event, 2)">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Precio Lista</label>&nbsp;<span class="text-secondary">(opcional)</span>
                                            <input  type="number" 
                                                    class="form-control" 
                                                    name="input_precio_lista" 
                                                    id="input_precio_lista"
                                                    placeholder="0.00"
                                                    oninput="limitDecimalPlaces(event, 2)">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Orden</label>&nbsp;<span class="text-secondary">(opcional)</span>
                                            <input  type="number" 
                                                    class="form-control" 
                                                    name="input_orden" 
                                                    id="input_orden"
                                                    step="1" min="0" oninput="validity.valid||(value='');"
                                                    value="">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Vistas</label>&nbsp;<span class="text-secondary">(opcional)</span>
                                            <input  type="number" 
                                                    class="form-control" 
                                                    name="input_vistas" 
                                                    id="input_vistas"
                                                    step="1" min="0" oninput="validity.valid||(value='');"
                                                    value="">
                                        </div>
                                        
                                        <!-- <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                        </div> -->
                                        
                                    </div>
                                    <!-- /.card-body -->
                                </div><!-- /.col-md-6 -->
                            
                            </div>
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

    // AL CARGAR ARCHIVOS en input de tipo file + SETEAR ATRIBUTO DATA-ID
        updateList =    function(event) {
                            var input = document.getElementById('inputArchivos');   // referencia al input de tipo file
                            var output = document.getElementById('fileList_create');       // referencia al div que contendrá la vista previa de los archivos precargados
                            var children = "";                                      // elemento html que representa la/s imagen/es precargadas
                            for (var i = 0; i < input.files.length; ++i) {
                                    var urls = URL.createObjectURL(event.target.files[i]);  // se recorre los archivos precargados y se rescata su url
                                    
                                    children +='<div   class="lg-image"\
                                                        style="cursor:grab;"\
                                                        data-id="'+(i+1)+'">\
                                                    <img style="padding:5px;" src="'+urls+'">\
                                                </div>';    // se forma el elemento de vista previa con dicha url obtenida
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


<!-- jsDelivr :: Sortable :: Latest (https://www.jsdelivr.com/package/npm/sortablejs) -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

    <script>
        new Sortable(fileList_create, {
            //handle: '.handle',    //sólo se moverá cuando se arrastre el elemento de clase handle
            animation: 150,
            ghostClass: 'bg-primary', 
            store: {
                set: function (sortable) {
                    const sorts= sortable.toArray();
                    console.log("Sortable:"+sorts);
                }
            }
        });
    </script>
<!-- \.jsDelivr :: Sortable :: Latest (https://www.jsdelivr.com/package/npm/sortablejs) -->



<!-- INPUTS de precios -> sólo  muetren count cifras decimales -->
    <script>
        function limitDecimalPlaces(e, count) {
            if(e.target.value.indexOf('.') == -1){ 
                return;
            }
            if( (e.target.value.length - e.target.value.indexOf('.')) > count   ){
                e.target.value = parseFloat(e.target.value).toFixed(count);
            }
        }
    </script>
<!-- \.INPUTS de precios -> sólo  muetren count cifras decimales -->