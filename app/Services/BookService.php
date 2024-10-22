<?php

namespace App\Services;

class BookService extends ServiceControl
{

    /**
     * Servicio para obtener los libros registrados
     * @return array
     */
    public function getListBooks()
    {
        return $this->peticionGET('api/v1/books');
    }

    /**
     * Servicio para obtener un libro por su id
     * @param int $id
     * @return array
     */
    public function getBookById(int $id)
    {
        return $this->peticionGET('api/v1/books', $id);
    }

    /**
     * Servicio para registrar un libro
     * @param array $datosLibro
     * @return array
     */
    public function storeBook(array $datosLibro) {
        return $this->peticionPOST('api/v1/books', $datosLibro);
    }

    /**
     * Servicio para actualizar un libro por su id
     * @param array $datosLibro
     * @param int $idLibro -> con el id actual del libro
     * @return array
     */
    public function updateBook(array $datosLibro, int $idLibro) {
        return $this->peticionPUT('api/v1/books', $idLibro,$datosLibro);
    }

    /**
     * Servicio para eliminar un libro por su id
     * @param int $idLibro
     * @return array
     */
    public function deleteBookById(int $id)
    {
        return $this->peticionDELETE('api/v1/books', $id);
    }

}

?>
