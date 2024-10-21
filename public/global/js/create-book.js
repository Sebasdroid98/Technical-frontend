/**
 * Función para registrar un libro
 */
function createBook() {
    var token = $("[name=_token]").val();
    var nombreLibro = $("#nombre-create").val();
    var fieldNombreLibro = $("#nombre-create");
    const ruta = urlBase + '/store-book';

    $.ajax({
        type: "POST",
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
            getListBooks();
        }
    });
}

/**
 * Función para obtener el listado de libros
 */
function getListBooks() {
    const route = urlBase + '/list-books';
    const listaLibros = $("#list-books");
    const espacioErrores = $("#errores-ajax");
    $.getJSON(route)
        .done(function (datos) {
            // console.log("🚀 ~ datos:", datos)
            /* Se actualiza la lista de los libros usando AJAX */
            if ((datos.libros).length == 0) {
                listaLibros.empty();
                listaLibros.append(`<li class="list-group-item h4 text-center">Aún no tienes libros, prueba a agregar uno!</li>`);
            } else {
                let libros = $(datos.libros).map(function(key, value) {
                    let id = value.id_libro;
                    let nombre = value.nombre_libro;
                    return `<li class="list-group-item d-flex justify-content-between">
                                <b>${nombre}</b>
                                <article class="btn-group" role="group" aria-label="Button group">
                                    <button class="btn btn-outline-primary" type="button" onclick="editarLibro(${id})">
                                        <i class="fa-regular fa-pen-to-square"> Editar</i>
                                    </button>
                                    <button class="btn btn-outline-danger" type="button" onclick="eliminarLibro(${id})">
                                        <i class="fa-regular fa-trash-can"> Borrar</i>
                                    </button>
                                </article>
                            </li>`;
                }).get().join('');
                listaLibros.empty();
                listaLibros.append(libros);
            }

            /* Se muestra la lista de errores usando AJAX */
            if ((datos.errores).length > 0) {
                let errores = $(datos.libros).map(function(key, value) {
                    return `<li>${value}</li>`;
                }).get().join('');
                espacioErrores.empty();
                listaErrores.append(`<article class="col-12 col-md-12 col-lg-12 col-xl-12">
                                        <div class="alert alert-danger" role="alert">
                                            <p>Se encontraron los siguientes errores:</p>
                                            <ul>${errores}</ul>
                                        </div>
                                    </article>`);
            } else {
                espacioErrores.empty();
            }

        }).fail(function (datos) {
        })
    ;
}