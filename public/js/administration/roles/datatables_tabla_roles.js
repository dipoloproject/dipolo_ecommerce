//  VARIABLES GLOBALES
    let tree;
    let treedata;
//  \.VARIABLES GLOBALES ======================================

$( document ).ready(function() {

    function initTree(treeData, gestion_de_x, offset) {
        /*  treeData
            gestion_de_x -> representa el tipo de gestión (productos, categorias, usuarios, roles, marcas, etc) */
            
        /*  Declaración de variables DINAMICAMENTE
            window["tree_"+gestion_de_x] -> declara el nombre de una variable. Por ejemplo, la variable tree_productos
            es decir, que se llame como indica el string "tree_" y el contenido de la variable gestion_de_x ('productos','categorias', etc)*/

        /*var*/ window["tree_"+gestion_de_x]=$('#treeview_json_'+gestion_de_x).treeview({
                                                    data: treeData,
                                                    text: "Node 1",															
                                                    //icon: "fa fa-plus-square",
                                                    multiSelect:true,
                                                    showCheckbox:true,															
                                                    //selectable: true,
                                                    state: {
                                                        checked: true,
                                                        //disabled: true,
                                                        //expanded: true,
                                                        selected: true
                                                    },							// todo el state se puede eliminar
                                                    checkedIcon: "far fa-check-circle",
                                                    uncheckedIcon: "far fa-circle",
                                                    highlightSelected:false,

                                                    /* node.id-x , x es la (cantidad de permisos con idPermisoPadre= NULL +1 )x1*/
                                                        onNodeSelected: function(event, node) {      
                                                            window["tree_"+gestion_de_x].treeview('toggleNodeChecked', [ node.id-offset, { silent: true } ]);
                                                        },

                                                        onNodeUnselected: function(event, node) {      
                                                            window["tree_"+gestion_de_x].treeview('toggleNodeChecked', [ node.id-offset, { silent: true } ]);
                                                        },

                                                }); //\.var tree=$('#treeview_json_productos').treeview

    }   //\.function initTree(treeData, gestion_de_x, offset)



    

    //  CODIGO DE TREEVIEW -> LOGICA/VISTA DE PERMISOS - Gestión PRODUCTOS

        $.ajax({
                type: "POST",  
                url: "/ajaxpro_treeview_permissions",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    idPermisoPadre_ajax: 1
                },
                dataType: "json",       
                success: function(response){
                    treedata= response;
                    initTree(response, 'productos', 4);
                } //\.success
        }); //\.$.ajax

    
        /*function initTree_productos(treeData) {
            /*var*/ 
            /*tree_productos=$('#treeview_json_productos').treeview({
                                                        data: treeData,
                                                        text: "Node 1",															
                                                        //icon: "fa fa-plus-square",
                                                        multiSelect:true,
                                                        showCheckbox:true,															
                                                        //selectable: true,
                                                        state: {
                                                            checked: true,
                                                            //disabled: true,
                                                            //expanded: true,
                                                            selected: true
                                                        },							// todo el state se puede eliminar
                                                        checkedIcon: "far fa-check-circle",
                                                        uncheckedIcon: "far fa-circle",
                                                        highlightSelected:false,

                                                        /* node.id-x , x es la (cantidad de permisos con idPermisoPadre= NULL +1 )x1*/
                                                            /*onNodeSelected: function(event, node) {      
                                                                tree_productos.treeview('toggleNodeChecked', [ node.id-4, { silent: true } ]);
                                                            },

                                                            onNodeUnselected: function(event, node) {      
                                                                tree_productos.treeview('toggleNodeChecked', [ node.id-4, { silent: true } ]);
                                                            },

                                                    }); //\.var tree=$('#treeview_json_productos').treeview

        }   //\.function initTree(treeData)
        */

    //  \.CODIGO DE TREEVIEW -> LOGICA/VISTA DE PERMISOS  - Gestión PRODUCTOS =========================================================================================


    //  CODIGO DE TREEVIEW -> LOGICA/VISTA DE PERMISOS - Gestión CATEGORIAS

        $.ajax({
            type: "POST",  
            url: "/ajaxpro_treeview_permissions",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                idPermisoPadre_ajax: 2
            },
            dataType: "json",       
            success: function(response){
                treedata= response;
                initTree(response, 'categorias', 8);
            } //\.success
        }); //\.$.ajax


        /*function initTree_categorias(treeData) {
            /*var*/ 
                /*tree_categorias=$('#treeview_json_categorias').treeview({
                                                    data: treeData,
                                                    text: "Node 1",															
                                                    //icon: "fa fa-plus-square",
                                                    multiSelect:true,
                                                    showCheckbox:true,															
                                                    //selectable: true,
                                                    state: {
                                                        checked: true,
                                                        //disabled: true,
                                                        //expanded: true,
                                                        selected: true
                                                    },							// todo el state se puede eliminar
                                                    checkedIcon: "far fa-check-circle",
                                                    uncheckedIcon: "far fa-circle",
                                                    highlightSelected:false,

                                                    /* node.id-x , x es la (cantidad de permisos con idPermisoPadre= NULL +1)x2*/
                                                        /*onNodeSelected: function(event, node) {      
                                                            tree_categorias.treeview('toggleNodeChecked', [ node.id-8, { silent: true } ]);
                                                        },

                                                        onNodeUnselected: function(event, node) {      
                                                            tree_categorias.treeview('toggleNodeChecked', [ node.id-8, { silent: true } ]);
                                                        },

                                                }); //\.var tree=$('#treeview_json_productos').treeview

        }   //\.function initTree(treeData)
        */


    //  \.CODIGO DE TREEVIEW -> LOGICA/VISTA DE PERMISOS  - Gestión CATEGORIAS =========================================================================================



    //  CODIGO DE TREEVIEW -> LOGICA/VISTA DE PERMISOS  - Gestión CATEGORIAS 
    //  \.CODIGO DE TREEVIEW -> LOGICA/VISTA DE PERMISOS  - Gestión CATEGORIAS =========================================================================================






    //  DATATABLES CONFIGURATION
        //    $(function () {
            var table =$("#example1").DataTable({       // se hace referencia al id de la tabla

                //  LLAMADA al archivo que trae los registros
                    "ajax":{
                        "type": "POST",
                        "url": "/ajax_fetch_roles",
                        "headers": {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        "dataSrc":""
                    },
                //  \.LLAMADA al archivo que trae los registros       
                
                //  CONFECCION de campos a mostrar
                    "columns":[

                        /*
                            PROPIEDAD: responsivePriority
                                Asignar "responsivePriority": 1, a una columna es hacer que sea la última en colapsarse
                                Asignar "responsivePriority": 10000, es la prioridad por defecto 
                                Asignar "responsivePriority": 10001, a una columna es hacer que se colapse antes que cualquier otra
                        */

                        //  columna que se oculta pero se la define para rescatar idProducto
                        {   "data": "idRol",
                            //"visible": false,   // quita la visibilidad de la columna
                            "className":"align-middle",
                            "render":   function (data, type, row) {    
                                            return '<div>'+decodeURIComponent(escape(row.idRol))+'</div>';
                                        }
                        },

                        {   "data": "nombreRol",
                            "className":"align-middle",
                            "render":   function (data, type, row) {    
                                            return decodeURIComponent(escape(row.nombreRol));
                                        }
                        },
                        
                        {   "data": "observacionesRol", 
                            "className":"align-middle",
                            "render":   function (data, type, row) {    
                                        return '<div style="width:300px;">'+row.observacionesRol+'</div>';
                                    }
                        },

                        {   "data": "estadoRol", 
                            "responsivePriority": 10,
                            "className":"text-center align-middle",
                            "render":   function (data, type, row) {
                                        var html_out='';
                                        if(row.estadoRol=="A"){
                                            html_out+='<span class="badge bg-success">ACTIVO</span>';
                                        }else{
                                            html_out+='<span class="badge bg-danger">INACTIVO</span>';
                                        }
                                        return html_out;
                                    }
                        },
                            
                        {"data": null,
                        "responsivePriority": 1,
                        "render":   function (data, type, row) {
                                        // En cada enlace, la propiedad href será explícitamente la ruta url ya que NO se pudo usar la funcion route o url
                                        return "<div class='row text-center' >\
                                                    <div class='col-md-4 d-flex justify-content-center' style='padding:5px;'>\
                                                        <input  type='hidden' \
                                                                name='id_evento_actualizar' \
                                                                value="+row.idRol+">\
                                                        <a href='#'>\
                                                            <button class='ver_editar_permisos btn btn-lg px-2'\
                                                                    data-toggle='modal' data-target='#exampleModal_actualizar' \
                                                                    title='PERMISOS' value="+row.idRol+">\
                                                                <i class='fas fa-shield-alt fa-lg text-warning'></i>\
                                                            </button>\
                                                        </a>\
                                                    </div>\
                                                    \
                                                    <div class='col-md-4 d-flex justify-content-center' style='padding:5px;'>\
                                                        <input  type='hidden' \
                                                                name='id_evento_actualizar' \
                                                                value="+row.idRol+">\
                                                        <a href='/admin/productos/editar/"+row.idRol+"'>\
                                                            <button class='editar btn btn-lg px-2'\
                                                                    data-toggle='tooltip' data-placement='top' \
                                                                    title='ACTUALIZAR'>\
                                                                <i class='fas fa-edit fa-lg text-info'></i>\
                                                            </button>\
                                                        </a>\
                                                    </div>\
                                                    \
                                                    <div class='col-md-4 d-flex justify-content-center' style='padding:5px;'>\
                                                        <input  type='hidden' \
                                                                name='id_evento_eliminar' \
                                                                value="+row.idRol+">\
                                                        <button type='button' class='eliminar btn btn-lg px-2' \
                                                                data-toggle='tooltip' data-placement='top'\
                                                                title='ELIMINAR' value="+row.idRol+">\
                                                            <i class='fas fa-trash-alt fa-lg text-danger'></i>\
                                                        </button>\
                                                    </div>\
                                                </div>";
                                    }
                        },
                        
                    ],
                //  \.CONFECCION de campos a mostrar

                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Registros",
                    "infoFiltered": "(Filtrado de _MAX_ total de registros)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },

                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],


                dom: 'Bfrtip',
                //dom:'<"container-fluid"<"row"<"col"B><"col"f>>>rtip',   //para mostrar BOTONES Y SEARCH en la misma linea. Linea origina: '<"container-fluid"<"row"<"col"B><"col"l><"col"f>>>rtip'
                dom:'<"container-fluid"<"row"<"col"B><"col">> <"row"<"col"f><"col"p>>>rti',   //para mostrar BOTONES Y SEARCH en la misma linea. Linea origina: '<"container-fluid"<"row"<"col"B><"col"l><"col"f>>>rtip'
                buttons:[ 
                    {
                        extend:    'excelHtml5',
                        text:      '<i class="fas fa-file-excel"></i> ',

                        // action -> propiedad que permite usar un modal con spinner de loading mientras se exporta el archivo excel
                            /*action: function(e, dt, node, config) {
                                var that = this;
                                Swal.fire({
                                    title: 'Por favor, aguarde unos instantes',
                                    html: 'Estamos procesando su archivo',
                                    //timer: 2000,
                                    //timerProgressBar: true,
                                    didOpen: () => {
                                    Swal.showLoading()
                                    //const b = Swal.getHtmlContainer().querySelector('b')
                                    /*timerInterval = setInterval(() => {
                                        b.textContent = Swal.getTimerLeft()
                                    }, 100)*/
                                    /*},
                                });

                                setTimeout(function() { 
                                $.fn.DataTable.ext.buttons.excelHtml5.action.call(that, e, dt, node, config);
                                Swal.close();
                                }, 1000);
                            },*/

                        className: 'btn btn-md btn-success btn-track1',
                        titleAttr: 'Exportar a Excel',
                        className: 'btn btn-success',
                        //title: titulo_archivo_exportado, //  titulo del archivo exportado
                        
                        /*  NO se usa 
                        message: datos_establecimiento,  //  datos basicos del establecimiento (dentro del archivo)
                            customize: function ( xlsx ) {   //  ESTILOS A LA 1RA CELDA
                                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                $('c[r=A1] t', sheet).text( 'Custom Heading in First Row' );
                                $('row:first c', sheet).attr( 's', '22' ); // first row is bold               
                            },
                        */
                        
                        
                
                        //exportOptions: { columns: columnas_a_mostrar }  //  variable de configuracion               
                    },

                    /*  NO se habilitará el boton para exportar PDF
                    {
                        extend:    'pdfHtml5',
                        text:      '<i class="fas fa-file-pdf"></i> ',
                        titleAttr: 'Exportar a PDF',
                        className: 'btn btn-danger',
                        title: titulo_archivo_exportado, //  titulo del archivo exportado
                        //message: datos_establecimiento,  //  datos basicos del establecimiento (dentro del archivo)
                        exportOptions: { columns: columnas_a_mostrar }  //  variable de configuracion
                    },*/
                    
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            // Add event listener for opening and closing details
                table.on('click', 'td.dt-control', function (e) {
                    let tr = e.target.closest('tr');
                    let row = table.row(tr);
                
                    if (row.child.isShown()) {
                        // This row is already open - close it
                        row.child.hide();
                    }
                    else {
                        // Open this row
                        row.child(format(row.data())).show();
                    }
                });


            //  Estilos CSS para el input BUSCAR/SEARCH
                    //$('#example_filter').addClass("col-md-12");
                    $('#example1_filter').css({'width':'100%','padding-top':'20px'});
                    $('#example1_filter label').css({'width':'100%','display':'inline-block', 'padding':'0px', 'justify-content': 'start'}); // ubicar campo SEARCH a la izquierda
                //  Estilos CSS para la PAGINATION
                    $('#example1_paginate').css({'width':'100%','display':'inline-block', 'padding':'10px'});
                //  Estilos CSS para la INFORMATION
                    //$('#example1_info').css({'width':'100%','display':'inline-block', 'padding':'15px'});
            //  \.Estilos CSS para el input BUSCAR/SEARCH


            /*$('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            });*/

        //});   //  \. $(function () {})
    
    //  \.DATATABLES CONFIGURATION =============================================================================================





    function array_objects_permissions_to_array_ids(objects_permissions){
        var array=[];
        objects_permissions.forEach(function(object_permissions) {
            array.push(object_permissions.id);
        });     //console.log(array);
        return array;
    }


    //  HACER CLICK SOBRE ICONO VER_EDITAR_PERMISOS EN DATATABLE
        $('#example1 tbody').on( 'click', 'button.ver_editar_permisos', function () {

            $("#check_all_permisos_productos").prop("checked", false);  // DESCHECKEAR input GESTION PRODUCTOS
                $('#treeview_json_productos').treeview('uncheckAll', { silent: true });   // inicialmente descheckean todos los nodos
            $("#check_all_permisos_categorias").prop("checked", false);  // DESCHECKEAR input GESTION CATEGORIAS
                $('#treeview_json_categorias').treeview('uncheckAll', { silent: true });   // inicialmente descheckean todos los nodos

            var idRol = $(this).val();   //  recupera el valor de la propiedad value de <button class="ver_editar_permisos"> -> idRol del rol donde se hizo click
                //console.log("rol: "+idRol);
            var vector_permisos= new Array();


            //  AJAX 
                $.ajax({
                    type: "POST",
                    url: "/ajax_fetch_permisos_xidRol",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        idRol_ajax: idRol
                    },
                    dataType: "json",
                    success: function (response) {
                        //console.log(response['permisos']);

                        $.each(response['permisos'], function (key, value) {
                            //console.log(value.idPermiso);
                            //vector_permisos.push( (value.idPermiso-1) );    // hay que restar 1 porque la funcion toggleNodeChecked se rige por posicion desde 0

                            /*  Por cada permiso que se encuentra al recorrer el resultSet se llama la siguiente función. 
                                NO se puedo implementar un vector [0,1,2] para llamar la función una sola vez directamente*/
                                switch(true){
                                    case (value.idPermiso <=4):
                                        $('#treeview_json_productos').treeview('toggleNodeChecked', [ value.idPermiso-1, { silent: true } ]);
                                        break;
                                    case (5<=value.idPermiso <=8):
                                        $('#treeview_json_categorias').treeview('toggleNodeChecked', [ value.idPermiso-5, { silent: true } ]);
                                        break;
                                    /*case (8<=value.idPermiso <=11):
                                        $('#treeview_json_usuarios').treeview('toggleNodeChecked', [ value.idPermiso-8, { silent: true } ]);
                                        break;*/
                                }
                            //$('#treeview_json_productos').treeview('toggleNodeChecked', [ value.idPermiso-1, { silent: true } ]);
                            //$('#treeview_json_categorias').treeview('toggleNodeChecked', [ value.idPermiso-1, { silent: true } ]);
                        }); // \.each

                        //  CONTROLES

                            //  HACERLO GENÉRICO
                            var id; // variable definida por necesidad de defecto


                            var permisos_checkeados_productos= $('#treeview_json_productos').treeview('getChecked', id);  // guarda los idPermisos de los permisos que fueron checkeados en la variable tabla
                                //console.log(permisos_checkeados_productos); // vector de objetos
                                var array_ids= array_objects_permissions_to_array_ids(permisos_checkeados_productos);       //console.log(array_ids);
                                array_ids.sort();   // ordenar los permisos checkeados

                                var array_permissions_gestion_productos=[4,5,6,7];  // hacer funcón ajax que recupere en un array los id´s de los permisos de gestion_de_x
                                array_permissions_gestion_productos.sort(); // ordenar los permisos pertenecientes a gestion_de_x

                                if( array_ids.length==array_permissions_gestion_productos.length && 
                                    array_ids.every(function(v,i)   { 
                                                                        return v === array_permissions_gestion_productos[i] 
                                                                    } )
                                    )   //  compara longitud de arrays y si son iguales entre sus elementos uno a uno
                                {
                                        $("#check_all_permisos_productos").prop("checked", true);  // CHECKEAR input GESTEION DE X
                                }else{
                                        $("#check_all_permisos_productos").prop("checked", false);  // DESCHECKEAR input GESTION DE X
                                }

                                
                                
                        //  \.CONTROLES
                    }
                    // \.success
                });
            // \.AJAX
                

        });
    //  HACER CLICK SOBRE ICONO ELIMINAR EN DATATABLE



    $('#boton_formulario_actualizar_permisos').click( function() {

        var id; // variable genérica requerida por defecto

        var permisos_checkeados_productos= $('#treeview_json_productos').treeview('getChecked', id);  // guarda los idPermisos de los permisos que fueron checkeados en la variable tabla
            console.log(permisos_checkeados_productos);

        var permisos_checkeados_categorias= $('#treeview_json_categorias').treeview('getChecked', id);  // guarda los idPermisos de los permisos que fueron checkeados en la variable tabla
            console.log(permisos_checkeados_categorias);

        console.log("GUARDAR");
        
            
        $('#exampleModal_actualizar').modal('hide');    // cerrar MODAL de permisos
    });


    //  CHECK ALL PERMISOS s/SECCION
        //  PRESIONAR INPUT CHECK ALL permisos productos
            $('#check_all_permisos_productos').click( function() {
                if( $('#check_all_permisos_productos').prop('checked') ){
                    $('#treeview_json_productos').treeview('checkAll', { silent: true });   // inicialmente descheckean todos los nodos
                }else{
                    $('#treeview_json_productos').treeview('uncheckAll', { silent: true });   // inicialmente descheckean todos los nodos
                }
            });
        //  \.PRESIONAR INPUT CHECK ALL permisos productos

        //  PRESIONAR INPUT CHECK ALL permisos categorias
            $('#check_all_permisos_categorias').click( function() {
                if( $('#check_all_permisos_categorias').prop('checked') ){
                    $('#treeview_json_categorias').treeview('checkAll', { silent: true });   // inicialmente descheckean todos los nodos
                }else{
                    $('#treeview_json_categorias').treeview('uncheckAll', { silent: true });   // inicialmente descheckean todos los nodos
                }
            });
        //  \.PRESIONAR INPUT CHECK ALL permisos categorias

    //  \.CHECK ALL PERMISOS s/SECCION




}); //\.$( document ).ready(function() {
