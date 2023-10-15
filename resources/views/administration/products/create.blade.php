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
                                                    accept="image/*">
                                            <label  class="custom-file-label" 
                                                    for="exampleInputFile">Choose file</label>
                                            <output id="list"></output>
                                        </div>
                                        <!-- <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div> -->
                                    </div>

                                    <!-- NOTIFICACION-ALERTA sobre archivos precargados (para subir) -->
                                        <div class="alert alert-danger fade mb-0 py-1" 
                                            id="input_archivos_alert"
                                            style="background-color:#f8d7da;color:#721c24;" 
                                            role="alert">&nbsp;</div>
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

