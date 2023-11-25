$(document).ready(function() {


    //  ELEGIR MARCA -> FORMAR INPUTS SELECT DE MODELOS
        $('#input_marca').change( function() {
            //  Referenciar valor
                var idMarca= document.getElementById("input_marca").value;
            generate_model_options_xidMarca(idMarca);
        }); //\.$('#input_marcas').change 
    //\.ELEGIR MARCA -> FORMAR INPUTS SELECT DE MODELOS
        
    //  AL CARGAR LA PAGINA, SE RESCATAN LOS DATOS DEL PRODUCTO A EDITAR 
            var idMarca= document.getElementById("input_marca");
            //var idModelo= document.getElementById("input_modelo");
            var idRubro= document.getElementById("input_categoria");
            var nombreProducto= document.getElementById("input_nombre");
            var destacadoProducto= document.getElementById("input_es_destacado");
            var stockProducto= document.getElementById("input_stock");
            var estadoProducto= document.getElementById("input_estado");

        //  AJAX
            $.ajax({
                //async: false,   //  hace que esto se ejecute si o si antes de seguir con el siguiente codigo
                type: "POST",
                url: "/ajax_fetch_producto_xid",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{
                        idProducto_ajax: idProducto, // variable obtenida de edit.blade.php
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
                        nombreProducto.value= response['producto'].nombreProducto;
                        destacadoProducto.value= response['producto'].destacadoProducto;
                        stockProducto.value= response['producto'].stockProducto;
                        estadoProducto.value= response['producto'].condicion;
                        idMarca.value= response['producto'].idMarca;
                        //  CAMPO DEPENDIENTE de idMarca
                            delete_options_by_select_id('input_modelo');    // borrar opciones
                            generate_model_options_xidMarca(idMarca.value, response['producto'].idModelo);  // generar opciones + seteo
                        
                        idRubro.value= response['producto'].idRubro;
                },// \.success
            });
        // \.ajax
    // \.AL CARGAR LA PAGINA, SE RESCATAN LOS DATOS DEL PRODUCTO A EDITAR 


    //  PRESIONAR EN BOTON ACTUALIZAR
        const   $btnEditarProducto= document.querySelector("#boton_editar_producto");   // referenciar boton Actualizar
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


        $btnEditarProducto.addEventListener("click", async () => {

            //  DETERMINAR SI SE CARGARON O NO NUEVOS ARCHIVOS MULTIMEDIA
                //var input_archivos= document.getElementById('inputArchivos');
                if($inputArchivos.files.length>0){
                    //  Rescatar archivos de input file y guardarlos en la estructura formdata
                        get_inputfiles_set_formdata();
                    //  Rescatar inputs text/number/select y guardarlso en la estructura formdata
                        get_inputs_set_formdata();
                }else{
                    //  Rescatar inputs text/number/select y guardarlso en la estructura formdata
                        get_inputs_set_formdata();
                }

                //  Referenciar mensaje de alerta
                    var input_archivos_alert= document.getElementById("input_archivos_alert");

            //  DETERMINAR SI ESTE AJAX SERA UTILIZADO O NO SEGUN SE HAYAN CARGADO O NO NUEVOS ARCHIVOS MULTIMEDIA
            //  AJAX
                $.ajax({
                    //async: false,   //  hace que esto se ejecute si o si antes de seguir con el siguiente codigo
                    type: "POST",
                    url: "/actualizar_archivos_y_productos",
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
                        if(response.mensaje_error!=""){
                            input_archivos_alert.innerHTML= response.mensaje_error;
                            $(".alert").fadeTo(500, 1);
                            setTimeout(function() {
                                $(".alert").fadeTo(500, 0);
                                //$(".alert").slideUp(500);
                            }, 2000);
                        }

                        if(response.mensaje_creacion_producto=="ok"){
                                    //console.log("CREACION DE PRODUCTO EXITOSA");
                            // success
                                iziToast.success({
                                    timeout: 2000, 
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
                                    onClosed: function () {window.location.replace('/admin/productos/crear');}  //  REDIRECCIONA cuando el toast se cierra
                                });
                                    //  REDIRECCIONAR PÁGINA
                                        /*setTimeout( function() {
                                            window.location.replace('/admin/productos/crear');
                                        }, 2000);// Se esperará cierto tiempo antes de ejecutarse */
                        }

                    },  // \.success
                }); 
            // \.ajax
        }); //\.$btnEditarProducto.addEventListener("click"




});    //\.$(document).ready(function() {

    
