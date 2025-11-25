<?php
// Controlador Principal
require_once 'src/funciones.php'; // Incluye las funciones CRUD

// 1. Manejar acciones POST (CREATE)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['accion']) && $_POST['accion'] === 'crear') {
        $nombre = $_POST['nombre'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $precio = (float)($_POST['precio'] ?? 0);
        $stock = (int)($_POST['stock'] ?? 0);
        
        crearProducto($nombre, $descripcion, $precio, $stock);
        
        // Redirigir para evitar reenvío de formulario
        header('Location: index.php');
        exit;
    }
    // La acción 'actualizar' se manejará en este index si viene de actualizar_producto.php
    if (isset($_POST['accion']) && $_POST['accion'] === 'actualizar') {
        $id = (int)($_POST['id'] ?? 0);
        $nombre = $_POST['nombre'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $precio = (float)($_POST['precio'] ?? 0);
        $stock = (int)($_POST['stock'] ?? 0);
        
        actualizarProducto($id, $nombre, $descripcion, $precio, $stock);
        
        header('Location: index.php');
        exit;
    }
} 

// 2. Manejar acción GET (DELETE)
if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
    eliminarProducto((int)$_GET['id']);
    header('Location: index.php');
    exit;
}

// 3. Obtener datos para la vista (READ)
$productos = obtenerProductos(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD de Productos</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .btn-edit { background-color: #ffc107; color: #333; padding: 5px; text-decoration: none; display: inline-block;}
        .btn-delete { background-color: #dc3545; color: white; padding: 5px; text-decoration: none; display: inline-block;}
        fieldset { margin-bottom: 20px; padding: 15px; border: 1px solid #ccc; max-width: 500px; }
        label, input, textarea, button { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="number"], textarea { width: 95%; padding: 8px; border: 1px solid #ccc; }
    </style>
</head>
<body>

    <h1>Gestión de Productos</h1>
    
    <fieldset>
        <legend>Añadir Nuevo Producto</legend>
        <form action="index.php" method="POST">
            <input type="hidden" name="accion" value="crear">
            <label>Nombre:</label><input type="text" name="nombre" required>
            <label>Descripción:</label><textarea name="descripcion"></textarea>
            <label>Precio:</label><input type="number" name="precio" step="0.01" required>
            <label>Stock:</label><input type="number" name="stock" required>
            <button type="submit">Guardar Producto</button>
        </form>
    </fieldset>

    <h2>Lista de Productos</h2>
    
    <table>
        <thead>
            <tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Stock</th><th>Acciones</th></tr>
        </thead>
        <tbody>
            <?php 
            // Bucle foreach para recorrer el Array de Productos
            if (count($productos) > 0): 
                foreach ($productos as $producto): // Array Asociativo
            ?>
                    <tr>
                        <td><?php echo htmlspecialchars($producto['id']); ?></td>
                        <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                        <td>$<?php echo htmlspecialchars(number_format($producto['precio'], 2)); ?></td>
                        <td><?php echo htmlspecialchars($producto['stock']); ?></td>
                        <td>
                            <a href="actualizar_producto.php?id=<?php echo $producto['id']; ?>" class="btn-edit">Editar</a>
                            <a href="index.php?accion=eliminar&id=<?php echo $producto['id']; ?>" class="btn-delete" onclick="return confirm('¿Eliminar <?php echo htmlspecialchars($producto['nombre']); ?>?');">Eliminar</a>
                        </td>
                    </tr>
            <?php 
                endforeach; 
            else: ?>
                 <tr><td colspan="5">No hay productos registrados.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>