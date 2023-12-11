<?php

namespace Controllers;
/**
 *Clase que nos controlara los errores producidos
 */
class ErrorController
{
    /**
     * @return string
     * Metodo que si nos llega un error 404 nos mostrara el mensaje "La pagina que buscas no existe"
     */
    public static function show_error404():string{
        return "<p>La pagina que buscas no existe</p>";
    }
}