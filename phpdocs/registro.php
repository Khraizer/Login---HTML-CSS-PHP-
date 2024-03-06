<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "amp";

// Crear conexión
$conexion = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Obtener datos del formulario
$Nombre = $_POST['user'];
$Contraseña = $_POST['pass'];

$hashContrasena = password_hash($contrasena, PASSWORD_BCRYPT);

// Consulta SQL para insertar los datos del nuevo usuario
$insert = "INSERT INTO usuarios (Nombre, Contra) VALUES ('$Nombre','$hashContrasena')";

if ($conexion->query($insert) === TRUE) {
    echo "Registro exitoso. Bienvenido, $nombre!";
} else {
    echo "Error al registrar usuario: " . $conn->error;
}

// Cerrar conexión
$conn->close();
?>