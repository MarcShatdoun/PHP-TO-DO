<?php

// Parámetros de las conexión
$serverName = "127.0.0.1";
$userName = "MarcDatos";
$password = "12345";
$dbName = "color";

$link = "mysql:host=$serverName; port=3306; dbname=$dbName;";
try {

$conn = new PDO($link, $userName, $password);


// echo "Connection established ";

} catch (PDOException $e){
print("Error: " . $e->getMessage()); //Mensaje de fallo en el error

} catch (Exception $e) {
    print("Error: " . $e->getMessage()); // mensaje de error en la conexion


}










