<?php



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario animado de Vacunos</title>
    <link rel="stylesheet" href="../css/formAddVacun.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
</head>

<body>

    <form class="form" action="../procesar.php" method="POST">
        <h2>Agregar Vacuno</h2>
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
        <div class="button-container">
            <button type="submit" name="accion" value="agregar">Enviar</button>
            <a href="../index.php">
                <button type="button">Cancelar</button>
            </a>
        </div>
    </form>

</body>

</html>