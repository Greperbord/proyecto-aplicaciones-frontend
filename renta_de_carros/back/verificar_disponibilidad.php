<?php
// Conexión a la base de datos
$conexion = new mysqli('localhost:8889', 'root', 'root', 'renta_carros');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta SQL para obtener la disponibilidad de los carros
$sql = "SELECT id, disponibilidad FROM autos";
$resultado = $conexion->query($sql);

$carros = [];
if ($resultado->num_rows > 0) {
    while($row = $resultado->fetch_assoc()) {
        $carros[] = $row;
    }
}

// Devuelve el resultado como JSON
echo json_encode($carros);

// Cierra la conexión a la base de datos
$conexion->close();
?>