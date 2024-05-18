<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configuración de la base de datos
$hostname = '212.227.231.241';
$username = 'unaibueno';
$password = 'Mejbef-6kinwo-sugxyb';
$database = 'mond_db';
$charset = 'utf8mb4';

// Crear una conexión
$mysqli = new mysqli($hostname, $username, $password, $database);

// Verificar la conexión
if ($mysqli->connect_error) {
    die(json_encode(['error' => 'Conexión fallida: ' . $mysqli->connect_error]));
}

// Establecer el charset
if (!$mysqli->set_charset($charset)) {
    die(json_encode(['error' => 'Error cargando el conjunto de caracteres utf8mb4: ' . $mysqli->error]));
}

$query = "SHOW TABLES"; // Sustituye "tu_tabla" con el nombre de tu tabla
$result = $mysqli->query($query);

if ($result) {
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Error en la consulta: ' . $mysqli->error]);
}

// Cerrar la conexión
$mysqli->close();
?>