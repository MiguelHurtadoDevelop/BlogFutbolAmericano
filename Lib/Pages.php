<?php

namespace Lib;

class Pages
{
    /**
     * Método para renderizar una página.
     *
     * @param string $pageName Nombre de la página (vista) a renderizar.
     * @param array|null $params Parámetros opcionales a pasar a la vista.
     */
    public function render(string $pageName, array $params = null): void
    {
        // Si hay parámetros, extraerlos y hacerlos accesibles en la vista.
        if ($params != null) {
            foreach ($params as $name => $value) {
                $$name = $value;
            }
        }

        // Incluir los archivos de cabecera, la vista y el pie de página.
        require_once 'views/layout/header.php';
        require_once "Views/$pageName.php";
        require_once 'views/layout/footer.php';
    }
}
