/**
 * Función para actualizar un libro por su id
 * @param int $id
 */
function updateBook(id) {
    var token = $("[name=_token]").val();
    var nombreLibro = $("#nombre-create").val();
    var fieldNombreLibro = $("#nombre-create");
    const btnSave = $("#btn-save");
    const formTitulo = $("#form-titulo");
    const ruta = urlBase + '/update-book/' + id;

    $.ajax({
        type: "PUT",
        headers: {'X-CSRF-TOKEN': token},
        url: ruta,
        data: {
            nombre_libro: nombreLibro
        },
        success: function(rta){
            if (!rta.status) {
                colocarToast('error', 'Notificación', 'Se encontraron errores', true, 5000);
                return false;
            }

            colocarToast('success', 'Notificación', rta.message, true, 5000);
            fieldNombreLibro.val('');
            btnSave.removeAttr('onclick');
            btnSave.attr('onclick', `createBook()`);
            formTitulo.text('Nuevo libro');
            getListBooks();
        }
    });
}