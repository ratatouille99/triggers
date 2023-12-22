<?php

//creamos las caracteristicas necesarias para poder nuestra base de datos
$servidor="localhost";
$db="vriunap_fedu";
$username="root";
$password= "";

try {
    //conectamos a la base de datos
    $conexion = new PDO("mysql: host=$servidor; dbname=$db", $username, $password);
    echo "conexion exitosa";

}   catch(Exception $e) {
    echo "Hubo un error";
}

?>