<?php 
include_once "connection.php";

$select = "SELECT * FROM  mensaje";

$select_prepare = $conn->prepare($select);
$select_prepare->execute();

$resultado_select = $select_prepare->fetchAll();

if ($_POST) {
    var_dump($_POST);

    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $estado = $_POST["estado"];
    

    $insert = "INSERT INTO (nombre, descripcion, estado, fecha_modificacion) VALUES (?, ?, ?, NOW())";
    $insert_prepare = $conn->prepare($insert);
    $insert_prepare->execute([$nombre, $descripcion,$estado,$color[$color_user]]);


    $insert_prepare = null;
    $conn = null;

    header('location:index.php');
}

?>



<!-- ==================================================== -->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<header>
    <h1>Lista de tareas</h1>
</header>

<main>
    <section>
        <?php foreach ($resultado_select as $row) : ?>
        <div class="flex-column">
             <h2><?php echo $row['nombre'];?></h2>
             <p><?php echo $row['descripcion'];?></p>
        </div>
        <div>
            <a href="delete.php?id=<?= $row["ID"] ?>">❌</a>
         </div>
         <?php endforeach ?>
    </section>

    <section class="flex-container">
        <form method="GET">
            <legend>Añade informacion sobre tu tarea</legend>
            <div>
                <label for="usuario">Nombre del usuario :</label>
                <input type="text" id="usuario" name="nombre">
            </div>
            <div>
                <label for="">Ingrese su tarea pendiente</label>
                <input type="textarea">
            </div>
            <div class="gap">
                <button type="submit" class="cl-red">Submit</button>
                <button type="reset" class="cl-blue">Borrar</button>
            </div>
        </form>
    </section>
</main>


</body>
</html>
