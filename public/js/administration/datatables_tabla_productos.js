$( document ).ready(function() {

    //    $(function () {
        var table =$("#example1").DataTable({

            //  LLAMADA al archivo que trae los registros
                "ajax":{
                    "type": "POST",
                    "url": "/ajax_fetch_productos",
                    "headers": {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    "dataSrc":""
                },
            //  \.LLAMADA al archivo que trae los registros       
            
            //  CONFECCION de campos a mostrar
                "columns":[

                    {   "data": "idModelo",
                        "className":"align-middle",
                        "render":   function (data, type, row) {    
                                        return '<div>'+decodeURIComponent(escape(row.idProducto))+'</div>';
                                    }
                    },

                    {   "data": "nombreMarca",
                        "className":"align-middle",
                        "render":   function (data, type, row) {    
                                        return decodeURIComponent(escape(row.nombreMarca));
                                    }
                    },

                    {   "data": "nombreModelo",
                        "className":"align-middle",
                        "render":   function (data, type, row) {    
                                        return decodeURIComponent(escape(row.nombreModelo));
                                    }
                    },

                    {   "data": "nombreProducto", 
                        "className":"align-middle",
                        "render":   function (data, type, row) {    
                                    return '<div style="width:300px;">'+row.nombreProducto+'</div>';
                                }
                    },

                    {   "data": "nombreArchivosMultimedia", 
                        "className":"align-middle",
                        "render":   function (data, type, row) {
                                            var array_archivos= row.nombreArchivosMultimedia.split(';');
                                            //return array_archivos[0];
                                        //return row.nombreArchivosMultimedia;

                                        var html_out='<div class="d-flex justify-content-start">';
                                        array_archivos.forEach(function(nombre_archivo) {
                                            html_out+='<img class="category-icon mx-2" width="50" id="catImg2" src="../../storage/archivos_multimedia/'+decodeURIComponent(escape(nombre_archivo))+'">';
                                        });
                                        html_out+='</div>';

                                        return html_out;
                                    // return '<div>\
                                    //             <img class="category-icon" width="40" id="catImg2" src="https://cdn4.iconfinder.com/data/icons/man-and-woman/154/man-human-person-login-512.png">\
                                    //                 '+decodeURIComponent(escape(row.nombreArchivosMultimedia))+'</div>';
                                }
                    },

                    {   "data": "estadoProducto", 
                        "className":"align-middle",
                        "render":   function (data, type, row) {
                                    var html_out='';
                                    if(row.estadoProducto=="A"){
                                        html_out+='<span class="badge bg-success">ACTIVO</span>';
                                    }else{
                                        html_out+='<span class="badge bg-danger">INACTIVO</span>';
                                    }
                                    return html_out;
                                }
                    },
                        
                    {"data": null,
                    "render":   function (data, type, row) {
                                    // En cada enlace, la propiedad href será explícitamente la ruta url ya que NO se pudo usar la funcion route o url
                                    return "<div class='row text-center' >\
                                                <div class='col-md-6 d-flex justify-content-center' style='padding:5px;'>\
                                                    <input  type='hidden' \
                                                            name='id_evento_actualizar' \
                                                            value="+row.idProducto+">\
                                                    <a href='/admin/productos/editar/"+row.idProducto+"'>\
                                                        <button class='editar btn btn-lg'\
                                                                data-toggle='tooltip' data-placement='top' \
                                                                title='ACTUALIZAR'>\
                                                            <i class='fas fa-edit fa-lg text-info'></i>\
                                                        </button>\
                                                    </a>\
                                                </div>\
                                                \
                                                <div class='col-md-6 d-flex justify-content-center' style='padding:5px;'>\
                                                    <input  type='hidden' \
                                                            name='id_evento_eliminar' \
                                                            value="+row.idProducto+">\
                                                    <button type='button' class='eliminar btn btn-lg' \
                                                            data-toggle='tooltip' data-placement='top'\
                                                            title='ELIMINAR' value="+row.idProducto+">\
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


    //  Estilos CSS para el input BUSCAR/SEARCH
            //$('#example_filter').addClass("col-md-12");
            $('#example1_filter').css({'width':'100%','padding-top':'20px'});
            $('#example1_filter label').css({'width':'100%','display':'inline-block', 'padding':'0px', 'justify-content': 'start'}); // ubicar campo SEARCH a la izquierda
        //  Estilos CSS para la PAGINATION
            $('#example1_paginate').css({'width':'100%','display':'inline-block', 'padding':'10px'});
        //  Estilos CSS para la INFORMATION
            //$('#example1_info').css({'width':'100%','display':'inline-block', 'padding':'15px'});



        /*$('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });*/



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
                                    url: "/eliminar_producto",
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    data: {
                                        idProducto_ajax: value
                                    },
                                    dataType: "json",
                                    success: function (response) {
                                        //console.log(response['creacion_proyectos']);
                                        switch (true) {
                                            case response['mensaje_eliminacion_producto']=='ok':    //  CREACION OK
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
                                                        onClosed: function () {window.location.replace('/admin/productos/ver_todos');}  //  REDIRECCIONA cuando el toast se cierra
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
                                            case response['mensaje_eliminacion_producto']=='error':   //  FECHA INVALIDA
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

    //});   //  \. $(function () {})

}); //\.$( document ).ready(function() {
