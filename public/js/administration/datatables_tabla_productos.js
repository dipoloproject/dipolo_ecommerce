$( document ).ready(function() {
    console.log( "ready!" );

    $(function () {
        $("#example1").DataTable({
			"responsive": true, "lengthChange": false, "autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],




          	dom: 'Bfrtip',
            dom:'<"container-fluid"<"row"<"col"B><"col"f>>>rtip',   //para mostrar BOTONES Y SEARCH en la misma linea. Linea origina: '<"container-fluid"<"row"<"col"B><"col"l><"col"f>>>rtip'
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

        /*$('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });*/
      });
});


