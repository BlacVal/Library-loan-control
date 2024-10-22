<?php
// Datos de conexión
$host = "localhost";
$database = "login_register_db";
$user = "root";
$password = "";

// Conexión a la base de datos
$conexion = mysqli_connect($host, $user, $password, $database);

/*/ Verificar la conexión
if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully";
}
/*/
?>