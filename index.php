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
        <nav class="navbar">NAVBAR</nav>
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
            <form action="procesar.php" method="POST">
                <label for="accion">Agregue un vacuno</label>
                <select name="tipo" id="tipo" required>
                    <option value="" disabled selected>Seleccione un tipo</option>
                    <option value="ternera">Ternera</option>
                    <option value="ternero">Ternero</option>
                    <option value="vaquillona">Vaquillona</option>
                    <option value="novillo">Novillo</option>
                    <option value="madre">Madre</option>
                    <option value="toro">Toro</option>
                </select>
                <label for="caravana">Caravana:</label>
                <input type="text" name="caravana" id="caravana" required>
                <label for="raza">Raza:</label>
                <select name="raza" id="raza" required>
                    <option value="" disabled selected>Seleccione una raza</option>
                    <option value="aberdeen angus">Aberdeen Angus</option>
                    <option value="hereford">Hereford</option>
                    <option value="shorton">Shorton</option>
                    <option value="holando argentino">Holando Argentino</option>
                    <option value="charolais">Charolais</option>
                    <option value="limousin">Limousin</option>
                </select>
                <label for="edad">Edad:</label>
                <input type="number" name="edad" id="edad">
                <label for="peso">Peso:</label>
                <input type="number" name="peso" id="peso">
                <label for="historial">Historial:</label>
                <textarea name="historial" id="historial"></textarea>



                <button type="submit" name="accion" value="agregar">Enviar</button>
            </form>
        </main>

        <aside class="aside">
            ASIDE
            <form action="procesar.php" method="POST">
                <label for="caravanaEliminar">Caravana a eliminar:</label>
                <input type="text" name="caravanaEliminar" id="caravanaEliminar" required>
                <button type="submit" name="accion" value="eliminar">Eliminar</button>
            </form>

        </aside>
        <footer class="footer">FOOTER</footer>





    </div>
</body>

</html>