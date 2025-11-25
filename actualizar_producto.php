<?php
// Controlador/Vista para actualizar un producto
require_once 'src/funciones.php'; 

// 1. Obtener el ID del producto de la URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Si no hay ID válido, redirige a la página principal
    header('Location: index.php'); 
    exit;
}

$id_producto = (int)$_GET['id'];
$producto = obtenerProductoPorId($id_producto); // Obtiene el producto

if (!$producto) {
    die("Error: Producto con ID $id_producto no encontrado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        form { padding: 15px; border: 1px solid #ccc; max-width: 400px; }
        label, input, textarea, button, a { display: block; margin-bottom: 10px; }
        input[type="text"], input[type="number"], textarea { width: 90%; padding: 8px; border: 1px solid #ccc; }
        .cancel-link { margin-top: 15px; text-decoration: none; color: #007bff; display: inline; }
    </style>
</head>
<body>

    <h1>Editar Producto: <?php echo htmlspecialchars($producto['nombre']); ?></h1>
    
    <form action="index.php" method="POST">
        <input type="hidden" name="accion" value="actualizar">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($producto['id']); ?>">
        
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>
        
        <label>Descripción:</label>
        <textarea name="descripcion"><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>
        
        <label>Precio:</label>
        <input type="number" name="precio" step="0.01" value="<?php echo htmlspecialchars($producto['precio']); ?>" required>
        
        <label>Stock:</label>
        <input type="number" name="stock" value="<?php echo htmlspecialchars($producto['stock']); ?>" required>
        
        <button type="submit">Guardar Cambios</button>
        <a href="index.php" class="cancel-link">Cancelar y Volver al Listado</a>
    </form>

</body>
</html>