<?php
use Utils\Utils;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
?>

<?php
// Muestra mensajes relacionados con la adición de registros
if (isset($_SESSION['RegistroAñadido'])):
    if ($_SESSION['RegistroAñadido'] == 'complete'): ?>
        <strong>Registro añadido correctamente</strong>
    <?php elseif ($_SESSION['RegistroAñadido'] == 'failed'): ?>
        <strong>No se ha podido añadir el registro</strong>
    <?php endif;
    // Elimina la variable de sesión 'RegistroAñadido'
    Utils::deleteSession('RegistroAñadido');
endif;
?>

<?php
// Muestra mensajes relacionados con la actualización de registros
if (isset($_SESSION['RegistroActualizado'])):
    if ($_SESSION['RegistroActualizado'] == 'complete'): ?>
        <strong>Registro editado correctamente</strong>
    <?php elseif ($_SESSION['RegistroActualizado'] == 'failed'): ?>
        <strong>No se ha podido editar el registro</strong>
    <?php endif;
    // Elimina la variable de sesión 'RegistroActualizado'
    Utils::deleteSession('RegistroActualizado');
endif;
?>

<?php
// Obtiene el ID de la categoría desde $_GET o establece $categoriaId a null si no está presente
$categoriaId = isset($_GET['categoriaId']) ? $_GET['categoriaId'] : null;

// Determina qué función llamar en base a la existencia de la categoríaId en $_GET
if ($categoriaId !== null) {
    $registros = \Controllers\RegistroController::obtenerRegistrosCat($categoriaId);
} elseif (isset($buscar) && $buscar == 'true') {
    $registros = $registrosEncontrados;
} else {
    $registros = \Controllers\RegistroController::obtenerRegistros();
}

// Crea un adaptador de array
$adapter = new ArrayAdapter($registros);

// Crea el objeto Pagerfanta
$pagerfanta = new Pagerfanta($adapter);

$pagerfanta->setMaxPerPage(4);

// Establece la página actual
$pagerfanta->setCurrentPage(isset($_GET['page']) ? $_GET['page'] : 1);

// Obtiene los registros para la página actual
$registrosParaLaPaginaActual = $pagerfanta->getCurrentPageResults();
?>

<?php
// Muestra el enlace para añadir un nuevo registro si el usuario ha iniciado sesión
if (isset($_SESSION['login'])): ?>
    <a id="añadir" href="<?= BASE_URL ?>Registro/addRegistro/">Añadir registro</a>
<?php endif; ?>

<?php
// Muestra los registros para la página actual
foreach ($registrosParaLaPaginaActual as $registro): ?>
    <div id="registro">
        <h2>
            <?php echo $registro['titulo']; ?>
        </h2>
        <p>
            <?php echo $registro['descripcion']; ?>
        </p>
        <p>
            <?php
            // Muestra enlaces de edición y eliminación si el usuario ha iniciado sesión y es el propietario o es un administrador
            if (isset($_SESSION['login']) && (($registro['usuario_id'] == $_SESSION['login']->id) || ($_SESSION['login']->rol == 'admin'))):?>
                <a href="<?= BASE_URL ?>Registro/editarRegistro/?id=<?= $registro['id'] ?>">Editar</a>
                <a href="<?= BASE_URL ?>Registro/borrarRegistro/?id=<?= $registro['id'] ?>">Eliminar</a>
            <?php endif;?>
        </p>
    </div>
<?php endforeach; ?>

<!-- Genera enlaces de paginación -->
<div class="pagination">
    <?php for ($i = 1; $i <= $pagerfanta->getNbPages(); $i++): ?>
        <a href="?page=<?= $i ?>"><?= $i ?></a>
    <?php endfor; ?>
</div>


<!-- Formulario de búsqueda -->
<form method="post" action="<?= BASE_URL ?>registro/buscarRegistros/">
    <label for="buscar">Buscar</label>
    <input type="text" id="buscar" name="buscar">
    <input type="submit" value="Buscar">
</form>
