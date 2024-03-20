<?php

    
    
//echo "<pre>";var_dump($producto[0]->nombreProducto);exit;
//echo "<pre>";var_dump($producto->nombreProducto);exit;

//  RECUPERAR VALORES DE LAS PROPIEDADES DEL OBJETO (proveniente del controlador)
    $idProducto= $producto->idProducto;
//  CREA la variable JavaScript y se le asigna el valor $idProducto (rescatado por PHP) para despues utilizarla en edit_behaviors.js
    echo "<script> var idProducto ='$idProducto'</script>";


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
        //echo  createTreeView(null, $menus, 0);exit;
        //var_dump(createTreeView(0, $menus, 0));exit;
//  \.FORMACION DE VISTA DE ARBOL EN INPUT SELECT CATEGORÍA/RUBRO
?>

@include ('administration/templates/header')

<style>
    #galeria_sortable, #galeria_edit{
        display: flex;
    }
    #galeria_sortable img, #galeria_edit img{
        width: 80px;
        height: 80px;
        border-radius: 10px;
        box-shadow: 0 0 8px rgba(0,0,0,0.2);
        opacity: 85%;
        margin: 5px;
    }

    .texto-gris-claro {
        color: rgb(233, 236, 239);
    }

    /* .grey_area_reorder::after {
        content: "";
        width: 100%;
        height: 100%;
        position: absolute;
        left: 0;
        bottom: 0;
        background-image: linear-gradient(to bottom, #6c757d, transparent 20% 80%, #6c757d);
    } */

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
                            <h3 class="card-title text-bold">Formulario de edición</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form enctype='multipart/form-data' method='POST' action="#">
                            <!-- <div class="card-body"> -->
                                <div class="form-group m-0">
                                    <input  type="hidden" 
                                            class="form-control" 
                                            name="input_hidden_idProducto" 
                                            id="input_hidden_idProducto"
                                            value="<?php echo $idProducto;?>">
                                </div>

                                <!-- INPUTS DEL FORMULARIO DE CREACION/EDICION DE PRODCUTO -->
                                    @include ('administration/products/inputs_form_create_edit_product')

                            <!-- </div> -->
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="button" 
                                        class="btn btn-primary text-bold"
                                        id="boton_editar_producto">Actualizar</button>
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
	<script src="../../../js/administration/datatables_tabla_productos.js"></script>   <!-- scrips para la página -->
    <script src="../../../js/administration/utility_functions.js"></script>            <!-- funciones de utilidad -->
    <script src="../../../js/administration/products/edit_behaviors.js"></script>    <!-- scrip propio de la vista -->

<script>
    // AL CARGAR ARCHIVOS en input de tipo file + SETEAR ATRIBUTO DATA-ID
        updateList =    function(event) {
                            var input = document.getElementById('inputArchivos');   // referencia al input de tipo file
                            var output = document.getElementById('fileList_edit');       // referencia al div que contendrá la vista previa de los archivos precargados
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
</script>



<!-- jsDelivr :: Sortable :: Latest (https://www.jsdelivr.com/package/npm/sortablejs) -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

<script>
    new Sortable(fileList_sortable, {
        //handle: '.handle',    //sólo se moverá cuando se arrastre el elemento de clase handle
        animation: 150,
        ghostClass: 'bg-primary', 
        store: {
            set: function (sortable) {
                const sorts= sortable.toArray();
                //console.log(sorts);
                /*var order= sortable.toArray();*/
                $.ajax({
                    url: '/ajax_fetch_order_media_files',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'post',
                    data: {sorts_ajax: sorts},
                    success: function(response) {
                        //console.log('order saved');
                        //console.log(response.mensaje_reordenacion_archivos);
                        if(response.mensaje_reordenacion_archivos=='ok'){
                          // success
                            iziToast.success({
                                      timeout: 1000, 
                                      icon: 'fas fa-check', 
                                      title: 'Archivos reordenados', 
                                      //message: 'iziToast.sucess() with custom icon!'
                                      progressBar:false,      // barra de progreso de cierre
                                      close: false,           // boton x de cerrar
                                      closeOnEscape: true,    // cerrar al apretar ESC
                                      closeOnClick: true,     // cerrar al hacer click sobre alerta
                                      position:'bottomRight',    /*bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter or center.*/
                                      transitionIn: 'flipInX',
                                      transitionOut: 'fadeOutRight',/* bounceInLeft, bounceInRight, bounceInUp, bounceInDown, fadeIn, fadeInDown, fadeInUp, fadeInLeft, fadeInRight or flipInX.*/
                                      animateInside: false,
                                      //onClosed: function () {window.location.replace('/admin/productos/crear');}  //  REDIRECCIONA cuando el toast se cierra
                            });
                        }
                        
                    }
                })
            }
        }
    });




    new Sortable(fileList_edit, {
            //handle: '.handle',    //sólo se moverá cuando se arrastre el elemento de clase handle
            animation: 150,
            ghostClass: 'bg-primary', 
            store: {
                set: function (sortable) {
                    const sorts= sortable.toArray();
                    console.log("editable:"+sorts);
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

<script>
    //  AL CARGAR ARCHIVOS EN INPUT FILE
        $('#inputArchivos').on('change', function(){
            var input_archivos= document.getElementById('inputArchivos');
            var div_fileList_sortable= document.getElementById('fileList_sortable');
            var div_reorder_grey= document.getElementById('galeria_sortable');

            var label_field_reorder_mediafiles= document.getElementById('label_field_reorder_mediafiles');
            
            if(input_archivos.files.length >0){     // HAY NUEVOS ARCHIVOS A CARGAR
                div_fileList_sortable.style.pointerEvents="none";     // deshabilita la opcion para reordenar archivos ya cargados
                div_reorder_grey.style.cursor="not-allowed";             // muestra cursor de 'prohibido' al hacer hover sobre div
            
                // aclara el titulo REORDENAR ARCHIVOS MULTIMEDIA
                    label_field_reorder_mediafiles.classList.remove("text-black");
                    label_field_reorder_mediafiles.classList.add("texto-gris-claro");

            } else {                                // NO HAY ARCHIVOS A CARGAR
                div_fileList_sortable.style.pointerEvents="auto";     // habilita la opcion para reordenar archivos ya cargados
                div_reorder_grey.style.cursor="default";                 // muestra cursor puntero al hacer hover sobre div
            
                // oscurece el titulo REORDENAR ARCHIVOS MULTIMEDIA
                    label_field_reorder_mediafiles.classList.remove("texto-gris-claro");
                    label_field_reorder_mediafiles.classList.add("text-black");
            }
        });


</script>