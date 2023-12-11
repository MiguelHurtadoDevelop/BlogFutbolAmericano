<?php

// Espacio de nombres para la clase Registro en el directorio Models
namespace Models;

// Importa la clase BaseDatos del espacio de nombres Lib
use Lib\BaseDatos;

// Importa las clases PDO y PDOException
use PDO;
use PDOException;

// Definición de la clase Registro
class Registro
{
    // Propiedades de la clase
    private int $id;             // Identificador del registro
    private int $categoriaId;    // Identificador de la categoría asociada al registro
    private int $usuarioId;      // Identificador del usuario asociado al registro
    private string $titulo;      // Título del registro
    private string $descripcion; // Descripción del registro
    private string $fecha;       // Fecha del registro (faltaba esta propiedad en la declaración)
    private BaseDatos $db;       // Instancia de la clase BaseDatos para la conexión a la base de datos

    // Constructor de la clase
    public function __construct()
    {
        // Inicializa la instancia de BaseDatos en la propiedad $db
        $this->db = new BaseDatos();
    }

    // Métodos de acceso para la propiedad $usuarioId
    public function getUsuarioId(): int
    {
        return $this->usuarioId;
    }

    public function setUsuarioId(int $usuarioId): void
    {
        $this->usuarioId = $usuarioId;
    }

    // Métodos de acceso para la propiedad $titulo
    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): void
    {
        $this->titulo = $titulo;
    }

    // Métodos de acceso para la propiedad $id
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    // Métodos de acceso para la propiedad $categoriaId
    public function getCategoriaId(): int
    {
        return $this->categoriaId;
    }

    public function setCategoriaId(int $categoriaId): void
    {
        $this->categoriaId = $categoriaId;
    }

    // Métodos de acceso para la propiedad $descripcion
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    // Métodos de acceso para la propiedad $fecha
    public function getFecha(): string
    {
        return $this->fecha;
    }

    public function setFecha(string $fecha): void
    {
        $this->fecha = $fecha;
    }

    // Método para cerrar la conexión a la base de datos
    public function desconecta()
    {
        $this->db->close();
    }

    // Método para eliminar un registro
    public function delete()
    {
        // Obtiene el id del registro a eliminar
        $id = $this->getId();
        $result = false;

        // Intenta ejecutar la eliminación en la base de datos
        try {
            $ins = $this->db->prepara("DELETE FROM registros WHERE id = :id");
            $ins->bindValue(':id', $id);
            $ins->execute();
            $result = true;
        } catch (PDOException $error) {
            $result = false;
        }

        // Cierra el cursor y la conexión
        $ins->closeCursor();
        $ins = null;

        // Retorna el resultado
        return $result;
    }

    // Método para actualizar un registro
    public function update(): bool
    {
        // Obtiene los datos del registro
        $id = $this->getId();
        $categoriaId = $this->getCategoriaId();
        $usuarioId = $this->getUsuarioId();
        $titulo = $this->getTitulo();
        $descripcion = $this->getDescripcion();
        $fecha = $this->getFecha();
        $result = false;

        // Intenta ejecutar la actualización en la base de datos
        try {
            $ins = $this->db->prepara("UPDATE registros SET categoria_id = :categoriaId, usuario_id = :usuarioId, titulo = :titulo, descripcion = :descripcion, fecha = :fecha WHERE id = :id");

            $ins->bindValue(':id', $id);
            $ins->bindValue(':categoriaId', $categoriaId);
            $ins->bindValue(':usuarioId', $usuarioId);
            $ins->bindValue(':titulo', $titulo);
            $ins->bindValue(':descripcion', $descripcion);
            $ins->bindValue(':fecha', $fecha);

            $ins->execute();
            $result = true;
        } catch (PDOException $error) {
            $result = false;
        }

        // Cierra el cursor y la conexión
        $ins->closeCursor();
        $ins = null;

        // Retorna el resultado
        return $result;
    }

    // Método para crear un nuevo registro
    public function create(): bool
    {
        // Obtiene los datos del nuevo registro
        $id = NULL;
        $categoriaId = $this->getCategoriaId();
        $usuarioId = $this->getUsuarioId();
        $titulo = $this->getTitulo();
        $descripcion = $this->getDescripcion();
        $fecha = $this->getFecha();
        $result = false;

        // Intenta ejecutar la inserción en la base de datos
        try {
            $ins = $this->db->prepara("INSERT INTO registros (id, categoria_id, usuario_id, titulo, descripcion, fecha) VALUES (:id, :categoriaId, :usuarioId, :titulo, :descripcion, :fecha)");

            $ins->bindValue(':id', $id);
            $ins->bindValue(':categoriaId', $categoriaId);
            $ins->bindValue(':usuarioId', $usuarioId);
            $ins->bindValue(':titulo', $titulo);
            $ins->bindValue(':descripcion', $descripcion);
            $ins->bindValue(':fecha', $fecha);

            $ins->execute();
            $result = true;
        } catch (PDOException $error) {
            $result = false;
        }

        // Cierra el cursor y la conexión
        $ins->closeCursor();
        $ins = null;

        // Retorna el resultado
        return $result;
    }

    // Método estático para obtener todos los registros
    public static function getAll()
    {
        // Crea una nueva instancia de la clase Registro
        $registro = new Registro();

        // Realiza una consulta para obtener todos los registros ordenados por id
        $registro->db->consulta("SELECT * FROM registros ORDER BY id ASC;");

        // Extrae todos los resultados como un array
        $registros = $registro->db->extraer_todos();

        // Cierra la conexión a la base de datos
        $registro->db->close();

        // Retorna el array de registros
        return $registros;
    }

    // Método estático para buscar registros por categoría
    public static function buscarCat($categoriaId)
    {
        // Crea una nueva instancia de la clase Registro
        $registro = new Registro();

        // Prepara la sentencia SQL para la búsqueda por categoría
        $select = $registro->db->prepara("SELECT * FROM registros WHERE categoria_id = :categoriaId");

        // Asocia el parámetro :categoriaId con el valor proporcionado
        $select->bindValue(':categoriaId', $categoriaId, PDO::PARAM_INT);

        // Inicializa el resultado como falso
        $registros = false;

        // Intenta ejecutar la sentencia SQL
        try {
            $select->execute();

            // Obtiene los resultados como un array asociativo
            $registros = $select->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $err) {
            $registros = false;
        }

        // Cierra la conexión a la base de datos
        $registro->db->close();

        // Retorna el resultado
        return $registros;
    }

    // Método estático para buscar registros por título o descripción
    public static function buscarRegistros($buscar)
    {
        // Crea una nueva instancia de la clase Registro
        $registro = new Registro();

        // Prepara la sentencia SQL para la búsqueda por título o descripción
        $select = $registro->db->prepara("SELECT * FROM registros WHERE titulo LIKE :buscar OR descripcion LIKE :buscar");

        // Asocia el parámetro :buscar con el valor proporcionado
        $select->bindValue(':buscar', '%' . $buscar . '%', PDO::PARAM_STR);

        // Inicializa el resultado como falso
        $registros = false;

        // Intenta ejecutar la sentencia SQL
        try {
            $select->execute();

            // Obtiene los resultados como un array asociativo
            $registros = $select->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $err) {
            $registros = false;
        }

        // Cierra la conexión a la base de datos
        $registro->db->close();

        // Retorna el resultado
        return $registros;
    }

    // Método para buscar un registro por su id
    public function buscaId($id)
    {
        // Prepara la sentencia SQL para la búsqueda por id
        $select = $this->db->prepara("SELECT * FROM registros WHERE id=:id");
        $select->bindValue(':id', $id, PDO::PARAM_STR);

        // Inicializa el resultado como falso
        $result = false;

        // Intenta ejecutar la sentencia SQL
        try {
            $select->execute();

            // Verifica si se obtuvo un resultado y si hay una sola fila
            if ($select && $select->rowCount() == 1) {
                // Obtiene los datos como un array asociativo
                $result = $select->fetch(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $err) {
            $result = false;
        }

        // Retorna el resultado
        return $result;
    }

    // Método para validar los datos de un nuevo registro
    public function validarRegistro($titulo, $descripcion, $categoriaId)
    {
        $result = ['isValid' => true, 'errorTitulo' => '', 'errorDescripcion' => '', 'errorCategoria' => ''];

        // Validación del título
        if (empty($titulo)) {
            $result['isValid'] = false;
            $result['errorTitulo'] = 'El título no puede estar vacío';
        } else if (strlen($titulo) > 255) {
            $result['isValid'] = false;
            $result['errorTitulo'] = 'El título no puede tener más de 255 caracteres';
        } else if (!preg_match("/^[a-zA-Z0-9 !@#$%^&*()+=,.\\-]*$/", $titulo)) {
            $result['isValid'] = false;
            $result['errorTitulo'] = 'El título solo puede contener letras, números y espacios en blanco';
        }

        // Validación de la descripción
        if (empty($descripcion)) {
            $result['isValid'] = false;
            $result['errorDescripcion'] = 'La descripción no puede estar vacía';
        } else if (strlen($descripcion) > 255) {
            $result['isValid'] = false;
            $result['errorDescripcion'] = 'La descripción no puede tener más de 255 caracteres';
        } else if (!preg_match("/^[a-zA-Z0-9 !@#$%^&*()+=,.\\-]*$/", $descripcion)) {
            $result['isValid'] = false;
            $result['errorDescripcion'] = 'La descripción solo puede contener letras, números y espacios en blanco';
        }

        // Validación de la categoría
        if (empty($categoriaId)) {
            $result['isValid'] = false;
            $result['errorCategoria'] = 'La categoría no puede estar vacía';
        } else if (!is_numeric($categoriaId)) {
            $result['isValid'] = false;
            $result['errorCategoria'] = 'La categoría no es válida';
        }

        // Retorna el resultado de la validación
        return $result;
    }

    // Método para sanear el título de un registro
    public function sanearTitulo($titulo)
    {
        // Sanea el título utilizando FILTER_SANITIZE_STRING
        $titulo = filter_var($titulo, FILTER_SANITIZE_STRING);

        // Retorna el título saneado
        return $titulo;
    }

    // Método para sanear la descripción de un registro
    public function sanearDescripcion($descripcion)
    {
        // Sanea la descripción utilizando FILTER_SANITIZE_STRING
        $descripcion = filter_var($descripcion, FILTER_SANITIZE_STRING);

        // Retorna la descripción saneada
        return $descripcion;
    }

}
