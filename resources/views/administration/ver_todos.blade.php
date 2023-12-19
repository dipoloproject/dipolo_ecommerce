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
                <h3 class="card-title">Listado de todos los productos</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover table-responsive">
                  <thead class="bg-primary">
                    <tr>
                      <th style='width:5%;'>ID</th>
                      <th style='width:5%;'>Marca</th>
                      <th style='width:5%;'>Modelo</th>
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
                      <th style='width:5%;'>Marca</th>
                      <th style='width:5%;'>Modelo</th>
                      <th style='width:10%;'>NOMBRE</th>
                      <th>IMAGENES <i class="fas fa-photo-video"></i></th>
                      <th style='width:5%;'>ESTADO</th>
                      <th style='width:10%;'>ACCIONES</th>
                    </tr>
                  </tfoot>
                </table>
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
