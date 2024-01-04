<?php
//  FORMACION DE VISTA DE ARBOL EN INPUT SELECT CATEGORÍA/RUBRO
    function createTreeView($parent, $menu, $nivel) {
        //  Determina la cantidad de espacios vacíos a anteponer delante del nombre de cada rubro hijo
            $spaces="";
            $iteraciones=$nivel;
            while($iteraciones>0){
                $spaces.= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                $iteraciones--;
            }

        $html = "";
        if (isset($menu['parents'][$parent])) {
            $html .= "";
            foreach ($menu['parents'][$parent] as $itemId) {
                if(!isset($menu['parents'][$itemId])) {
                    $html .= "<tr><th>".$spaces.$menu['items'][$itemId]->nombreRubro."</th></tr>";
                }
                if(isset($menu['parents'][$itemId])) {
                    $html .= "<tr><th>".$spaces.$menu['items'][$itemId]->nombreRubro."";
                    $html .= createTreeView( $itemId, $menu, $nivel+1);
                    $html .= "</th></tr>";
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

<!-- ESTILOS PARA TREEVIEW -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" />
<!--\.ESTILOS PARA TREEVIEW -->




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Categorías</h1>
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
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listado de todas las categorías</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover table-responsive">
                  <thead class="bg-primary">
                    <tr>
                      <!-- <th style='width:5%;'>ID</th>
                      <th style='width:5%;'>Marca</th>
                      <th style='width:5%;'>Modelo</th> -->
                      <!-- <th style='width:5%;'>CATEGORÍA</th> -->
                      <th style='width:10%;'>NOMBRE</th>
                      <!--<th style='width:10%;'>DESCRIPCIÓN</th>
                      <th style='width:10%;'>PRECIO TACHADO</th>
                      <th style='width:10%;'>PRECIO VENTA</th>
                      <th style='width:10%;'>PRECIO LISTA</th>
                      <th>IMAGENES <i class="fas fa-photo-video"></i></th>
                      <th>ESTADO</th> -->
                      <!-- <th style='width:10%;'>ACCIONES</th> -->
                    </tr>
                  </thead>
                  <tbody>

                  <?php       
                                echo  createTreeView( null, $menus, 0); 
                    ?>

                  </tbody>
                  <tfoot class="bg-secondary">
                    <tr>
                      <!-- <th style='width:5%;'>ID</th>
                      <th style='width:5%;'>Marca</th>
                      <th style='width:5%;'>Modelo</th> -->
                      <!-- <th style='width:5%;'>CATEGORÍA</th> -->
                      <th style='width:10%;'>NOMBRE</th>
                      <!--<th style='width:10%;'>DESCRIPCIÓN</th>
                      <th style='width:10%;'>PRECIO TACHADO</th>
                      <th style='width:10%;'>PRECIO VENTA</th>
                      <th style='width:10%;'>PRECIO LISTA</th>
                      <th>IMAGENES <i class="fas fa-photo-video"></i></th>
                      <th style='width:5%;'>ESTADO</th> -->
                      <!-- <th style='width:10%;'>ACCIONES</th> -->
                    </tr>
                  </tfoot>
                </table>




              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->



            <div class="card">
              <div class="card-body">
                <div class="container">
                  <div class="panel panel-default">
                    <!-- <div class="panel-heading">
                      <h1>Create Dynamic Treeview Example with PHP MySQL - ItSolutionStuff.com</h1>
                    </div> -->
                    <div class="panel-body d-flex justify-content-center">
                      <div class="col-md-8" id="treeview_json">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>








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

	<!-- <script src="../../js/administration/datatables_tabla_productos.js"></script> -->

  



<!-- ARCHIVOS PARA TREEVIEW -->
    <!-- <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.9.1.min.js"></script> -->
    <!-- <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script> -->

    <script src="../../js/administration/bootstrap-treeview.js"></script>
<!--\.ARCHIVOS PARA TREEVIEW -->

<!-- SCRIPT PARA TREEVIEW -->
  <script type="text/javascript">
    
    function editCategoryButtonPressed(id){
        console.log("editar:_"+id);
    }

    function deleteCategoryButtonPressed(id){
        console.log("eliminar:_"+id);
    }



    $(document).ready(function(){















      
      var treeData;
      
      $.ajax({
            type: "POST",  
            url: "/ajaxpro",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: "json",       
            success: function(response)  
            {
              initTree(response)
            }   
      });
      
      function initTree(treeData) {
        var tree=$('#treeview_json').treeview({
                                        data: treeData,
                                        selectedIcon: "",
                                        
                                        collapseIcon:'fa fa-minus',
                                        expandIcon:'fa fa-plus',
                                        
                                        emptyIcon: "",
                                        //icon: false,
                                        levels: 100,    // propiedad configurada al azar
                                        
                                        
                                        highlightSelected: false,

                                        onNodeSelected: function(event, data) {
                                          //console.log(data.id);
                                          //console.log(data.nodes);
                                          //console.log(data.nodes.length);
                                          //'toggleNodeExpanded', [ data.id, { silent: true } ]
                                          //'getExpanded', data.id

                                        }
                                        
                                    });

      }


     
      
      
    });
  </script>
<!--\.SCRIPT PARA TREEVIEW -->