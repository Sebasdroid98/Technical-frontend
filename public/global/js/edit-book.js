/**
 * Función para obtener los datos de un libro por su id y activar el formulario de actualizar
 * @param int id
 */
function editarLibro(id) {
    const route = urlBase + '/info-book/' + id;
    const btnSave = $("#btn-save");
    const formTitulo = $("#form-titulo");
    var fieldNombreLibro = $("#nombre-create");

    $.getJSON(route)
        .done(function (datos) {
            console.log("🚀 ~ datos:", datos)
            if (!datos.status) {
                colocarToast('error', 'Notificación', 'Se encontraron errores al obtener el libro', true, 5000);
                return false;
            }

            let nombreActual = datos.libro.nombre_libro;
            fieldNombreLibro.val(nombreActual);
            btnSave.removeAttr('onclick');
            btnSave.attr('onclick', `updateBook(${id})`);
            formTitulo.text('Modificar libro');
        }).fail(function (datos) {
        })
    ;
}