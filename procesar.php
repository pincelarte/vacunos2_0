<?php
require_once "./php/Madre.php";
require_once "./DataBase/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $caravana = $_POST["caravana"];
    $tipo = $_POST["tipo"];
    $raza = $_POST["raza"];
    $edad = $_POST["edad"];
    $peso = $_POST["peso"];
    $historial = $_POST["historial"];
    $alta = new DateTime();

    switch ($tipo) {
        case "madre":
            $madre = new Madre($caravana, $tipo, $raza, $edad, $peso, $historial, $alta);
            $madre->guardarEnBD($pdo);
            $mensaje = "Madre agregada correctamente.";
            break;

        case "ternera":
        case "ternero":
        case "vaquillona":
        case "novillo":
        case "toro":
            $mensaje = "Falta implementar la lógica para este tipo de vacuno.";
            break;

        default:
            $mensaje = "Tipo de vacuno no válido.";
    }
    header("Location: index.php?mensaje=" . urlencode($mensaje));
    exit();
}
