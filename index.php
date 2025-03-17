<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "./php/AbstractVacuno.php";
require_once "./php/Madre.php";
require_once "./DataBase/conexion.php";

$sql = "SELECT * FROM vacunos order by alta desc";
$stmt = $pdo->query($sql);
$mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : '';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor Ganadero</title>
    <link rel="stylesheet" href="style.css">



</head>

<body>
    <div class="container">

        <header class="header">
            <p><?php echo $mensajeConexion; ?></p>
            <p><?php echo $mensaje; ?></p>
        </header>
        <nav class="navbar">

            <a href="./secciones/formAddVacun.php">
                <button type="button">Agregar Vacuno</button>
            </a>
            <a href="./secciones/listarVacuno.php">
                <button type="button">Listar Vacunos</button>
            </a>



        </nav>
        <main class="main">
            <h1>Lista de Vacunos</h1>
            <div class="tag-container">
                <?php
                while ($row = $stmt->fetch()) {
                    
                    echo "<div class='vacuno-tag'>";
                    echo "<span class='tag-item'><strong>Caravana:</strong> " . $row['caravana'] . "</span>";
                    echo "<span class='tag-item'><strong>Tipo:</strong> " . $row['tipo'] . "</span>";
                    echo "<span class='tag-item'><strong>Raza:</strong> " . $row['raza'] . "</span>";
                    echo "<span class='tag-item'><strong>Edad:</strong> " . $row['edad'] . "</span>";
                    echo "<span class='tag-item'><strong>Peso:</strong> " . $row['peso'] . "</span>";
                    echo "<span class='tag-item'><strong>Alta:</strong> " . $row['alta'] . "</span>";

                    echo "<div class='view-historial-button'>
                              <a href='?caravana=" . $row['caravana'] . "'>
                             <button type='button'>Historial</button>
                              </a>
                          </div>";

                    // Botón de eliminación
                    echo "<div class='delete-form'>
                             <form action='procesar.php' method='POST'>
                                <input type='hidden' name='caravanaEliminar' value='" . $row['caravana'] . "'>
                                <button type='submit' name='accion' value='eliminar'>Eliminar</button>
                             </form>
                         </div>";

                    echo "</div>"; // Separador entre vacunos
                }
                ?>
            </div>
        </main>





        <aside class="aside">
            <!--
            <form action="procesar.php" method="POST">
                <label for="caravanaEliminar"></label>
                <input type="text" name="caravanaEliminar" id="caravanaEliminar" placeholder="Ingrese la Caravana" required>
                <button type="submit" name="accion" value="eliminar">Eliminar</button>
            </form> 
            -->
            <?php
            if (isset($_GET['caravana'])) {
                // Obtener el vacuno seleccionado por caravana
                $caravanaSeleccionada = $_GET['caravana'];
                $sqlDetalle = "SELECT * FROM vacunos WHERE caravana = :caravana";
                $stmtDetalle = $pdo->prepare($sqlDetalle);
                $stmtDetalle->execute([':caravana' => $caravanaSeleccionada]);

                // Mostrar los detalles del vacuno
                if ($rowDetalle = $stmtDetalle->fetch()) {
                    echo "<h2>Detalles de la Caravana: " . $rowDetalle['caravana'] . "</h2>";
                    echo "<form action='procesar.php' method='POST'>";
                    echo "<label for='historial'>Historial:</label>";
                    echo "<textarea name='historial' id='historial' rows='5'>" . $rowDetalle['historial'] . "</textarea>";
                    echo "<input type='hidden' name='caravana' value='" . $rowDetalle['caravana'] . "'>";
                    echo "<button type='submit' name='accion' value='modificarHistorial'>Actualizar Historial</button>";
                    echo "</form>";
                }
            }
            ?>
        </aside>
        <footer class="footer">FOOTER</footer>





    </div>
</body>

</html>