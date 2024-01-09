$(document).ready(function() {
        
    //  AL CARGAR LA PAGINA, SE RESCATAN LOS DATOS DEL PRODUCTO A EDITAR 
        // CAMPOS OBLIGATORIOS
            var nombreRubro= document.getElementById("input_nombreRubro");
            var ordenRubro= document.getElementById("input_ordenRubro");
            var destacadoRubro= document.getElementById("input_destacadoRubro");
            var menuRubro= document.getElementById("input_menuRubro");
            var estadoRubro= document.getElementById("input_estadoRubro");
        // CAMPOS OPCIONALES
            var idRubroPadre= document.getElementById("input_idRubroPadre");
            var descripcionRubro= document.getElementById("input_descripcionRubro");

        //  AJAX
            $.ajax({
                //async: false,   //  hace que esto se ejecute si o si antes de seguir con el siguiente codigo
                type: "POST",
                url: "/ajax_fetch_rubro_xid",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{
                        idRubro_ajax: idRubro, // variable obtenida de edit.blade.php
                        //_token: $('input[name="_token"]').val()
                    },
                dataType: "json",
                beforeSend:function (response) {                        
                    //input_archivos_alert.style.visibility="hidden";
                    //input_archivos_alert.innerHTML=" ";
                    // $(".alert").fadeTo(500, 1)
                },// \.beforeSend
                success: function (response) {
                    //  SETEAR CAMPOS
                        // CAMPOS OBLIGATORIOS
                            nombreRubro.value= response['rubro'].nombreRubro;
                            ordenRubro.value= response['rubro'].ordenRubro;
                            destacadoRubro.value= response['rubro'].destacadoRubro;
                            menuRubro.value= response['rubro'].menuRubro;
                            estadoRubro.value= response['rubro'].estadoRubro;

                        // CAMPOS OPCIONALES
                            idRubroPadre.value= response['rubro'].idRubroPadre;
                            descripcionRubro.value= response['rubro'].descripcionRubro;

                },// \.success
            });
        // \.ajax
    // \.AL CARGAR LA PAGINA, SE RESCATAN LOS DATOS DEL PRODUCTO A EDITAR 


    //  PRESIONAR EN BOTON ACTUALIZAR
        const   $btnEditarCategoria= document.querySelector("#boton_editar_categoria");   // referenciar boton Actualizar
        const   $inputArchivos= document.querySelector("#inputArchivos");   //  referenciar al input file
        //const   archivosParaSubir = $inputArchivos.files;   //  referenciar archivos del input file
        const formData = new FormData();    // crear estructura que contendra los datos/archivos que se carguen


        function delete_key_formdata(key_name){
            formData.delete(key_name);
        }

        function get_inputfiles_set_formdata(){
            //  Rescata archivos
                    const archivosParaSubir = $inputArchivos.files;
            //  Rescata vector con data-id en orden
                var order_list = $(".lg-image").map(function(){
                                                        return $(this).attr("data-id");
                                                    }).get();   //console.log("order_list"+order_list);
            //  valida que se haya cargado aunque sea 1 archivo
                /*if(archivosParaSubir.length <= 0){}*/
            // Definición de la estructura que contendrá los datos -> formdata
                //const formData = new FormData();
                
            //  Borrar key archivos[] de formData (para volver a cargar los archivos en una key vacia)
                delete_key_formdata("archivos[]");

            // Agregamos cada archivo cargado a "archivos[]"
                for (const archivo of archivosParaSubir) {
                    formData.append("archivos[]", archivo);
                }
                /*for(const archivo of archivosParaSubir){console.log(archivo.size);}*/
            //  Agregamos vector con data-id ordenado
                formData.append("order_list", order_list);
        }

        function get_inputs_set_formdata(){
            //  Recorre el formulario y rescata los inputs por su name y el valor que se ingresó
                var nameinputs_values = $('form').serializeArray(); // vector contenedor de elementos de tipo name_input->input_value
            //  Inserta cada elemento del vector contenedor dentro de la estructura formData -> para enviar al ajax una sola estructura/dato
                $.each(nameinputs_values,function(key,input){
                    formData.append(input.name,input.value);
                });
                //console.log("fin del get inputs");
        }


        $btnEditarCategoria.addEventListener("click", async () => {

            
            //  Rescatar inputs text/number/select y guardarlso en la estructura formdata
                get_inputs_set_formdata();      //console.log(formData);return;

            //  DETERMINAR SI ESTE AJAX SERA UTILIZADO O NO SEGUN SE HAYAN CARGADO O NO NUEVOS ARCHIVOS MULTIMEDIA
            //  AJAX
                $.ajax({
                    //async: false,   //  hace que esto se ejecute si o si antes de seguir con el siguiente codigo
                    type: "POST",
                    url: "/actualizar_categorias",
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
                        if(response.mensaje_creacion_producto=="ok"){
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
                                    onClosing: function () {window.location.replace('/admin/categorias/ver_todos');}  //  REDIRECCIONA cuando el toast se cierra
                                });
                                    //  REDIRECCIONAR PÁGINA
                                        /*setTimeout( function() {
                                            window.location.replace('/admin/productos/crear');
                                        }, 2000);// Se esperará cierto tiempo antes de ejecutarse */
                        }

                    },  // \.success
                }); 
            // \.ajax
        }); //\.$btnEditarCategoria.addEventListener("click"


});    //\.$(document).ready(function() {

    
