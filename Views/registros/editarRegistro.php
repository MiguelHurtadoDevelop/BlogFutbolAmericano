<?php 
// Utiliza la clase Utils del espacio de nombres Utils
use Utils\Utils;
?>

<?php 
// Verifica si el Registro ha sido actualizado con éxito y muestra un mensaje correspondiente
if(isset($_SESSION['RegistroActualizado']) && $_SESSION['RegistroActualizado'] == 'complete'): ?>
    <strong>Registro editado correctamente</strong>
<?php elseif(isset($_SESSION['RegistroActualizado']) && $_SESSION['RegistroActualizado'] == 'failed'):?>
    <strong>No se ha podido editar el Registro</strong>
<?php endif;?>

<?php 
// Elimina la variable de sesión 'RegistroActualizado'
Utils::deleteSession('RegistroActualizado');
?>

<form action="<?= BASE_URL ?>registro/actualizarRegistro/" method="POST">
    <!-- Campo oculto para enviar el ID del registro -->
    <input type="hidden" name="registro[id]" value="<?=$registro['id']?>">
    
    <label for="titulo">Titulo</label>
    <!-- Muestra un campo de texto para el título del registro -->
    <input type="text" value="<?=$registro['titulo']?>" name="registro[titulo]" id="titulo" required>

    <?php 
    // Verifica si hay un mensaje de error para el título y lo muestra
    if(isset($_SESSION['errorTitulo'])):?>
        <strong><?=$_SESSION['errorTitulo']?></strong>
    <?php endif;?>
    
    <?php 
    // Elimina la variable de sesión 'errorTitulo'
    Utils::deleteSession('errorTitulo');
    ?>

    <label for="descripcion">Descripción</label>
    <!-- Muestra un área de texto para la descripción del registro -->
    <textarea  name="registro[descripcion]" id="descripcion"><?=$registro['descripcion']?></textarea>

    <?php 
    // Verifica si hay un mensaje de error para la descripción y lo muestra
    if(isset($_SESSION['errorDescripcion'])):?>
        <strong><?=$_SESSION['errorDescripcion']?></strong>
    <?php endif;?>
    
    <?php 
    // Elimina la variable de sesión 'errorDescripcion'
    Utils::deleteSession('errorDescripcion');
    ?>

    <label for="categoria">Categoría</label>
    <!-- Muestra un menú desplegable con las categorías disponibles -->
    <select id="categoria" name="registro[categoria_id]">
        <?php 
        // Itera sobre las categorías para mostrarlas en el menú desplegable
        foreach ($categorias as $categoria): ?>
            <option value="<?php echo $categoria['id']; ?>" 
            <?php 
            // Verifica si la categoría es la categoría del registro y la marca como seleccionada
            if ($categoria['id'] == $registro['categoria_id']) echo 'selected'; ?>>
            <?php echo $categoria['nombre']; ?>
        </option>
        <?php endforeach; ?>
    </select>

    <?php 
    // Verifica si hay un mensaje de error para la categoría y lo muestra
    if(isset($_SESSION['errorCategoria'])):?>
        <strong><?=$_SESSION['errorCategoria']?></strong>
    <?php endif;?>
    
    <?php 
    // Elimina la variable de sesión 'errorCategoria'
    Utils::deleteSession('errorCategoria');
    ?>

    <!-- Botón de envío del formulario -->
    <input type="submit" value="Editar Registro">
</form>

