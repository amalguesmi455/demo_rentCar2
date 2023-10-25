<?php
 require_once 'db.php';
 require_once 'UserController.php';

 $controller = new UserController($conn);


      // Add a method to check if the provided email and password are correct

    public function checkCredentials($email, $password) {
        // Use prepared statements to prevent SQL injection
        $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0; // Return true if a matching user is found
    }
?>  