<?php 
include_once "connection.php";

$select = "SELECT * FROM  to_do";

$select_prepare = $conn->prepare($select);
$select_prepare->execute();

$resultado_select = $select_prepare->fetchAll();

if ($_POST) {
    var_dump($_POST);
    $nombre = $_POST["nombre"];
    $mensaje = $_POST["mensaje"];
    $estado = $_POST["estado"];
 

    $insert = "INSERT INTO to_do(nombre, mensaje, estado) VALUES (?, ?, ?)";
    $insert_prepare = $conn->prepare($insert);
    $insert_prepare->execute([$nombre, $mensaje, $estado]);
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
    <section class="flex-column">
        <?php foreach ($resultado_select as $row) : ?>
            <article>
                <div>
                    <h2><?= $row['nombre']; ?></h2>
                    <p><?= $row['mensaje']; ?></p>
                    <p>estado: <?= $row['estado']; ?></p>
                    <p>Fecha creación: <?= $row['fecha_imi']; ?></p>
                </div>
                <div>
                    <a href="delete.php?id=<?= $row["id"] ?>">❌</a>
                </div>               
            </article>
        <?php endforeach ?>
    </section>

    <section class="flex-container">
        <form method="POST">
            <legend>Añade informacion sobre tu tarea:</legend>
            <div>
                <label for="nombre">Nombre del usuario :</label>
                <input type="text" id="nombre" name="nombre">
            </div>
            <div>
                <label for="mensaje">Ingrese su tareA pendiente</label>
                <input type="textarea" id="mensaje" name="mensaje" >
            </div>
            <div>
                <label for="estado">Estado:</label>
                <select name="estado" id="estado">
                    <option value="Urgente" <?php  echo "selected" ?>>Urgente</option>
                    <option value="Pendiente" <?php  echo "selected" ?>>Pendiente</option>
                    <option value="Ejecuando" <?php echo "selected" ?>>Ejecutando</option>
                    <option value="Finalizando" <?php  echo "selected" ?>>Finalizado</option>
                </select>
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
