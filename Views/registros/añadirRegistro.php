<?php 
// Utiliza la clase Utils del espacio de nombres Utils
use Utils\Utils;
?>

<?php 
// Verifica si el Registro ha sido añadido con éxito y muestra un mensaje correspondiente
if(isset($_SESSION['RegistroAñadido']) && $_SESSION['RegistroAñadido'] == 'complete'): ?>
    <strong>Registro añadido correctamente</strong>
<?php elseif(isset($_SESSION['RegistroAñadido']) && $_SESSION['RegistroAñadido'] == 'failed'):?>
    <strong>No se ha podido añadir el Registro</strong>
<?php endif;?>

<?php 
// Elimina la variable de sesión 'RegistroAñadido'
Utils::deleteSession('RegistroAñadido');
?>

<form action="<?= BASE_URL ?>registro/AnadirRegistro/" method="POST">
    
    <label for="titulo">Titulo</label>
    <!-- Muestra un campo de texto para el título del registro -->
    <input type="text" value="<?php if(isset($registro)){ echo $registro['titulo'];}?>" name="registro[titulo]" id="titulo" required>

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
    <textarea  name="registro[descripcion]" id="descripcion"><?php if(isset($registro)){ echo $registro['descripcion'];}?></textarea>

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
                // Verifica si se está editando un registro y marca la categoría seleccionada
                if(isset($registro)){
                    if ($categoria['id'] == $registro['categoria_id']) echo 'selected';
                }
                ?>>
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
    <input type="submit" value="Añadir Registro">
</form>
