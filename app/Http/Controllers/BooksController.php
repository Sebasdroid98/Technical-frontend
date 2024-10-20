<?php

namespace App\Http\Controllers;

use App\Services\BookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{
    protected $bookService;

    public function __construct() {
        $this->bookService = new BookService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $librosAPI = $this->listBooks();
        $libros = $librosAPI['libros'];
        $errores = $librosAPI['errores'];

        return view('books.list-books', [
            'libros'    => $libros,
            'errores'   => $errores
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $respuesta = [
            'status' => false,
            'message' => [],
            'errores' => []
        ];

        $datosFormulario = $request->except('_token');

        $rules = [
            'nombre_libro' => 'required|string|max:100'
        ];

        $messages = [
            'nombre_libro.required' => 'El nombre es obligatorio',
            'nombre_libro.max' => 'El nombre solo puede tener maximo 100 caracteres'
        ];

        $validator = Validator::make($datosFormulario,$rules, $messages);

        // Si falla la validación
        if ($validator->fails()) {
            $respuesta['errores'] = $validator->errors()->all();
            return $respuesta;
        }

        $libroAPI = $this->bookService->storeBook($datosFormulario);
        if (isset($libroAPI['errorAPI'])) {
            $respuesta['errores'][] = $libroAPI['errorAPI']['code'].' - '.$libroAPI['errorAPI']['message'];
            return $respuesta;
        }

        $respuesta['status'] = true;
        $respuesta['message'] = $libroAPI['data'];
        return $respuesta;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $respuesta = [
            'status' => false,
            'libro' => [],
            'errores' => []
        ];

        $librosAPI = $this->bookService->getBookById($id);
        if (isset($librosAPI['errorAPI'])) {
            $respuesta['errores'][] = $librosAPI['errorAPI']['code'].' - '.$librosAPI['errorAPI']['message'];
            return $respuesta;
        }

        $respuesta['status'] = true;
        $respuesta['libro'] = $librosAPI['data'];
        return $respuesta;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $respuesta = [
            'status' => false,
            'message' => [],
            'errores' => []
        ];

        $datosFormulario = $request->except('_token');

        $rules = [
            'nombre_libro' => 'required|string|max:100'
        ];

        $messages = [
            'nombre_libro.required' => 'El nombre es obligatorio',
            'nombre_libro.max' => 'El nombre solo puede tener maximo 100 caracteres'
        ];

        $validator = Validator::make($datosFormulario,$rules, $messages);

        // Si falla la validación
        if ($validator->fails()) {
            $respuesta['errores'] = $validator->errors()->all();
            return $respuesta;
        }

        $libroAPI = $this->bookService->updateBook($datosFormulario, $id);
        if (isset($libroAPI['errorAPI'])) {
            $respuesta['errores'][] = $libroAPI['errorAPI']['code'].' - '.$libroAPI['errorAPI']['message'];
            return $respuesta;
        }

        $respuesta['status'] = true;
        $respuesta['message'] = $libroAPI['data'];
        return $respuesta;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $respuesta = [
            'status' => false,
            'message' => [],
            'errores' => []
        ];

        $libroAPI = $this->bookService->deleteBookById($id);
        if (isset($libroAPI['errorAPI'])) {
            $respuesta['errores'][] = $libroAPI['errorAPI']['code'].' - '.$libroAPI['errorAPI']['message'];
            return $respuesta;
        }

        $respuesta['status'] = true;
        $respuesta['message'] = $libroAPI['data'];
        return $respuesta;
    }

    /**
     * Función para disponer de los libros mediante AJAX
     * @return Array
     */
    public function listBooks()
    {
        $respuesta = [
            'libros' => [],
            'errores' => []
        ];

        $librosAPI = $this->bookService->getListBooks();
        if (isset($librosAPI['errorAPI'])) {
            $respuesta['errores'][] = $librosAPI['errorAPI']['code'].' - '.$librosAPI['errorAPI']['message'];
            return $respuesta;
        }

        $respuesta['libros'] = $librosAPI['data'];
        return $respuesta;
    }
}
