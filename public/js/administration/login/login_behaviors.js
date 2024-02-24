$(document).ready(function() {

        
    //  REFERENCIAR EL BOTON CREAR producto
        const   $btnLogin= document.querySelector("#boton_login");

                $btnLogin.addEventListener("click", async () => {
                    

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
                        
                    //  Muestra por consola el valor de la llave indicada del elemento de tipo FormData
                            //console.log(formData.getAll('login_usuario'));
                            //console.log(formData.getAll('login_password'));
                    //  \.Muestra por consola el valor de la llave indicada del elemento de tipo FormData

                        //var input_archivos_alert= document.getElementById("input_archivos_alert");

                    //  AJAX
                        $.ajax({
                            //async: false,   //  hace que esto se ejecute si o si antes de seguir con el siguiente codigo
                            type: "POST",
                            url: "/authenticate",
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data:
                                    formData,
                                    //_token: $('input[name="_token"]').val()
                                
                            dataType: "json",
                            processData: false,
                            contentType: false,
                            beforeSend:function (response) {                        
                                //input_archivos_alert.style.visibility="hidden";
                                //input_archivos_alert.innerHTML=" ";
                                // $(".alert").fadeTo(500, 1)
                            },// \.beforeSend
                            success: function (response) {
                                //console.log("-"+response.mensaje_error+"-");
                                
                                if(response.mensaje_error!=""){
                                    //input_archivos_alert.innerHTML= response.mensaje_error;
                                    $(".alert").fadeTo(500, 1);
                                    setTimeout(function() {
                                        $(".alert").fadeTo(500, 0);
                                        //$(".alert").slideUp(500);
                                    }, 2000);
                                }

                                if(response.mensaje_existe_usuario != ""){
                                    if(response.mensaje_existe_usuario=="si_existe"){
                                        //console.log("CREACION DE PRODUCTO EXITOSA");
                                        //  MENSAJE EMERGENTE DE OK + REDIRECCION AL DASHBOARD
                                            Swal.fire({
                                                title: '¡BIENVENIDO/A!',
                                                text:'Acabas de inicar sesión',
                                                icon: 'success',            //muestra animacion de tilde
                                                showConfirmButton: false,   //NO muestra boton de confirmar
                                                timer: 2000,                //tiempo que permanece visible la notificación
                                                allowOutsideClick: false,
                                                allowEscapeKey: false,
                                                //html: '<p class="sweetalert2-html-actionText">Acabas de iniciar sesión</p>',
                                                //La propiedad html reemplaza a las propiedades: title y text
                                                //Las clases están definidas en el archivo admin/css/admin.css
                                            }).then(function() {
                                                //  REDIRECCIONAR PAGINA
                                                    window.location.replace('/admin/productos/ver_todos');  // redireccionar al DASHBOARD QUE TODAVIA NO SE CREO
                                                });
                                    }else{
                                        swa2_campo_invalido(response.mensaje_error);
                                    }
                                }                                
                            },// \.success
                        });
                    // \.ajax
                });


});    //\.$(document).ready(function() {