/**
 * Funcion para colocar toasts genericos
 * @param tipo -> con el tipo del toasts Ejm: info, success, warning, error
 * @param titulo -> con el titulo del toasts
 * @param contenido -> con el contenido del toasts
 * @param autohide -> con true o false para mantener en pantalla o ocultar automaticamente
 * @param delay -> con los milisegundos a mostrarse en pantalla
 */
function colocarToast(tipo, titulo, contenido, autohide, delay = null) {
    let duracion = 5000;
    let extendedTimeOut = 1000;

    if (delay != null) { duracion = delay; }

    if (!autohide) {
        duracion = 0;
        extendedTimeOut = 0;
    }

    //timeOut y extendedTimeOut: si se coloca 0 (cero) no se cierra
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": true,
        "onclick": onclick,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": duracion,
        "extendedTimeOut": extendedTimeOut,
        "escapeHtml": false,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    switch (tipo) {
        case 'warning':
            toastr.warning(contenido, titulo);
            break;

        case 'success':
            toastr.success(contenido, titulo);
            break;

        case 'error':
            toastr.error(contenido, titulo);
            break;

        default:
            toastr.info(contenido, titulo);
            break;
    }
}