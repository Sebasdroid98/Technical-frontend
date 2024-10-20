<?php

namespace App\Services;

class BookService extends ServiceControl
{

    /**
     * Servicio para obtener los libros registrados
     * @return array $resultadoAPI
     */
    public function getListBooks()
    {
        return $this->peticionGET('v1/books');
    }

}

?>