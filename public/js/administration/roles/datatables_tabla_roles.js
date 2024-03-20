//  VARIABLES GLOBALES
    let tree;
    let treedata;

    // CREAR VARIABLES permisos_x
        let permisos_productos= [4,5,6,7];
        let permisos_categorias= [8,9,10,11];
        let permisos_usuarios= [12,13,14,15];
        //CREAR DEMÁS VECTORES DE PERMISOS
    // \.CREAR VARIABLES permisos_gestion_de_x
//  \.VARIABLES GLOBALES ======================================

$( document ).ready(function() {

    function initTree(treeData, gestion_de_x, permisos,  offset) {
        /*  treeData
            gestion_de_x -> representa el tipo de gestión (productos, categorias, usuarios, roles, marcas, etc) */
            
        /*  Declaración de variables DINAMICAMENTE
            window["tree_"+gestion_de_x] -> declara el nombre de una variable. Por ejemplo, la variable tree_productos
            es decir, que se llame como indica el string "tree_" y el contenido de la variable gestion_de_x ('productos','categorias', etc)*/
            //console.log(permisos_productos);

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

                                                            check_item_if_subitems_checked(gestion_de_x, permisos);
                                                        },

                                                        onNodeUnselected: function(event, node) {      
                                                            window["tree_"+gestion_de_x].treeview('toggleNodeChecked', [ node.id-offset, { silent: true } ]);
                                                            
                                                            check_item_if_subitems_checked(gestion_de_x, permisos);
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
                    initTree(response, 'productos', permisos_productos, 4);
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
                initTree(response, 'categorias', permisos_categorias,  8);
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



    //  CODIGO DE TREEVIEW -> LOGICA/VISTA DE PERMISOS  - Gestión USUARIOS 

        $.ajax({
            type: "POST",  
            url: "/ajaxpro_treeview_permissions",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                idPermisoPadre_ajax: 3
            },
            dataType: "json",       
            success: function(response){
                treedata= response;
                initTree(response, 'usuarios', permisos_usuarios,  12);
            } //\.success
        }); //\.$.ajax
    //  \.CODIGO DE TREEVIEW -> LOGICA/VISTA DE PERMISOS  - Gestión USUARIOS =========================================================================================






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
                                            
                                            var hidden=message();
                                        // En cada enlace, la propiedad href será explícitamente la ruta url ya que NO se pudo usar la funcion route o url
                                        return "<div class='row text-center' >\
                                                    <div class='col-md-4 d-flex justify-content-center' style='padding:5px;'>\
                                                        <input  type='hidden' \
                                                                name='id_evento_actualizar' \
                                                                value="+row.idRol+">\
                                                        <a href='#'>\
                                                            <button class='ver_editar_permisos btn btn-lg px-2'\
                                                                    data-toggle='modal' data-target='#exampleModal_actualizar' \
                                                                    title='PERMISOS' value="+row.idRol+" "+hidden+">\
                                                                <i class='fas fa-shield-alt fa-lg text-warning'></i>\
                                                            </button>\
                                                        </a>\
                                                    </div>\
                                                    \
                                                    <div class='col-md-4 d-flex justify-content-center' style='padding:5px;'>\
                                                        <input  type='hidden' \
                                                                name='id_evento_actualizar' \
                                                                value="+row.idRol+">\
                                                        <a href='/admin/roles/editar/"+row.idRol+"'>\
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
                dom:'<"container-fluid"<"row"<"col"><"col">> <"row"<"col"f><"col"p>>>rti',   //para mostrar BOTONES Y SEARCH en la misma linea. Linea origina: '<"container-fluid"<"row"<"col"B><"col"l><"col"f>>>rtip'
                /*BORRANDO LA LETRA B de la linea anterior, se borra el boton de exportar en excel, De manera que la  linea quedaba:
                    dom:'<"container-fluid"<"row"<"col"B><"col">> <"row"<"col"f><"col"p>>>rti',
                */
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


    function check_item_if_subitems_checked(gestion_de_x, permisos_gestion_de_x){
        var id; // variable definida por necesidad de defecto
        var permisos_checkeados= $('#treeview_json_'+gestion_de_x).treeview('getChecked', id);  // guarda los idPermisos de los permisos que fueron checkeados en la variable tabla
        //console.log(permisos_checkeados); // vector de objetos
        var array_ids= array_objects_permissions_to_array_ids(permisos_checkeados);       //console.log(array_ids);
        array_ids.sort();   // ordenar los permisos checkeados

        var array_permissions_gestion= permisos_gestion_de_x;  // hacer funcón ajax que recupere en un array los id´s de los permisos de gestion_de_x
        array_permissions_gestion.sort(); // ordenar los permisos pertenecientes a gestion_de_x

        if( array_ids.length==array_permissions_gestion.length && 
            array_ids.every(function(v,i)   { 
                                                return v === array_permissions_gestion[i] 
                                            } )
            )   //  compara longitud de arrays y si son iguales entre sus elementos uno a uno
        {
                $("#check_all_permisos_"+gestion_de_x).prop("checked", true);  // CHECKEAR input GESTEION DE X
        }else{
                $("#check_all_permisos_"+gestion_de_x).prop("checked", false);  // DESCHECKEAR input GESTION DE X
        }


    }



    function uncheck_all_inputs(){
        $("#check_all_permisos_productos").prop("checked", false);  // DESCHECKEAR input GESTION PRODUCTOS
            $('#treeview_json_productos').treeview('uncheckAll', { silent: true });   // inicialmente descheckean todos los nodos
        $("#check_all_permisos_categorias").prop("checked", false);  // DESCHECKEAR input GESTION CATEGORIAS
            $('#treeview_json_categorias').treeview('uncheckAll', { silent: true });   // inicialmente descheckean todos los nodos
        
        // roles
        // marcas
        $("#check_all_permisos_usuarios").prop("checked", false);  // DESCHECKEAR input GESTION usuarios
            $('#treeview_json_usuarios').treeview('uncheckAll', { silent: true });   // inicialmente descheckean todos los nodos
    }


    function array_objects_permissions_to_array_ids(objects_permissions){
        var array=[];
        objects_permissions.forEach(function(object_permissions) {
            array.push(object_permissions.id);
        });     //console.log(array);
        return array;
    }


    //  HACER CLICK SOBRE ICONO VER_EDITAR_PERMISOS EN DATATABLE
        $('#example1 tbody').on( 'click', 'button.ver_editar_permisos', function () {

            uncheck_all_inputs();   //  descheckea todos los inputs

            var idRol = $(this).val();      //  recupera el valor de la propiedad value de <button class="ver_editar_permisos"> -> idRol del rol donde se hizo click
                                            //  console.log("rol: "+idRol);
            //  Rescatar idRol del ROL seleccionado
                var input_idRol= document.getElementById("input_idRol");
                input_idRol.value= idRol;
                
            //var vector_permisos= new Array();


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
                            console.log(response['permisos'].length);
                        //  CHECKEA inputs correspondientes (señala permisos del rol)
                        $.each(response['permisos'], function (key, value) {
                            //console.log(value.idPermiso);
                            //vector_permisos.push( (value.idPermiso-1) );    // hay que restar 1 porque la funcion toggleNodeChecked se rige por posicion desde 0

                            /*  Por cada permiso que se encuentra al recorrer el resultSet se llama la siguiente función. 
                                NO se puedo implementar un vector [0,1,2] para llamar la función una sola vez directamente*/
                                switch(true){
                                    case (4<=value.idPermiso <=7):
                                        $('#treeview_json_productos').treeview('toggleNodeChecked', [ value.idPermiso-4, { silent: true } ]);
                                        //break;
                                    case (8<=value.idPermiso <=11):
                                        $('#treeview_json_categorias').treeview('toggleNodeChecked', [ value.idPermiso-8, { silent: true } ]);
                                        //break;
                                    case (12<=value.idPermiso <=15):
                                        $('#treeview_json_usuarios').treeview('toggleNodeChecked', [ value.idPermiso-12, { silent: true } ]);
                                        //break;
                                    /*case (8<=value.idPermiso <=11):
                                        $('#treeview_json_usuarios').treeview('toggleNodeChecked', [ value.idPermiso-8, { silent: true } ]);
                                        break;*/
                                }
                            //$('#treeview_json_productos').treeview('toggleNodeChecked', [ value.idPermiso-1, { silent: true } ]);
                            //$('#treeview_json_categorias').treeview('toggleNodeChecked', [ value.idPermiso-1, { silent: true } ]);
                        }); // \.each

                        //  Checkear GESTION DE X si los subpermisos están checkeados
                            
                            var gestion_de_x= 'productos';
                            var permisos_prod= [4,5,6,7];
                            check_item_if_subitems_checked(gestion_de_x, permisos_prod);

                            var gestion_de_x= 'categorias';
                            var permisos_cat= [8,9,10,11];
                            check_item_if_subitems_checked(gestion_de_x, permisos_cat);
                                
                            var gestion_de_x= 'usuarios';
                            var permisos_cat= [12,13,14,15];
                            check_item_if_subitems_checked(gestion_de_x, permisos_cat);
                                
                        //  \.Checkear GESTION DE X si los subpermisos están checkeados
                    }
                    // \.success
                });
            // \.AJAX
                

        });
    //  HACER CLICK SOBRE ICONO ELIMINAR EN DATATABLE







    $('#boton_formulario_actualizar_permisos').click( function() {

        //  RECUPERA el idRol 
            var idRol= document.getElementById("input_idRol").value;        //console.log(idRol);
        
            var id; // variable genérica requerida por defecto

        //  RESCATAR vectores de permisos checkeados por sección
            var permisos_checkeados_productos= $('#treeview_json_productos').treeview('getChecked', id);  // guarda los idPermisos de los permisos que fueron checkeados en la variable tabla
                    //console.log(permisos_checkeados_productos);
                var ids_permisos_productos= array_objects_permissions_to_array_ids(permisos_checkeados_productos);

            var permisos_checkeados_categorias= $('#treeview_json_categorias').treeview('getChecked', id);  // guarda los idPermisos de los permisos que fueron checkeados en la variable tabla
                    //console.log(permisos_checkeados_categorias);
                var ids_permisos_categorias= array_objects_permissions_to_array_ids(permisos_checkeados_categorias);

            var permisos_checkeados_usuarios= $('#treeview_json_usuarios').treeview('getChecked', id);  // guarda los idPermisos de los permisos que fueron checkeados en la variable tabla
                    //console.log(permisos_checkeados_categorias);
                var ids_permisos_usuarios= array_objects_permissions_to_array_ids(permisos_checkeados_usuarios);
                    //console.log(ids_permisos_usuarios);

        //  CONCATENAR VECTORES -> array_concat
            var array_concat=  (    ids_permisos_productos.concat(ids_permisos_categorias)    
                        ).concat(ids_permisos_usuarios);     //console.log(array_concat);

        
        //  AJAX PARA ELIMINAR PERMISOS DEL ROL +  AJAX PARA CREAR NUEVAMENTE LOS PERMISOS DEL ROL
            $.ajax({
                //async: false,   //  hace que esto se ejecute si o si antes de seguir con el siguiente codigo
                type: "POST",
                url: "/actualizar_permisos_roles",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{
                        idRol_ajax: idRol, // variable obtenida de edit.blade.php
                        array_nuevos_permisos: array_concat,
                        //_token: $('input[name="_token"]').val()
                    },
                dataType: "json",
                /*  Esto se comenta porque de lo contrario NO se podrá leer los valores pasados por data que son enviados al $_POST   */
                        //processData: false,
                        //contentType: false,
                beforeSend:function (response) {                        

                },// \.beforeSend
                success: function (response) {
                    //console.log("-"+response.mensaje_error+"-");
                    if(response.mensaje_alta_permisos_rol=="ok"){
                                //console.log("CREACION DE PRODUCTO EXITOSA");
                        // success
                            iziToast.success({
                                timeout: 1000, 
                                icon: 'fas fa-check', 
                                title: 'Actualización exitosa!', 
                                //message: 'iziToast.sucess() with custom icon!'
                                progressBar:false,      // barra de progreso de cierre
                                close: false,           // boton x de cerrar
                                closeOnEscape: true,    // cerrar al apretar ESC
                                closeOnClick: true,     // cerrar al hacer click sobre alerta
                                position:'bottomRight',    /*bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter or center.*/
                                transitionIn: 'flipInX',
                                transitionOut: 'fadeOutRight',/* bounceInLeft, bounceInRight, bounceInUp, bounceInDown, fadeIn, fadeInDown, fadeInUp, fadeInLeft, fadeInRight or flipInX.*/
                                animateInside: false,
                                //onClosing: function () {window.location.replace('/admin/categorias/ver_todos');}  //  REDIRECCIONA cuando el toast se cierra
                            });
                                //  REDIRECCIONAR PÁGINA
                                    /*setTimeout( function() {
                                        window.location.replace('/admin/productos/crear');
                                    }, 2000);// Se esperará cierto tiempo antes de ejecutarse */
                    }
                    if(response.mensaje_error!=""){
                        swa2_campo_obligatorio(response.mensaje_error);
                    }

                },  // \.success
            }); 
        // \.ajax
                //console.log("GUARDAR");          
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

        //  PRESIONAR INPUT CHECK ALL permisos usuarios
            $('#check_all_permisos_usuarios').click( function() {
                if( $('#check_all_permisos_usuarios').prop('checked') ){
                    $('#treeview_json_usuarios').treeview('checkAll', { silent: true });   // inicialmente descheckean todos los nodos
                }else{
                    $('#treeview_json_usuarios').treeview('uncheckAll', { silent: true });   // inicialmente descheckean todos los nodos
                }
            });
        //  \.PRESIONAR INPUT CHECK ALL permisos usuarios

    //  \.CHECK ALL PERMISOS s/SECCION


    //  HACER CLICK SOBRE ICONO ELIMINAR EN DATATABLE
        $('#example1 tbody').on( 'click', 'button.eliminar', function () {
            var value = $(this).val();   //  recupera el valor de la propiedad value de <button class="eliminar">
            
            //  MOSTRAR CUADRO DE CONFIRMACION
                Swal.fire({
                    title: '¿Desea eliminar el registro?',
                    //text: "You won't be able to revert this!",
                    icon: 'question',
                    //iconColor: '#d9534f',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',  //  color azul
                    cancelButtonColor: '#6c757d',   //  color gris
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    customClass:{
                        icon:'fa fa-lg',
                        confirmButton:'ml-5 mr-5 font-weight-bold',
                        cancelButton:'ml-5 mr-5 font-weight-bold',
                    }
                }).then((result) => {   
                    if (result.isConfirmed) {   //  SE CONFIRMA LA ACCION
                        //  AJAX 
                            $.ajax({
                                type: "POST",
                                url: "/eliminar_rol",
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                data: {
                                    idRol_ajax: value
                                },
                                dataType: "json",
                                success: function (response) {
                                    //console.log(response['creacion_proyectos']);
                                    switch (true) {
                                        case response['mensaje_eliminacion_rol']=='ok':    //  CREACION OK
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
                                                    onClosed: function () {window.location.replace('/admin/roles/ver_todos');}  //  REDIRECCIONA cuando el toast se cierra
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
                                        case response['mensaje_eliminacion_rol']=='error':   //  FECHA INVALIDA
                                            //  ERROR message
                                                swa2_register_not_deleted();
                                            break;
                                    }   //  \.SWITCH
                                }
                                // \.success
                            });
                        // \.ajax
                    }   // \.if (result.isConfirmed)
                })
            //  \.MOSTRAR CUADRO DE CONFIRMACION
        });
    //  HACER CLICK SOBRE ICONO ELIMINAR EN DATATABLE






    
        //$('.sujeto_permisos').css('visibility', 'hidden');       
        //console.log(document.getElementsByClassName('sujeto_permisos'));


        /*window.addEventListener("load", function(event) {
            p();
        });
       
       function p(){
       alert("el div cargo");
       }*/


       function message(){
        //return 'visibility:hidden;';
        //return 'disabled';
        return '';
        
       }

       /*var Pagar = document.getElementsByClassName('sujeto_permisos');
            Pagar.disabled = true;*/

}); //\.$( document ).ready(function() {


/*document.addEventListener('DOMContentLoaded', () => {
    function hola () {
      console.log(1);
    }
    hola();
  })*/

