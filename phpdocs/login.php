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
$Contrasena = $_POST['pass'];


$sql = "SELECT Contra FROM usuarios WHERE Nombre = '$Nombre'";
$resultado = $conexion->query($sql);

if($resultado->num_rows > 0){
    echo "Inicio de Sesion Exitoso";
} else {
    echo "Inicio de Sesion Fallido";
}

// Cerrar conexión
$conexion->close();
?>