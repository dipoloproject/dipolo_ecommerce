<?php
    
    //echo "en la vista <pre>";var_dump($rubro);exit;asdfasd

//  RECUPERAR VALORES DE LAS PROPIEDADES DEL OBJETO (proveniente del controlador)
    $idRol= $rol->idRol;
//  CREA la variable JavaScript y se le asigna el valor $idProducto (rescatado por PHP) para despues utilizarla en edit_behaviors.js
    echo "<script> var idRol ='$idRol'</script>";




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
            <h1>Rol</h1>
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
                                        name="input_hidden_idRol" 
                                        id="input_hidden_idRol"
                                        value="<?php echo $idRol;?>">
                            </div>

                            <div class="row">
                                <!-- PRIMERA COLUMNA -->
                                <div class="col-md-6">
                                    <div class="card-body">
                                        
                                        
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Nombre</label>
                                            <input  type="text" 
                                                    class="form-control" 
                                                    name="input_nombreRol" 
                                                    id="input_nombreRol" 
                                                    placeholder="Nombre de la categoría"
                                                    value="">
                                        </div>

                                        <!-- <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                        </div> -->
                                        
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Observaciones</label>&nbsp;<span class="text-secondary">(opcional)</span>
                                            <input  type="text" 
                                                    class="form-control" 
                                                    name="input_observacionesRol" 
                                                    id="input_observacionesRol" 
                                                    placeholder="Descripción de la categoría"
                                                    value="">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Estado</label>
                                            <select class="form-control select2" 
                                                    name="input_estadoRol"
                                                    id="input_estadoRol"
                                                    style="width: 100%; font-weight: bold;">
                                                            <!-- <option value="" selected>-</option> -->
                                                            <option value="A" selected>ACTIVO</option>
                                                            <option value="I">INACTIVO</option>
                                            </select>
                                        </div>
                                        <!-- <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                        </div> -->
                                        
                                    </div>
                                    <!-- /.card-body -->
                                </div><!-- /.col-md-6 -->
                                
                            </div>
                            <!-- row -->
                                    
                            <!-- </div> -->
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" 
                                        class="btn btn-primary text-bold"
                                        id="boton_editar_rol">Actualizar</button>
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
	<!--<script src="../../js/administration/datatables_tabla_productos.js"></script>   scrips para la página -->
    <script src="../../../js/administration/utility_functions.js"></script>            <!-- funciones de utilidad -->
    <script src="../../../js/administration/roles/edit_behaviors.js"></script>    <!-- scrip propio de la vista -->




