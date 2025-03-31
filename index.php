<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

setlocale(LC_TIME, "es_ES.UTF-8");

require_once "./php/AbstractVacuno.php";
require_once "./php/Madre.php";
require_once "./DataBase/conexion.php";




$tipoVacuno = isset($_GET['tipo']) ? $_GET['tipo'] : '';
if ($tipoVacuno) {
    $sql = "SELECT * FROM vacunos WHERE tipo = :tipo ORDER BY alta DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':tipo' => $tipoVacuno]);
} else {
    $sql = "SELECT * FROM vacunos ORDER BY alta DESC";
    $stmt = $pdo->query($sql);
}

$mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : '';

session_start();
ob_start();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor Ganadero</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header class="header border-relieve">
            <p><?php echo $mensajeConexion; ?></p>
            <p><?php echo $mensaje; ?></p>
        </header>

        <nav class="navbar border-relieve">
            <a href="./secciones/formAddVacun.php">
                <button>Agregar Vacuno</button>
            </a>
            <a href="index.php"><button>Todos</button></a>
            <div class="filtros-tipo-vacuno">
                <a href="index.php?tipo=ternera"><button>Terneras</button></a>
                <a href="index.php?tipo=ternero"><button>Terneros</button></a>
                <a href="index.php?tipo=vaquillona"><button>Vaquillonas</button></a>
                <a href="index.php?tipo=novillo"><button>Novillos</button></a>
                <a href="index.php?tipo=madre"><button>Madres</button></a>
                <a href="index.php?tipo=toro"><button>Toros</button></a>
            </div>
        </nav>




        <main class="main border-relieve">
            <h1>
                <?php
                if ($tipoVacuno) {
                    echo "Lista de " . ucfirst($tipoVacuno) . "s";
                } else {
                    echo "Lista de Vacunos";
                }
                ?>
            </h1>
            <div class="tag-container">
                <?php
                while ($row = $stmt->fetch()) {
                    echo "<div class='vacuno-tag'>";
                    echo "<span class='tag-item'><strong>Caravana:</strong> " . $row['caravana'] . "</span>";
                    echo "<span class='tag-item'><strong>Tipo:</strong> " . $row['tipo'] . "</span>";
                    echo "<span class='tag-item'><strong>Raza:</strong> " . $row['raza'] . "</span>";
                    echo "<span class='tag-item'><strong>Edad:</strong> " . $row['edad'] . "</span>";
                    echo "<span class='tag-item'><strong>Peso:</strong> " . $row['peso'] . "</span>";
                    echo "<span class='tag-item'><strong>Alta:</strong> " . date("d F Y", strtotime($row['alta'])) . "</span>";

                    echo "<div class='buttons-container'>";

                    $urlTipo = $tipoVacuno ? "&tipo=" . urlencode($tipoVacuno) : "";

                    echo "<div class='button'>
                            <a>
                                <button type='button'>Modificar</button>
                            </a>
                          </div>";
                    echo "<div class='button'>
                            <a href='index.php?caravana=" . $row['caravana'] . "&accion=historial" . $urlTipo . "'>
                                <button type='button'>Historial</button>
                            </a>
                          </div>";
                    
                    echo "<div class='button'>
                            <a href='index.php?caravana=" . $row['caravana'] . "&accion=eliminar" . $urlTipo . "'>
                                <button type='button'>Eliminar</button>
                            </a>
                          </div>";

                    echo "</div>"; // Cierre de buttons-container
                    echo "</div>"; // Cierre de vacuno-tag
                }
                ?>
            </div>
        </main>

        <aside class="aside border-relieve">
            <?php
            if (isset($_GET['caravana']) && isset($_GET['accion'])) {
                $caravanaSeleccionada = $_GET['caravana'];
                $accion = $_GET['accion']; // Detecta si es "historial" o "eliminar"

                // Si la acción es "eliminar", muestra la confirmación
                if ($accion === "eliminar") {
                    echo "<div class='confirmacion-eliminacion'>
                            <h3>¿Seguro de eliminar a $caravanaSeleccionada?</h3>
                            <form action='procesar.php' method='POST'>
                                <input type='hidden' name='caravanaEliminar' value='" . $caravanaSeleccionada . "'>
                            <div class='button-aside'>   
                                <button type='submit' name='accion' value='eliminar'>Eliminar</button>
                                <a href='index.php'>
                                    <button type='button'>Cancelar</button>
                                </a>
                            </div>    
                            </form>
                          </div>";
                }
                // Si la acción es "historial", muestra la edición del historial
                elseif ($accion === "historial") {
                    $sqlDetalle = "SELECT * FROM vacunos WHERE caravana = :caravana";
                    $stmtDetalle = $pdo->prepare($sqlDetalle);
                    $stmtDetalle->execute([':caravana' => $caravanaSeleccionada]);

                    if ($rowDetalle = $stmtDetalle->fetch()) {
                        echo "<h3>Detalles de caravana: Nº " . $rowDetalle['caravana'] . "</h2>";

                        echo "<form action='procesar.php' method='POST'>";
                        echo "<label for='historial'>Historial:</label>";
                        echo "<textarea name='historial' id='historial' rows='5'>" . $rowDetalle['historial'] . "</textarea>";
                        echo "<input type='hidden' name='caravana' value='" . $rowDetalle['caravana'] . "'>";

                        echo "<div class='button-aside'>";
                        echo "<button type='submit' name='accion' value='modificarHistorial'>Actualizar</button>";
                        echo "<a href='index.php'>
                                <button type='button'>Cerrar</button>
                              </a> ";
                        echo "</div>";

                        echo "</form>";
                    }
                }
            }
            ?>
        </aside>

        <footer class="footer border-relieve">FOOTER</footer>
    </div>
</body>

</html>