<?php
// Define las constantes de conexión
define('DB_HOST', 'localhost');
define('DB_USER', 'root');   // <-- ¡Verifica tu usuario de MySQL!
define('DB_PASS', '');       // <-- ¡Verifica tu contraseña (vacía si usas XAMPP por defecto)!
define('DB_NAME', 'crud_db');

try {
    // Crea una instancia de PDO
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
    
    // Configura el modo de error para que PDO lance excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Mensaje de error si la conexión falla
    // En un entorno real, no mostrarías $e->getMessage() al usuario
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>