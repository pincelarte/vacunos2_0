<?php
require_once "./php/Madre.php";
require_once "./DataBase/conexion.php";




//AGREGAR UN VACUNO DESDE EL SELECT HTML
if (isset($_POST['accion']) && $_POST['accion'] == 'agregar') {
    $caravana = $_POST["caravana"];
    $tipo = $_POST["tipo"];
    $raza = $_POST["raza"];
    $edad = $_POST["edad"] ? : null;
    $peso = $_POST["peso"] ? : null;
    $historial = $_POST["historial"] ? : null;
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

//ELIMINACION POR CARAVANA
if (isset($_POST['accion']) && $_POST['accion'] == 'eliminar') {
    $mensajeEliminacion = "Caravana recibida para eliminación: " . $caravana;
    $caravana = $_POST['caravanaEliminar'];
   

    if (Vacuno::eliminarVacuno($caravana)) {
        $mensajeEliminacion = "Vacuno con caravana " . $caravana . " eliminado correctamente.";
    } else {
        $mensajeEliminacion = "No se encontró el vacuno o hubo un error al eliminar.";
    }
    header("Location: index.php?mensaje=" . urlencode($mensajeEliminacion));
    exit();
}