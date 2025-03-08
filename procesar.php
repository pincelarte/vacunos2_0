<?php
require_once "./php/Madre.php";
require_once "./DataBase/conexion.php";
require_once "./php/Ternera.php";
require_once "./php/Toro.php";
require_once "./php/Ternero.php";
require_once "./php/Vaquillona.php";
require_once "./php/Novillo.php";





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
            $ternera = new Ternera($caravana, $tipo, $raza, $edad, $peso, $historial, $alta);
            $ternera->guardarEnBD($pdo);
            $mensaje = "Ternera agregada correctamente.";
            break;

        case "vaquillona":
            $vaquillona = new Vaquillona($caravana, $tipo, $raza, $edad, $peso, $historial, $alta);
            $vaquillona->guardarEnBD($pdo);
            $mensaje = "Vaquillona agregada correctamente.";
            break;

        case "novillo":
            $novillo = new Novillo($caravana, $tipo, $raza, $edad, $peso, $historial, $alta);
            $novillo->guardarEnBD($pdo);
            $mensaje = "Novillo agregado correctamente.";
            break;

        case "toro":
            $toro = new Toro($caravana, $tipo, $raza, $edad, $peso, $historial, $alta);
            $toro->guardarEnBD($pdo);
            $mensaje = "Toro agregado correctamente.";
            break;

        case "ternero":
            $ternero = new Ternero($caravana, $tipo, $raza, $edad, $peso, $historial, $alta);
            $ternero->guardarEnBD($pdo);
            $mensaje = "Ternero agregado correctamente.";
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