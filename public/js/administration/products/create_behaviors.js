$(document).ready(function() {

    //  ELEGIR MARCA -> FORMAR INPUTS SELECT DE MODELOS
        $('#input_marca').change( function() {
            //  Referenciar valor
                var idMarca= document.getElementById("input_marca").value;
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
                    },// \.success
                });// \.ajax
        }); //\.$('#input_marcas').change 
    //\.ELEGIR MARCA -> FORMAR INPUTS SELECT DE MODELOS


    
    
    // Al presionar el boton de cierre del modal de seccion multiple
    /*$('#boton_cierre_modal_seccion_multiple').click( function() {
        //  RESETEAR campo TIPO DE SECCION a -
            document.getElementById("input_actualizar_tiposeccion").value="";
        //  DESCHEQUEAR TODOS LOS CHECKBOX de type radio
            inicializar_checkbox();
    });*/
    // \.Al presionar el boton de cierre del modal de seccion multiple


    //  CADA VEZ QUE SE MODIFICA UN CHECKBOX. ADEMÁS, SOLO UN SOLO CHECKBOX PUEDE ESTAR SELECCIONADO O NINGUNO
    /*$('input.chk').on('change', function(ev) {
        ev.preventDefault()
        // a que cambia?
        //console.log(ev.target.checked, $(this).prop('checked'))
        if ($(this).prop('checked')) {
            $('input.chk').not($(this)).prop('checked', false); //  deschequear todos los demás excepto el recien seleccionado
            $('input.chk').not($(this)).val('');                //  setear value en '' de los recien deschequeados
                //console.log($(this).attr('data-id'));
            $(this).val($(this).attr('data-id'));               //  setear value= data-id del recien seleccionado
                //console.log($(this).val);
        }else{
            $(this).val('');    //  los que no fueron seleccionados recien, se les setea el value en ''
        }
        // cuantos quedan?
                //console.log($('input.chk:checked').length)

        /*if (1 > $('input.chk:checked').length) {
            //$(this).prop('checked', true)
        }*/
        /*return false;
    });*/
    //  \.CADA VEZ QUE SE MODIFICA UN CHECKBOX. ADEMÁS, SOLO UN SOLO CHECKBOX PUEDE ESTAR SELECCIONADO O NINGUNO

});    //\.$(document).ready(function() {