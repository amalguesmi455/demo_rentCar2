<?php
 require_once 'db.php';
 require_once 'UserController.php';

 $controller = new UserController($conn);

  public function updateUser($id, $user)  
   {
        $sql = "UPDATE users SET name=?, email=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$name, $email, $id]);
    }
?>