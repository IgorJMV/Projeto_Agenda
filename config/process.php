<?php

    session_start();

    include_once("connection.php");
    include_once("url.php");

    $id;

    if(!empty($_GET)){
        $id = $_GET["id"];
    }
    if(!empty($id)){
        //Retorna o dado de um contato
        $query = "SELECT * FROM contacts WHERE id = :id";
        $statement = $conn->prepare($query);
        $statement->bindParam(":id", $id);
        $statement->execute();
        $contact = $statement->fetch();
    }else{
        //Retorna todos os contatos
        $contacts = [];
    
        $query = "SELECT * FROM contacts";
    
        $statement = $conn->prepare($query);
        $statement->execute();
        $contacts = $statement->fetchAll();
    }



?>