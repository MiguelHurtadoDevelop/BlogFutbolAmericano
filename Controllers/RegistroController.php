<?php
namespace Controllers;

use Lib\Pages;
use Utils\Utils;
use Models\Registro;

class RegistroController
{
    private Pages $pages;

    /**
     * Constructor de la clase RegistroController.
     */
    public function __construct()
    {
        $this->pages = new Pages();
    }

    /**
     * Obtener todos los registros.
     *
     * @return array|null Array de registros o null si no se encuentran.
     */
    public static function obtenerRegistros(): ?array
    {
        return Registro::getAll();
    }

    /**
     * Obtener registros por categoría.
     *
     * @param int $categoriaID ID de la categoría.
     * @return array|null Array de registros o null si no se encuentran.
     */
    public static function obtenerRegistrosCat($categoriaID): ?array
    {
        return Registro::buscarCat($categoriaID);
    }

    /**
     * Buscar registros según el formulario de búsqueda.
     */
    public  function buscarRegistros()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buscar'])) {
            $buscar = $_POST['buscar'];
            
            $registros = Registro::buscarRegistros($buscar);
            
        } else {
            $buscar = null;
        }
        $this->pages->render('/registros/mostrarRegistros', ['registrosEncontrados' => $registros, 'buscar' => 'true']); 
    }

    /**
     * Mostrar registros basados en la categoría proporcionada o todos los registros si no se especifica.
     *
     * @param int|null $categoriaId ID de la categoría (opcional).
     */
    public function mostrarRegistros($categoriaId = null) {
        if ($categoriaId === null) {
            $registros = self::obtenerRegistros();
        } else {
            $registros = self::obtenerRegistrosCat($categoriaId);
        }
        $this->pages->render('/registros/mostrarRegistros', ['registros' => $registros]);
    }

    /**
     * Renderizar la página para agregar un registro.
     */
    function addRegistro(){
        $this->pages->render('/registros/añadirRegistro');
    }

    /**
     * Añadir un nuevo registro basado en el formulario de envío.
     */
    public function AnadirRegistro(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if (!empty($_POST['registro'])){
                $registroData = $_POST['registro'];
    
                $titulo = $registroData['titulo'];
                $descripcion = $registroData['descripcion'];
                $categoriaId = $registroData['categoria_id'];
                $usuarioId = $_SESSION['login']->id;
                $fecha = date("Y-m-d H:i:s");
    
                $registroNuevo = new Registro();
    
                // Validar el registro
                $validacion = $registroNuevo->validarRegistro($titulo, $descripcion, $categoriaId);
    
                if ($validacion['isValid']) {

                    $titulo = $registroNuevo->sanearTitulo($titulo);
                    $descripcion = $registroNuevo->sanearDescripcion($descripcion);

                    $registroNuevo->setTitulo($titulo);
                    $registroNuevo->setDescripcion($descripcion);
                    $registroNuevo->setUsuarioId($usuarioId);
                    $registroNuevo->setCategoriaId($categoriaId);
                    $registroNuevo->setFecha($fecha);
    
                    // Si el registro es válido, crea el registro en la base de datos
                    $save = $registroNuevo->create();

                    if ($save) {
                        $_SESSION['RegistroAñadido'] = "complete";
                        $this->pages->render('/registros/mostrarRegistros');
                    } else {
                        $_SESSION['RegistroAñadido'] = "failed";
                        $this->pages->render('/registros/añadirRegistro', ['registro' => $registroData]);
                    }
                } else {
                    // Si el registro no es válido, guarda el registro en la sesión
                    $_SESSION['RegistroAñadido'] = "failed";
                    $_SESSION['errorTitulo'] = $validacion['errorTitulo'];
                    $_SESSION['errorDescripcion'] = $validacion['errorDescripcion'];
                    $_SESSION['errorCategoria'] = $validacion['errorCategoria'];
                    
                    // Redirige a la vista de añadir registro
                    $this->pages->render('/registros/añadirRegistro', ['registro' => $registroData]);
                }
            } else {
                $_SESSION['RegistroAñadido'] = "failed";
                $this->pages->render('/registros/añadirRegistro', ['registro' => $registroData]);
            }
        } else {
            $_SESSION['RegistroAñadido'] = "failed";
            $this->pages->render('/registros/añadirRegistro', ['registro' => $registroData]);
        }
    
        $registroNuevo->desconecta();
    }

    /**
     * Renderizar la página de edición de un registro.
     */
    public function editarRegistro(){
        if (isset($_GET['id'])) {
            $idRegistro = $_GET['id'];
    
            $registroAEditar = new Registro();
    
            $registro = $registroAEditar->buscaId($idRegistro);
    
            $this->pages->render('/registros/editarRegistro', ['registro' => $registro]);
    
        } else {
            $this->pages->render('/registros/mostrarRegistros');
        }
    }

    /**
     * Actualizar un registro basado en el formulario de envío.
     */
    public function actualizarRegistro(){
        if (($_SERVER['REQUEST_METHOD']) === 'POST'){
            if ($_POST['registro']){
                $registroData = $_POST['registro'];
                $titulo = $registroData['titulo'];
                $descripcion = $registroData['descripcion'];
                $categoriaId = $registroData['categoria_id'];
                $id = $registroData['id'];
                $usuarioId = $_SESSION['login']->id;
                $fecha = date("Y-m-d H:i:s");

                $registro = new Registro();
                $registro->setId($id);
    
                // Validar el registro
                $validacion = $registro->validarRegistro($titulo, $descripcion, $categoriaId);
    
                if ($validacion['isValid']) {
    
                    $titulo = $registro->sanearTitulo($titulo);
                    $descripcion = $registro->sanearDescripcion($descripcion);
                    
                    $registro->setTitulo($titulo);
                    $registro->setDescripcion($descripcion);
                    $registro->setCategoriaId($categoriaId);
                    $registro->setUsuarioId($usuarioId);
                    $registro->setFecha($fecha);

                    // Si el registro es válido, actualizarlo en la base de datos
                    $save = $registro->update();
                    if ($save){
                        $_SESSION['RegistroActualizado'] = "complete";
                        $this->pages->render('registros/mostrarRegistros');
                    } else {
                        $_SESSION['RegistroActualizado'] = "failed";
                        $this->pages->render('registros/editarRegistro', ['registro' => $registroData]);
                    }
                } else {
                    // Si el registro no es válido, guarda el registro en la sesión
                    $_SESSION['RegistroActualizado'] = "failed";
                    $_SESSION['errorTitulo'] = $validacion['errorTitulo'];
                    $_SESSION['errorDescripcion'] = $validacion['errorDescripcion'];
                    $_SESSION['errorCategoria'] = $validacion['errorCategoria'];
                    
                    // Redirige a la vista de edición de registro
                    $this->pages->render('registros/editarRegistro', ['registro' => $registroData]);
                }
            } else {
                $_SESSION['RegistroActualizado'] = "failed";
                $this->pages->render('registros/editarRegistro', ['registro' => $registroData]);
            }
        } else {
            $_SESSION['RegistroActualizado'] = "failed";
            $this->pages->render('registros/editarRegistro', ['registro' => $registroData]);
        }
    
        $registro->desconecta();
    }

    /**
     * Borrar un registro basado en el ID proporcionado.
     */
    public function borrarRegistro(){
        if (isset($_GET['id'])) {
            $idRegistro = $_GET['id'];
            $registroABorrar = new Registro();
            $registroABorrar->setId($idRegistro);
            $delete = $registroABorrar->delete();
            if ($delete) {
                $_SESSION['RegistroBorrado'] = "complete";
            } else {
                $_SESSION['RegistroBorrado'] = "failed";
            }
            $registroABorrar->desconecta();
        } else {
            $_SESSION['RegistroBorrado'] = "failed";
        }
        $this->pages->render('/registros/mostrarRegistros');
    }
}
