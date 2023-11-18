//  FUNCIONES DE UTILIDAD

    function delete_options_by_select_id(id_elemento_html){
        var input_select= document.getElementById(id_elemento_html);
        while ( input_select.hasChildNodes() ) {
            input_select.removeChild(input_select.lastChild)
        }
    }


    function generate_model_options_xidMarca(idMarca, idModelo=null){
        //  ajax
            $.ajax({
                //async: false,   //  hace que esto se ejecute si o si antes de seguir con el siguiente codigo
                type: "POST",
                url: "/ajax_fetch_modelos",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{
                        idMarca_ajax: idMarca,
                        //_token: $('input[name="_token"]').val()
                    },
                dataType: "json",
                beforeSend: function() {
                    //  ELIMINAR OPCIONES DESACTUALIZADAS
                        delete_options_by_select_id('input_modelo');
                },
                success: function (response) {                        
                    //  FORMACION DE OPCIONES ACTUALIZADAS
                        //  Referenciar input
                            var select= $('#input_modelo');
                        //  1RA OPCION PREDETERMINADA
                            select.append(
                                    '<option class="form-control" value="" selected>-</option>'
                            );
                        //  GENERACION del RESTO DE OPCIONES
                            $.each(response['modelos'], function (key, value) {
                                select.append(
                                    '<option class="form-control"\
                                            value="'+value.idModelo+'">'+value.nombreModelo+'\
                                    </option>'
                                );
                            }); // \.each
                    //  SETEAR ATRIBUTO SELECTED
                            $('.select_input_modelo option[value='+idModelo+']').attr('selected','selected');
                },// \.success
            });
        // \.ajax
    }