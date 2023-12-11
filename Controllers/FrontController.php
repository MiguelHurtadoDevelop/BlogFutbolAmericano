<?php

namespace Controllers;



/**
 * Clase que nos controla el flujo de las llamadas a los controladores y a sus respectivos metodos
 */
class FrontController
{
    /**
     * @return void
     * Este metodo nos controla que si no hemos llamado a ningun metodo ni accion nos llama a las definidas por defecto,
     * y si realizamos alguna llamada nos lleva a ella
     */
    public static function main():void
    {


        if (isset($_GET['controller'])) {

            $nombre_controlador = 'Controllers\\' . $_GET['controller'] . 'Controller';

        }else{

            $nombre_controlador = 'Controllers\\'.CONTROLLER_DEFAULT;
        }
        if (class_exists($nombre_controlador)) {

            $controlador = new $nombre_controlador();

            if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
                $action = $_GET['action'];
                $controlador->$action();
            } elseif(!isset($_GET['controller']) && !isset($_GET['action'])){

                $action_default = ACTION_DEFAULT;
                $controlador -> $action_default();
            }else {
                echo ErrorController::show_error404();
            }
        } else {
            echo ErrorController::show_error404();
        }
    }

}