<?php

    session_start();

    include_once("connection.php");
    include_once("url.php");

    $data = $_POST;

    //Modificações no banco
    if(!empty($data)){
        //Criar contato
        if($data["type"] === "create"){
            $name = $data["name"];
            $phone = $data["phone"];
            $observations = $data["observations"];

            $query = "INSERT INTO contacts (name, phone, observations) VALUES (:name, :phone, :observations)";

            $statement = $conn->prepare($query);
            $statement->bindParam(":name", $name);
            $statement->bindParam(":phone", $phone);
            $statement->bindParam(":observations", $observations);
            try {
                $statement->execute();
                $_SESSION["msg"] = "Contato criado com sucesso!";                
            } catch (PDOException $e) {
                echo "Insert error: " . $e->getMessage();
            }
        } else if($data["type"] === "edit"){
            $id = $data["id"];
            $name = $data["name"];
            $phone = $data["phone"];
            $observations = $data["observations"];

            $query = "UPDATE contacts SET name = :name, phone = :phone, observations = :observations WHERE id = :id";

            $statement = $conn->prepare($query);
            $statement->bindParam(":name", $name);
            $statement->bindParam(":phone", $phone);
            $statement->bindParam(":observations", $observations);
            $statement->bindParam(":id", $id);
            try {
                $statement->execute();
                $_SESSION["msg"] = "Contato atualizado com sucesso!";                
            } catch (PDOException $e) {
                echo "Insert error: " . $e->getMessage();
            }
        }

        //Redirecionando para home
        header("Location:" . $BASE_URL . "../index.php");
    } else {

    }

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


    //Fechar conexão
    $conn = null;


?>