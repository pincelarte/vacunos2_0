<?php



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Aquí podrías procesar los datos, guardarlos en la base de datos, etc.

    // Redirigir de vuelta a index.php después de enviar
    header("Location: index.php");
    exit(); // Asegurar que el script se detiene después de la redirección
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Vacunos</title>
    <link rel="stylesheet" href="styles.css"> <!-- Opcional si usas CSS externo -->
</head>

<body>

    <nav class="navbar">
        <a href="index.php">Volver al inicio</a>
    </nav>

    <form action="../procesar.php" method="POST">
        <label for="tipo"></label>
        <select name="tipo" id="tipo" required>
            <option value="" disabled selected>Seleccione un tipo</option>
            <option value="ternera">Ternera</option>
            <option value="ternero">Ternero</option>
            <option value="vaquillona">Vaquillona</option>
            <option value="novillo">Novillo</option>
            <option value="madre">Madre</option>
            <option value="toro">Toro</option>
        </select>

        <label for="caravana"></label>
        <input type="text" name="caravana" id="caravana" placeholder="Caravana" required>

        <label for="raza"></label>
        <select name="raza" id="raza" required>
            <option value="" disabled selected>Seleccione una raza</option>
            <option value="aberdeen angus">Aberdeen Angus</option>
            <option value="hereford">Hereford</option>
            <option value="shorton">Shorton</option>
            <option value="holando argentino">Holando Argentino</option>
            <option value="charolais">Charolais</option>
            <option value="limousin">Limousin</option>
        </select>

        <label for="edad"></label>
        <input type="number" name="edad" id="edad" placeholder="Edad">

        <label for="peso"></label>
        <input type="number" name="peso" id="peso" placeholder="Peso">

        <label for="historial"></label>
        <textarea name="historial" id="historial" placeholder="Comentarios"></textarea>

        <button type="submit" name="accion" value="agregar">Enviar</button>
    </form>

</body>

</html>