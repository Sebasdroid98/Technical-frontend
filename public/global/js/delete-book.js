/**
 * Función para eliminar un libro por su id
 * @param int $id
 */
function eliminarLibro(id) {
    var token = $("[name=_token]").val();
    const ruta = urlBase + '/delete-book/' + id;

    $.ajax({
        type: "DELETE",
        headers: {'X-CSRF-TOKEN': token},
        url: ruta,
        data: {},
        success: function(rta){
            if (!rta.status) {
                colocarToast('error', 'Notificación', 'Se encontraron errores', true, 5000);
                return false;
            }

            colocarToast('success', 'Notificación', rta.message, true, 5000);
            getListBooks();
        }
    });
}