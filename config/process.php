<?php

    session_start();

    include_once("connection.php");
    include_once("url.php");

    $query = "SELECT * FROM contacts";

    $statement = $conn->prepare($query);
    $statement->execute();
    $contents = $statement->fetchAll();

?>