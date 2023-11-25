//  DEFINICION DE ALERTAS A REUTILIZAR EN TODAS LAS SECCIONES (techos, paredes, pisos, etc...)
function swa2_campo_obligatorio(mensaje) {
    Swal.fire({
        icon: 'warning',
        html: '<p class="sweetalert2-html-actionText">'+mensaje+'</p>',
        showConfirmButton: false,   //NO muestra boton de confirmar
        timer: 3000,                //tiempo que permanece visible la notificación
    })
}

function swa2_campo_invalido(mensaje) {
    Swal.fire({
        //title: '¡BIENVENIDO!',
        //text:'Iniciaste sesión con ÉXITO',
        icon: 'error',            //muestra animacion de tilde
        showConfirmButton: false,   //NO muestra boton de confirmar
        timer: 2000,                //tiempo que permanece visible la notificación
        html: '<p class="sweetalert2-html-errorText">¡ERROR!</p> <p class="sweetalert2-html-actionText">'+mensaje+'</p>',
        //La propiedad html reemplaza a las propiedades: title y text
        //Las clases están definidas en el archivo admin/css/admin.css
    });
}

function swa2_success_up_right(mensaje) {
    Swal.fire({
        icon: 'success',
        title: mensaje, //  parametro
        //html: '<p class="sweetalert2-html-actionText">Actualización exitosa</p>',
        position: 'top-right',
        showConfirmButton: false,   //NO muestra boton de confirmar
        timer: 2000,                //tiempo que permanece visible la notificación
        customClass:{
            popup:'mt-5'
        }
    })
}

function swa2_register_not_deleted() {
    Swal.fire({
        //title: '¡BIENVENIDO!',
        //text:'Iniciaste sesión con ÉXITO',
        //icon: 'error',            //muestra animacion de tilde
        iconHtml: '<i class="fa-regular fa-face-frown text-danger"></i>',
        customClass: {
            icon: 'no-border'
        },
        showConfirmButton: false,   //NO muestra boton de confirmar
        timer: 2000,                //tiempo que permanece visible la notificación
        html: '<p class="sweetalert2-html-errorText text-danger">No fue posible eliminar este registro</p>',
        //La propiedad html reemplaza a las propiedades: title y text
        //Las clases están definidas en el archivo admin/css/admin.css
    });
}
    
