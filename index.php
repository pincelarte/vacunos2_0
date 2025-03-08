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



        </nav>
        <main class="main">
            <h1>Lista de Vacunos</h1>
            <?php
            while ($row = $stmt->fetch()) {
                echo "<p>Caravana: " . $row['caravana'] . "</p>";
                echo "<p>Tipo: " . $row['tipo'] . "</p>";
                echo "<p>Raza: " . $row['raza'] . "</p>";
                echo "<p>Edad: " . $row['edad'] . "</p>";
                echo "<p>Peso: " . $row['peso'] . "</p>";
                echo "<p>Historial: " . $row['historial'] . "</p>";
                echo "<p>Alta: " . $row['alta'] . "</p><hr>";
            }
            ?>

        </main>

        <aside class="aside">
            <form action="procesar.php" method="POST">
                <label for="caravanaEliminar"></label>
                <input type="text" name="caravanaEliminar" id="caravanaEliminar" placeholder="Ingrese la Caravana" required>
                <button type="submit" name="accion" value="eliminar">Eliminar</button>
            </form>

        </aside>
        <footer class="footer">FOOTER</footer>





    </div>
</body>

</html>