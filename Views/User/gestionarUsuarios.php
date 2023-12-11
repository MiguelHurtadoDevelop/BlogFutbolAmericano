<?php
use Utils\Utils;
?>

<?php
// Muestra mensajes relacionados con la adición de categorías
if(isset($_SESSION['CategoriaAñadida']) && $_SESSION['CategoriaAñadida'] == 'complete'): ?>
    <strong>Categoría añadida correctamente</strong>
<?php elseif(isset($_SESSION['CategoriaAñadida']) && $_SESSION['CategoriaAñadida'] == 'failed'):?>
    <strong>No se ha podido añadir la categoría</strong>
<?php endif;
// Elimina la variable de sesión 'CategoriaAñadida'
Utils::deleteSession('CategoriaAñadida');
?>

<?php
// Obtiene la lista de usuarios desde el controlador
$usuarios = \Controllers\UserController::obtenerUsuarios();
?>

<table>
    <?php foreach ($usuarios as $usuario):?>
        <tr>
            <td>
                <?php echo($usuario['id']);?>
            </td>
            <td>
                <?php echo($usuario['nombre']);?>
            </td>
            <td>
                <?php echo($usuario['rol']);?>
            </td>
            <td>
                <!-- Enlace para hacer a un usuario administrador -->
                <a href="<?=BASE_URL?>user/hacerAdmin/?id=<?=$usuario['id']?>">Hacer Administrador</a>
            </td>
        </tr>
    <?php endforeach;?>
</table>

