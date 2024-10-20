@extends('layouts.main-layout')

@section('title-page')
    Listado de libros
@endsection

@section('content-page')
    <article class="col-12 col-md-12 col-lg-12 col-xl-12">
        <h2 class="text-center">¡Bienvenido(a) a tu librería!</h2>
    </article>

    <article class="col-12 col-md-12 col-lg-12 col-xl-12" id="errores-ajax">
    </article>
    <x-errors-display :errores="$errores" />

    <section class="row mt-3 mt-md-3 mt-lg-3 mt-xl-3">
        <article class="col-12 col-md-8 col-lg-8 col-xl-8">
            <x-card idBody="">
                <h3 class="text-center">Libros dísponibles</h3>
                <ul class="list-group scroll-max-600" id="list-books">
                    @forelse ($libros as $libro)
                        <li class="list-group-item d-flex justify-content-between">
                            <b>{{ $libro['nombre_libro'] }}</b>
                            <article class="btn-group" role="group" aria-label="Button group">
                                <button class="btn btn-outline-primary" type="button" onclick="editarLibro({{$libro['id_libro']}})">
                                    <i class="fa-regular fa-pen-to-square"> Editar</i>
                                </button>
                                <button class="btn btn-outline-danger" type="button" onclick="eliminarLibro({{$libro['id_libro']}})">
                                    <i class="fa-regular fa-trash-can"> Borrar</i>
                                </button>
                            </article>
                        </li>
                    @empty
                        <li class="list-group-item h4 text-center">Aún no tienes libros, prueba a agregar uno!</li>
                    @endforelse
                </ul>
            </x-card>
        </article>
    
        <article class="col-12 col-md-4 col-lg-4 col-xl-4">
            <x-card>
                <article id="space-form-book">
                    <h3 id="form-titulo" class="text-center">Nuevo libro</h3>
                    @csrf
                    <section class="form-group">
                        <label for="nombre-create">Nombre del libro</label>
                        <textarea id="nombre-create" class="form-control" rows="5" maxlength="100" placeholder="Ingresa el título del libro"></textarea>
                        <small class="text-muted float-right">(100 caracteres máximo)</small>
                    </section>
                    <button id="btn-save" class="btn btn-outline-primary" onclick="createBook()">
                        <i class="fa-regular fa-floppy-disk"> GUARDAR</i>
                    </button>
                </article>
            </x-card>
        </article>
    </section>
@endsection

@section('scripts-footer')
    <script src="{{ asset('global/js/create-book.js') }}" type="text/javascript"></script>
    <script src="{{ asset('global/js/edit-book.js') }}" type="text/javascript"></script>
    <script src="{{ asset('global/js/updated-book.js') }}" type="text/javascript"></script>
    <script src="{{ asset('global/js/delete-book.js') }}" type="text/javascript"></script>
@endsection