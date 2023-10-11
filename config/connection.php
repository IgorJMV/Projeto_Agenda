<?php

    $hostname = "localhost";
    $database = "agenda";
    $username = "root";
    $passowrd = "";

    try{
        $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $passowrd);

        //Ativar o modo de erros
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Connection error: " . $e->getMessage();
    }

?>