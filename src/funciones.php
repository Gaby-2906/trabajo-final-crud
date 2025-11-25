<?php
// Incluye la conexión para usar la variable $pdo
require_once __DIR__ . '/../config/conexion.php';

// Las variables globales son accesibles dentro de las funciones
// ya que $pdo está fuera del alcance de la función.

function crearProducto($nombre, $descripcion, $precio, $stock) {
    global $pdo; 
    try {
        $sql = "INSERT INTO productos (nombre, descripcion, precio, stock) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre, $descripcion, $precio, $stock]);
        return true;
    } catch (PDOException $e) {
        // En un entorno real, se debería loggear el error, no imprimirlo
        return false;
    }
}

function obtenerProductos() {
    global $pdo;
    $sql = "SELECT * FROM productos ORDER BY id DESC";
    $stmt = $pdo->query($sql);
    // Retorna un Array de Arrays Asociativos
    return $stmt->fetchAll(); 
}

function obtenerProductoPorId($id) {
    global $pdo;
    $sql = "SELECT * FROM productos WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function actualizarProducto($id, $nombre, $descripcion, $precio, $stock) {
    global $pdo;
    try {
        $sql = "UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, stock = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre, $descripcion, $precio, $stock, $id]);
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

function eliminarProducto($id) {
    global $pdo;
    try {
        $sql = "DELETE FROM productos WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return true;
    } catch (PDOException $e) {
        return false;
    }
}
?>