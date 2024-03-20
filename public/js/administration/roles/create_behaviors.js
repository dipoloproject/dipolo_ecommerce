$(document).ready(function() {   
    
    //  REFERENCIAR EL BOTON CREAR producto
        const   $btnCrearRol= document.querySelector("#boton_crear_rol");

        const   $inputArchivos= document.querySelector("#inputArchivos");

                $btnCrearRol.addEventListener("click", async () => {

                    // Definición de la estructura que contendrá los datos -> formdata
                        const formData = new FormData();

                    //  INPUTS 
                        //  Recorre el formulario y rescata los inputs por su name y el valor que se ingresó
                            var nameinputs_values = $('form').serializeArray(); // vector contenedor de elementos de tipo name_input->input_value


                        //  Inserta cada elemento del vector contenedor dentro de la estructura formData -> para enviar al ajax una sola estructura/dato
                            $.each(nameinputs_values,function(key,input){
                                formData.append(input.name,input.value);
                            });
                    //  \.INPUTS 

                    //  AJAX
                        $.ajax({
                            //async: false,   //  hace que esto se ejecute si o si antes de seguir con el siguiente codigo
                            type: "POST",
                            url: "/subir_rol",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data:
                                    formData,
                                    //_token: $('input[name="_token"]').val()
                                
                            dataType: "json",
                            processData: false,
                            contentType: false,
                            beforeSend:function (response) {                        

                            },// \.beforeSend
                            success: function (response) {
                                //console.log("-"+response.mensaje_error+"-");

                                if(response.mensaje_creacion_rol != ""){
                                    if(response.mensaje_creacion_rol=="ok"){
                                                //console.log("CREACION DE PRODUCTO EXITOSA");
                                        // success
                                            iziToast.success({
                                                timeout: 1000, 
                                                icon: 'fas fa-check', 
                                                title: 'Creación exitosa!', 
                                                //message: 'iziToast.sucess() with custom icon!'
                                                progressBar:false,      // barra de progreso de cierre
                                                close: false,           // boton x de cerrar
                                                closeOnEscape: true,    // cerrar al apretar ESC
                                                closeOnClick: true,     // cerrar al hacer click sobre alerta
                                                position:'bottomRight',    /*bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter or center.*/
                                                transitionIn: 'flipInX',
                                                transitionOut: 'fadeOutRight',/* bounceInLeft, bounceInRight, bounceInUp, bounceInDown, fadeIn, fadeInDown, fadeInUp, fadeInLeft, fadeInRight or flipInX.*/
                                                animateInside: false,
                                                onClosing: function () {window.location.replace('/admin/roles/ver_todos');}  //  REDIRECCIONA cuando el toast se cierra
                                            });
                                                //  REDIRECCIONAR PÁGINA
                                                    /*setTimeout( function() {
                                                        window.location.replace('/admin/productos/crear');
                                                    }, 2000);// Se esperará cierto tiempo antes de ejecutarse */
                                    }else{
                                        swa2_campo_obligatorio(response.mensaje_creacion_rol);
                                    }
                                }                                
                            },// \.success
                        });
                    // \.ajax
                });




            /*$("form").submit(function(event){
                event.preventDefault();
                alert("Submitted");

              });*/
    
    // Al presionar el boton de cierre del modal de seccion multiple
    //$('#boton_crear_producto').click( function() {
        /*
        console.log("presionado");
        //  DEFINICION del OBJETO que almacenará los campos del modal 
            var campos = {};

        //  Se RECORRERÁ los divs de clase formulario para construir el vector campos con los datos que figuran en él
            $('.formulario').find('input, select').each(function() {
                campos[this.name]= this.value;
            })  //console.log(campos);
            //console.log(campos);
        */

        //  AJAX + enviar OBJETO campo como un STRING
            /*$.ajax({
                type: "POST",
                url: "ajax_crear_actualizar_seccion.php",//
                //headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {'campos_ajax': JSON.stringify(campos)},
                dataType: "json",
                success: function (response) {
                    //console.log(response['creacion_eventos']);
                    switch (true) {
                        case response['creacion_seccion']:    //  CREACION OK
                            //  SUCCESS message
                                swa2_success_up_right('Se ha creado un nuevo registro');
                            //Redirigir a la vista welcome luego de cierto tiempo
                                setTimeout( function() {
                                    window.location.replace('cargamatini.php');    //luego de esta sentencia, NO se puede volver a la pantalla de login con ATRAS
                                }, 100);// Se esperará cierto tiempo antes de ejecutarse
                            break;
                        
                        
                        case response['actualizacion_seccion']:   //  ACTUALIZACION OK
                            //  SUCCESS message
                                swa2_success_up_right('Se ha actualizado un registro');
                            //Redirigir a la vista welcome luego de cierto tiempo
                                setTimeout( function() {
                                    window.location.replace('cargamatini.php');    //luego de esta sentencia, NO se puede volver a la pantalla de login con ATRAS
                                }, 100);// Se esperará cierto tiempo antes de ejecutarse
                        
                    }   //  \.SWITCH            
                }   // \.success
            }); // \.ajax
            */
    //});
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