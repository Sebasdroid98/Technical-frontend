<?php

namespace App\Http\Controllers;

use App\Services\BookService;
use Illuminate\Http\Request;

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
        $libros = [];
        $errores = [];

        $librosAPI = $this->bookService->getListBooks();
        if (isset($librosAPI['errorAPI'])) {
            $errores[] = $librosAPI['errorAPI']['code'].' - '.$librosAPI['errorAPI']['message'];
            return view('books.list-books', [
                'libros'    => $libros,
                'errores'   => $errores
            ]);
        }

        $libros = $librosAPI['data'];
        return view('books.list-books', [
            'libros'    => $libros,
            'errores'   => $errores
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
