@extends('layouts.main-layout')

@section('title-page')
    Listado de libros
@endsection

@section('content-page')
    <article class="col-12 col-md-12 col-lg-12 col-xl-12">
        <h2 class="text-center">¡Bienvenido(a) a tu librería!</h2>
    </article>

    <x-errors-display :errores="$errores" />

    <section class="row mt-3 mt-md-3 mt-lg-3 mt-xl-3">
        <article class="col-12 col-md-8 col-lg-8 col-xl-8">
            <x-card idBody="">
                <h3 class="text-center">Libros dísponibles</h3>
                <ul class="list-group scroll-max-600">
                    @forelse ($libros as $libro)
                        <li class="list-group-item d-flex justify-content-between">
                            <b>{{ $libro['nombre_libro'] }}</b>
                            <article class="btn-group" role="group" aria-label="Button group">
                                <button class="btn btn-outline-primary" type="button">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                                <button class="btn btn-outline-danger" type="button">
                                    <i class="fa-regular fa-trash-can"></i>
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
                Agregar libro
            </x-card>
        </article>
    </section>

@endsection