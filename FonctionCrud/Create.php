<?php
 require_once 'db.php';
 require_once 'UserController.php';
 $databaseConnection = new PDO('mysql:host=localhost;dbname=projet', 'root', '');
 $controller = new UserController($databaseConnection);


   public function createUser($email, $password, $nom, $Prenom)
    {
        $sql = "INSERT INTO users (email, password, nom, prenom) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $email, $password, $nom, $Prenom);
        $stmt->execute();
    }



?>