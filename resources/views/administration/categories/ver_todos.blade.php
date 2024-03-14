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
	
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css"> --> <!-- De este cdn se rescató los estilos para la clase badge -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" /> -->
<!--\.ESTILOS PARA TREEVIEW -->

<style>
    .treeview .list-group-item{
        cursor:pointer;   
    }
    
    .treeview span.indent{
        margin-left:10px;
        margin-right:10px
    }
    

	.list-group-item {
		position: relative;
		display: block;
		padding: 0.1rem 1.25rem;
		background-color: #fff;
		border: 1px solid rgba(0,0,0,.125);
	}





	/* estilos para el icono de colapsar/expandir nodos */
		.treeview span.icon{
			width:30px;	/*12px*/
			height:30px;	/*estilo agregado*/
			margin-right:5px
		}
		/*estilo editado*/
		.treeview span.icon::before{        
			padding:10px;	/*estilo editado para agrandar el área tactil del icono para colapsar/expandir un nodo */
		}
		

		.fa-plus-square:before {
    		color:black;
		}

		.fa-minus-square:before {
    		color:grey;
		}

		.treeview span.icon{
			margin-right:0px;
		}


	

    .treeview .node-disabled{
        color:silver;
        cursor:not-allowed
    }



	/* ESTILOS PARA BADGE */
	/* rescatado de cdn que está arriba */

		.btn-default .badge {
		color: #fff;
		background-color: #333;
		}

		.btn-primary .badge {
		color: #428bca;
		background-color: #fff;
		}

		.btn-success .badge {
		color: #5cb85c;
		background-color: #fff;
		}

		.btn-info .badge {
		color: #5bc0de;
		background-color: #fff;
		}

		.btn-warning .badge {
		color: #f0ad4e;
		background-color: #fff;
		}

		.btn-danger .badge {
		color: #d9534f;
		background-color: #fff;
		}

		.badge {
		display: inline-block;
		min-width: 10px;
		padding: 3px 7px;
		font-size: 12px;
		font-weight: bold;
		line-height: 1;
		color: #fff;
		text-align: center;
		white-space: nowrap;
		vertical-align: baseline;
		background-color: #777;
		border-radius: 10px;
		}
		.badge:empty {
		display: none;
		}
		.btn .badge {
		position: relative;
		top: -1px;
		}
		.btn-xs .badge {
		top: 0;
		padding: 1px 5px;
		}
		a.badge:hover,
		a.badge:focus {
		color: #fff;
		text-decoration: none;
		cursor: pointer;
		}
		a.list-group-item.active > .badge,
		.nav-pills > .active > a > .badge {
		color: #428bca;
		background-color: #fff;
		}
		.nav-pills > li > a > .badge {
		margin-left: 3px;
		}

		.list-group-item > .badge {
		float: right;
		}
		.list-group-item > .badge + .badge {
		margin-right: 5px;
		}

		.panel-default > .panel-heading .badge {
		color: #f5f5f5;
		background-color: #333;
		}

		.panel-primary > .panel-heading .badge {
		color: #428bca;
		background-color: #fff;
		}

		.panel-success > .panel-heading .badge {
		color: #dff0d8;
		background-color: #3c763d;
		}

		.panel-info > .panel-heading .badge {
		color: #d9edf7;
		background-color: #31708f;
		}

		.panel-warning > .panel-heading .badge {
		color: #fcf8e3;
		background-color: #8a6d3b;
		}

		.panel-danger > .panel-heading .badge {
		color: #f2dede;
		background-color: #a94442;
		}
	/*\.ESTILOS PARA BADGE */
</style>



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

            <!-- TABLA ELIMINADA TEMPORALMENTE -->
            <div class="card">
              <!-- <div class="card-header">
                <h3 class="card-title">Listado de todas las categorías</h3>
              </div> -->
			  <!-- /.card-header -->
              <!-- <div class="card-body">
                <table id="example1" class="table table-bordered table-hover table-responsive">
					<thead class="bg-primary">
						<tr> -->
							<!-- <th style='width:5%;'>ID</th>
							<th style='width:5%;'>Marca</th>
							<th style='width:5%;'>Modelo</th>
							<th style='width:5%;'>CATEGORÍA</th> -->

							<!-- <th style='width:10%;'>NOMBRE</th> -->
							
							<!--<th style='width:10%;'>DESCRIPCIÓN</th>
							<th style='width:10%;'>PRECIO TACHADO</th>
							<th style='width:10%;'>PRECIO VENTA</th>
							<th style='width:10%;'>PRECIO LISTA</th>
							<th>IMAGENES <i class="fas fa-photo-video"></i></th>
							<th>ESTADO</th>
							<th style='width:10%;'>ACCIONES</th> -->
						<!-- </tr>
					</thead>
                  	<tbody> -->

                  	<?php       
                                //echo  createTreeView( null, $menus, 0); 
                    ?>

                  	<!-- </tbody>
                  	<tfoot class="bg-secondary">
                    	<tr> -->
							<!-- <th style='width:5%;'>ID</th>
							<th style='width:5%;'>Marca</th>
							<th style='width:5%;'>Modelo</th>
							<th style='width:5%;'>CATEGORÍA</th> -->

							<!-- <th style='width:10%;'>NOMBRE</th> -->
							
							<!--<th style='width:10%;'>DESCRIPCIÓN</th>
							<th style='width:10%;'>PRECIO TACHADO</th>
							<th style='width:10%;'>PRECIO VENTA</th>
							<th style='width:10%;'>PRECIO LISTA</th>
							<th>IMAGENES <i class="fas fa-photo-video"></i></th>
							<th style='width:5%;'>ESTADO</th>
							<th style='width:10%;'>ACCIONES</th> -->
                    	<!-- </tr>
                  	</tfoot>
                </table>
              </div> -->
			  <!-- /.card-body -->
            <!-- </div> -->
			<!-- /.card -->
			<!-- TABLA ELIMINADA TEMPORALMENTE -->


            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listado de todas las categorías</h3>
              </div>
              <div class="card-body pt-1">
                <!-- <div class="container"> -->
                  <!-- <div class="panel panel-default"> -->
                    <!-- <div class="panel-heading">
                      <h1>Create Dynamic Treeview Example with PHP MySQL - ItSolutionStuff.com</h1>
                    </div> -->
                    
                    <div class="row">
                      <div class="col-md-12 d-flex justify-content-end py-2">
                        @if(show_or_hide('categorias.crear'))
                          <a 	href="{{route('administracion.categorias.agregar')}}"
                            class="btn btn-success text-bold text-center">
                                                    <i class="fas fa-plus-circle nav-icon"></i>&nbsp;Categoría
                          </a>
                        @endif
                      </div>
                    </div>


                    <div class="panel-body d-flex justify-content-center px-0">
                      <div class="col-md-12 px-0" id="treeview_json">
                      </div>
                    </div>
                  <!-- </div> -->
                <!-- </div> -->
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



<style>
  #treeview_json >ul .list-group >li .list-group-item .node-treeview_json{
    background-color: red !important;
  }
</style>


<!-- Archivos propios de la vista -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <!-- <script src="../../js/administration/datatables_tabla_productos.js"></script> -->

    <!-- ARCHIVOS PARA TREEVIEW -->
        <!-- <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.9.1.min.js"></script> -->
        <!-- <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script> -->
        <script src="../../js/administration/bootstrap-treeview.js"></script>
    <!--\.ARCHIVOS PARA TREEVIEW -->

<!--\.Archivos propios de la vista -->


<!-- SCRIPT PARA TREEVIEW -->
    <script type="text/javascript">
        let tree;
        let treedata;

        $(document).ready(function(){
                
            //let tree;
            var treeData;
        
            $.ajax({
                    type: "POST",  
                    url: "/ajaxpro",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: "json",       
                    success: function(response){
                        treedata= response;
                        initTree(response);
                    } //\.success
            }); //\.$.ajax

                
            function initTree(treeData) {
                /*var*/ tree=$('#treeview_json').treeview({
                                                        data: treeData,
                                                        collapseIcon:'fa fa-minus-square',
                                                        expandIcon:'fa fa-plus-square',                                        
                                                        emptyIcon: "",  // icono para cuando el nodo NO tenga hijos: ""= nada
                                                        //icon: true,
                                                        levels: 10,    // propiedad configurada al azar
                                                        highlightSelected: false,   // resaltar nodo seleccionado

                                                        onNodeSelected: function(event, node) {                                                  
                                                            //tree.treeview('toggleNodeExpanded', [ node.id-1, { silent: true } ]);   // expande o colapsa si el nodo está colapsado o expandido respectivamente
                                                            //tree.treeview('toggleNodeSelected', [ node.id-1, { silent: true } ]);   // deselecciona un nodo si está seleccionado y viceversa
                                                        },
                                                        
                                                        }); //\.var tree=$('#treeview_json').treeview

            }   //\.function initTree(treeData)

        }); //\.$(document).ready(function()


        // CUANDO SE PRESIONA UN BOTÓN DE EDITAR/ELIMINIAR UN NODO
            function editCategoryButtonPressed(id){
                //console.log("editar:_"+id);
              var value= id;
              window.location.replace("/admin/categorias/editar/"+id+"");
                //tree.treeview('toggleNodeExpanded', [ id-1, { silent: true } ]);    // al hacer click sobre EDITAR, el efecto es que el nodo continua colapsado o expandido
            } //\.editCategoryButtonPressed

            function deleteCategoryButtonPressed(id){
                //console.log("eliminar:_"+id);
				        var value= id;
                //tree.treeview('toggleNodeExpanded', [ id-1, { silent: true } ]);    // al hacer click sobre EDITAR, el efecto es que el nodo continua colapsado o expandido
            
                //  MOSTRAR CUADRO DE CONFIRMACION
                  Swal.fire({
                        title: '¿Desea eliminar el registro?',
                        //text: "You won't be able to revert this!",
                        icon: 'question',
                        //iconHtml: '<i class="far fa-question-circle fa-lg"></i>',
            
                        //iconColor: '#d9534f',
                        showCancelButton: true,
                        confirmButtonColor: '#dc3545',  //  color azul
                        cancelButtonColor: '#6c757d',   //  color gris
                        confirmButtonText: 'Eliminar',
                        cancelButtonText: 'Cancelar',
                        customClass:{
                            //icon:'fa-lg border-0',
                            icon:'fa-lg',
                            confirmButton:'ml-5 mr-5 font-weight-bold',
                            cancelButton:'ml-5 mr-5 font-weight-bold',
                        }
                    }).then((result) => {   
                        if (result.isConfirmed) {   //  SE CONFIRMA LA ACCION
                            //  AJAX 
                                $.ajax({
                                    type: "POST",
                                    url: "/eliminar_categoria",
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    data: {
                                        idRubro_ajax: value
                                    },
                                    dataType: "json",
                                    success: function (response) {
                                        //console.log(response['creacion_proyectos']);
                                        switch (true) {
                                            case response['mensaje_eliminacion_categoria']=='ok':    //  CREACION OK
                                                // success
                                                    iziToast.success({
                                                        timeout: 1500, 
                                                        icon: 'fas fa-check', 
                                                        title: 'Eliminación exitosa!', 
                                                        //message: 'iziToast.sucess() with custom icon!'
                                                        progressBar:false,      // barra de progreso de cierre
                                                        close: false,           // boton x de cerrar
                                                        closeOnEscape: true,    // cerrar al apretar ESC
                                                        closeOnClick: true,     // cerrar al hacer click sobre alerta
                                                        position:'bottomRight',    /*bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter or center.*/
                                                        transitionIn: 'flipInX',
                                                        transitionOut: 'fadeOutRight',/* bounceInLeft, bounceInRight, bounceInUp, bounceInDown, fadeIn, fadeInDown, fadeInUp, fadeInLeft, fadeInRight or flipInX.*/
                                                        animateInside: false,
                                                        onClosed: function () {window.location.replace('/admin/categorias/ver_todos');}  //  REDIRECCIONA cuando el toast se cierra
                                                    });
                                                /*    
                                                //  SUCCESS message - con SWEETALERT2
                                                    swa2_success_up_right('Registro eliminado con éxito');
                                                //Redirigir a la vista welcome luego de cierto tiempo
                                                    setTimeout( function() {
                                                        window.location.replace('/admin/productos/ver_todos');    //luego de esta sentencia, NO se puede volver a la pantalla de login con ATRAS
                                                    }, 2000);// Se esperará cierto tiempo antes de ejecutarse
                                                */

                                                break;
                                            //case response['mensaje_eliminacion_categoria']=='error':   //  FECHA INVALIDA
											                      default:
                                                //  ERROR message
                                                    //swa2_register_not_deleted();
													                          swa2_campo_obligatorio(response.mensaje_eliminacion_categoria);
                                                break;
                                        }   //  \.SWITCH
                                    }
                                    // \.success
                                });
                            // \.ajax
                        }   // \.if (result.isConfirmed)
                    })
                //  \.MOSTRAR CUADRO DE CONFIRMACION
			} //\.function deleteCategoryButtonPressed(id)

        //\.CUANDO SE PRESIONA UN BOTÓN DE EDITAR/ELIMINIAR UN NODO

    </script>
<!--\.SCRIPT PARA TREEVIEW -->
