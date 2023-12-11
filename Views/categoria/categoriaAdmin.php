<?php
// Se utiliza la clase Utils del namespace Utils
use Utils\Utils;

// Verifica si la sesión 'CategoriaAñadida' está seteada y su valor es 'complete'
if (isset($_SESSION['CategoriaAñadida']) && $_SESSION['CategoriaAñadida'] == 'complete'): ?>
    <strong>Categoria añadida correctamente</strong>
<?php 
// Verifica si la sesión 'CategoriaAñadida' está seteada y su valor es 'failed'
elseif (isset($_SESSION['CategoriaAñadida']) && $_SESSION['CategoriaAñadida'] == 'failed'):?>
    <strong>No se ha podido añadir</strong>
<?php endif;?>

<?php
// Elimina la sesión 'CategoriaAñadida' utilizando el método deleteSession de la clase Utils
Utils::deleteSession('CategoriaAñadida');?>

<?php
// Verifica si la sesión 'CategoriaActualizada' está seteada y su valor es 'complete'
if (isset($_SESSION['CategoriaActualizada']) && $_SESSION['CategoriaActualizada'] == 'complete'): ?>
    <strong>Categoria editada correctamente</strong>
<?php 
// Verifica si la sesión 'CategoriaActualizada' está seteada y su valor es 'failed'
elseif (isset($_SESSION['CategoriaActualizada']) && $_SESSION['CategoriaActualizada'] == 'failed'):?>
    <strong>No se ha podido editar la Categoria</strong>
<?php endif;?>

<?php
// Elimina la sesión 'CategoriaActualizada' utilizando el método deleteSession de la clase Utils
Utils::deleteSession('CategoriaActualizada');?>

<?php
// Verifica si la sesión 'CategoriaBorrada' está seteada y su valor es 'complete'
if (isset($_SESSION['CategoriaBorrada']) && $_SESSION['CategoriaBorrada'] == 'complete'): ?>
    <strong>Categoria borrada correctamente</strong>
<?php 
// Verifica si la sesión 'CategoriaBorrada' está seteada y su valor es 'failed'
elseif (isset($_SESSION['CategoriaBorrada']) && $_SESSION['CategoriaBorrada'] == 'failed'):?>
    <strong>No se ha podido borrar la Categoria</strong>
<?php endif;?>

<?php
// Elimina la sesión 'CategoriaBorrada' utilizando el método deleteSession de la clase Utils
Utils::deleteSession('CategoriaBorrada');?>


<?php
// Obtiene todas las categorías utilizando el método obtenerCategorias de la clase CategoriaController
$categorias = \Controllers\CategoriaController::obtenerCategorias() ?>

<a id="añadir" href="<?= BASE_URL ?>categoria/addCategory/">Añadir categoria</a>
<table>
    <?php
    // Recorre todas las categorías y las muestra en una tabla
    foreach ($categorias as $categoria):?>
        <tr>
            <td>
                <?php echo($categoria['id']);?>
            </td>
            <td>
                <?php echo($categoria['nombre']);?>
            </td>
            <td>
                <a href="<?= BASE_URL ?>categoria/editarCategoria/?id=<?= $categoria['id'] ?>">Editar</a>
                <a href="<?= BASE_URL ?>categoria/borrarCategoria/?id=<?= $categoria['id'] ?>">Eliminar</a>
            </td>
        </tr>
    <?php endforeach;?>
</table>
