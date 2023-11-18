<?php

?>

@include ('administration/templates/header')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Archivos Multimedia</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listado de todos los archivos multimedia</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-hover table-responsive">
                        <thead class="bg-primary">
                            <tr>
                            <th style='width:5%;'>ID</th>
                            <th style='width:5%;'>idMarca</th>
                            <th style='width:10%;'>NOMBRE</th>
                            <th>IMAGENES <i class="fas fa-photo-video"></i></th>
                            <th>ESTADO</th>
                            <th style='width:10%;'>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot class="bg-secondary">
                            <tr>
                            <th style='width:5%;'>ID</th>
                            <th style='width:5%;'>idMarca</th>
                            <th style='width:10%;'>NOMBRE</th>
                            <th>IMAGENES</th>
                            <th style='width:5%;'>ESTADO</th>
                            <th style='width:10%;'>ACCIONES</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listado de todos los archivos multimedia</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                    <!-- VISTA PREVIA de archivos precargados -->
                        <div class="row px-5">
                            <!-- <div class="col-md-1"></div> -->
                            <div class="col-md-12">
                                <label for="exampleInputFile">Vista previa (archivos precargados)</label>
                                <div class="rounded" 
                                    id="galeria" 
                                    style="background-color:#e9ecef;">
                                    <div id="fileList" class="row" style="width:100%;">
                                        <?php
                                            foreach($archivos as $archivo ):
                                        ?>
                                                <div class="lg-image" 
                                                     style="cursor:grab;"
                                                     data-id="{{$archivo->idArchivoMultimedia}}">
                                                    <img    style="padding:5px;" 
                                                            src="../../storage/archivos_multimedia/{{$archivo->nombreArchivoMultimedia}}" 
                                                            alt="product image" 
                                                            width="100px;" height="100px;">
                                                </div>
                                        <?php
                                            endforeach;
                                        ?>
                                                    <!-- <img style="padding:5px;"  width="100" src="../../storage/archivos_multimedia/65445e2d33867_2.jpg"> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- \.VISTA PREVIA de archivos precargados -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@include ('administration/templates/footer')


<!-- Archivos propios de la vista -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

	<script src="../../js/administration/datatables_tabla_productos.js"></script>


<!-- jsDelivr :: Sortable :: Latest (https://www.jsdelivr.com/package/npm/sortablejs) -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

    <script>
        new Sortable(fileList, {
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
    </script>
<!-- \.jsDelivr :: Sortable :: Latest (https://www.jsdelivr.com/package/npm/sortablejs) -->

<script>
  
</script>