<?php

/*
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

*/
        
?>






@include ('administration/templates/header')

<!-- ESTILOS PARA TREEVIEW -->
	
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css"> --> <!-- De este cdn se rescató los estilos para la clase badge -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" /> -->
<!--\.ESTILOS PARA TREEVIEW -->

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


<style>

	/*!
	* Bootstrap v4.3.1 (https://getbootstrap.com/)
	* Copyright 2011-2019 The Bootstrap Authors
	* Copyright 2011-2019 Twitter, Inc.
	* Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
	*/

	/* ESTILOS PARA EL INPUT DE TIPO CHECK CON ANIMACION */

		.checkbox-wrap {
		display: block;
		position: relative;
		padding-left: 35px;
		margin-bottom: 12px;
		cursor: pointer;
		font-size: 16px;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none; }

		.checkbox-wrap input {
		position: absolute;
		opacity: 0;
		cursor: pointer;
		height: 0;
		width: 0; }

		.checkmark {
		position: absolute;
		top: 0;
		left: 0; }

		.checkmark:after {
		content: "\f1db";
		font-family: "FontAwesome";
		position: absolute;
		color: rgba(0, 0, 0, 0.3);
		font-size: 25px;			/*estilo editado 20px*/
		margin-top: -8px;			/*estilo editado -4px */
		-webkit-transition: 0.3s;
		-o-transition: 0.3s;
		transition: 0.3s; }
		@media (prefers-reduced-motion: reduce) {
			.checkmark:after {
			-webkit-transition: none;
			-o-transition: none;
			transition: none; } }

		.checkbox-wrap input:checked ~ .checkmark:after {
		display: block;
		content: "\f058";
		font-family: "FontAwesome";
		color: #000000;							/*estilo editado #f76262 */
		-webkit-transform: rotate(-360deg);
		-ms-transform: rotate(-360deg);
		transform: rotate(-360deg); }

	/* \.ESTILOS PARA EL INPUT DE TIPO CHECK CON ANIMACION */

</style>





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
      font-size:1.5em;
			/* padding:10px;	estilo editado para agrandar el área tactil del icono para colapsar/expandir un nodo */
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
            <h1>Roles</h1>
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
              <div class="card-header">
                <h3 class="card-title">Listado de Roles</h3>
              </div>
			  <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover table-responsive">
                  <thead class="bg-primary">
                    <tr>
                      <th style='width:5%;'>ID</th>
                      <th style='width:40%;'>NOMBRE</th>
                      <th style='width:40%;'>OBSERVACIONES</th>
                      <th>ESTADO</th>
                      <th style='width:15%;'>ACCIONES</th>
                    </tr>
                  </thead>
                  	<tbody>
						<!-- FILAS QUE SE COMPLETAN MEDIANTE AJAX -->
                  	</tbody>
                  	<!-- <tfoot class="bg-secondary">
                    	<tr>
							<th style='width:5%;'>ID</th>
							<th style='width:40%;'>NOMBRE</th>
							<th style='width:40%;'>OBSERVACIONES</th>
							<th>ESTADO</th>
							<th style='width:15%;'>ACCIONES</th>
                    	</tr>
                  	</tfoot> -->
                </table>
              </div>
			  <!-- /.card-body -->


            </div>
			<!-- /.card -->
			<!-- \.TABLA ELIMINADA TEMPORALMENTE -->

            






			<!-- Modal - CREAR / ACTUALIZAR-->
				<div 	class="modal fade" id="exampleModal_actualizar" 
						tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" 
						data-keyboard="false" data-backdrop="static"
						style="padding-top:50px;">
					<div class="modal-dialog modal-xl">
						<div class="modal-content">
							<div class="modal-header">

								<h5 class="modal-title" id="modal_creacion_actualizacion_evento_agenda_titulo"></h5>
								<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button> -->
							</div>
							<div class="modal-body">
								<!-- CUERPO -->
									<div class="row">
										<!-- <form class="col-md-12" action="/establecimientos/proyectos/actualizar" method="POST" id="formulario_edicion_proyectos">   
										</form> -->
										<div class="col-md-12" id="formulario_actualizar_evento">
											
											<!-- CAMPO NECESARIO PARA ACTUALIZAR PROYECTO -->
												<!-- <input  type="hidden" 
														name="input_actualizar_id_evento" 
														id="input_actualizar_id_evento"
														value=""> -->										

												<div class="card">
													<div class="card-header">
														<h3 class="card-title text-bold">Listado de Permisos</h3>
													</div>
													<div class="card-body">
														<div class="container">
															<div class="panel panel-default">
																<div class="panel-heading">

																	<label class="checkbox-wrap">Gestión de productos
																		<input type="checkbox" id="check_all_permisos_productos">
																		<span class="checkmark"></span>
																	</label>
																	
																	
																</div>

																<div class="panel-body d-flex justify-content-center px-0">
																	<div class="col-md-12 px-0" id="treeview_json_productos"></div>
																</div>
															</div>
															<!-- div class="panel panel-default" -->
														</div>
														<!-- \.div class="container"> -->
													</div>
													<!-- div class="card-body" -->


													<div class="card-body">
														<div class="container">
															<div class="panel panel-default">
																<div class="panel-heading">

																	<label class="checkbox-wrap">Gestión de categorías
																		<input type="checkbox">
																		<span class="checkmark"></span>
																	</label>
																	
																	
																</div>

																<div class="panel-body d-flex justify-content-center px-0">
																	<div class="col-md-12 px-0" id="treeview_json_categorias"></div>
																</div>
															</div>
															<!-- div class="panel panel-default" -->
														</div>
														<!-- \.div class="container"> -->
													</div>
													<!-- div class="card-body" -->
												</div>

			
											<div class="col-md-12 text-right">
												<button type="button" 
														class="btn btn-secondary text-bold mr-5" 
														data-dismiss="modal">Cerrar
												</button>
												<button class="btn btn-success text-bold" 
														id="boton_formulario_actualizar_permisos">Guardar
												</button>
											</div>

										</div>

									</div><!-- \.row -->
								<!-- \.CUERPO -->
							</div><!-- modal-body -->
							<div class="modal-footer">
								<!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
								<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
							</div>
						</div>
					</div>
				</div>
			<!-- \.Modal - CREAR / ACTUALIZAR -->


















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

	<!-- ARCHIVOS PARA TREEVIEW -->
        <!-- <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.9.1.min.js"></script> -->
        <!-- <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script> -->
        <script src="../../js/administration/bootstrap-treeview.js"></script>
    <!--\.ARCHIVOS PARA TREEVIEW -->


    <script src="../../js/administration/roles/datatables_tabla_roles.js"></script>

    

<!--\.Archivos propios de la vista -->


