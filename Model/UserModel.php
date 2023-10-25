<?php
 class UserModel {
    private static $conn;
    private static $tablename;

    private function __construct() {

    }
    public static function establishConnect() {
        require_once 'DB/dbConnect.php' ;
       
        self::$conn = dbConnect::connection();
    }
    public static function setTablename() {
        require_once 'DB/ConfigDB.php' ;
        self::$tablename= tablename;   
     }


    
    
    
     public static function createUser($email, $password, $username, $Prenom, $role, $photo_profil) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $created_at = date('Y-m-d H:i:s');
        self::establishConnect();
        self::setTablename();
    
        $query = self::$conn->prepare("INSERT INTO " . self::$tablename . " (email, password, nom, prenom, role, created_at, photo_profil) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param("sssssss", $email, $hashedPassword, $username, $Prenom, $role, $created_at, $photo_profil);
        
        $response = $query->execute();
    
        if ($response) {
            return true;
        } else {
            return false;
        }
    }
    public static function createCar($marque, $modele, $couleur, $prix_location,$action) {
        
        $date_arrivage = date('Y-m-d H:i:s');
        self::establishConnect();
        self::setTablename();

        $query = self::$conn->prepare("INSERT INTO voiture (marque, modele, couleur, date_arrivage, prix_location, action)VALUES (?, ?, ?, NOW(), ?, ?);");
        var_dump($query);
        $query->bind_param("sssss", $marque, $modele, $couleur, $prix_location,$action);
        
        $response = $query->execute();
    
        if ($response) {
            return self::$conn->insert_id;
        } else {
            return false;
        }
    }
    
    public static function createphoto($carid, $photo) {
       
        define('tablename','car_photo')   ;
        self::establishConnect();
       

        $query = self::$conn->prepare("INSERT INTO car_photo (id_voiture ,  PhotoPath) VALUES (?, ?)");
        $query->bind_param("ss", $carid,  $photo);
        
        $response = $query->execute();
    
        if ($response) {
            return true;
        } else {
            return false;
        }
    }

    public static function getUserByEmail($email) {
        self::establishConnect();
        self::setTablename() ;
        
        $stmt = self::$conn->prepare("SELECT * FROM " . self::$tablename . " WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    
    

    public function get()

    {

        $query = "SELECT * FROM users";

        $stmt = $this->db->query($query);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public static function getUserById($id_user) {
        self::establishConnect();
        self::setTablename() ;
        $stmt = self::$conn->prepare("SELECT * FROM users WHERE id_user = ?");
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
       $response= $stmt->get_result() ;
       return $response->fetch_assoc();
    }

    public static function getCarById($id_voiture) {
        self::establishConnect();
        self::setTablename() ;
       
        $stmt = self::$conn->prepare("SELECT * FROM voiture WHERE id_voiture = ?");
        $stmt->bind_param("s", $id_Car);
        $stmt->execute();
        
    }
    public static function getAllUser() {
        self::establishConnect();
        self::setTablename() ;
        $stmt = self::$conn->prepare("SELECT * FROM  " . self::$tablename );
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $users = array();
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
            return $users;
        } else {
            return array();
        }
    }

    public static function getAllCars() {
        define('tablename','voiture')   ;
        self::establishConnect();
        $stmt = self::$conn->prepare("SELECT * FROM " . tablename);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $cars = array();
            while ($row = $result->fetch_assoc()) {
                $carss[] = $row;
            }
            return $cars;
        } else {
            return array();
        }
    }

    public static function updateUser($id, $email,$password) {


        $query = "UPDATE users SET email = ?, password = ? WHERE id_user = ?";

        $stmt = self::$conn->prepare($query);
        $stmt->bind_param("sss", $email,$password,$id);
        $response=$stmt->execute();

 

        if ($response) {

            return true;

        } else {

            return false;

        }

    }

  
    // public static function deleteUser($id) {
    //     self::establishConnect();
    //     self::setTablename() ;
    //     $stmt = self::$conn->prepare("DELETE FROM " . self::$tablename . " WHERE id = ?");
    //     $stmt->bind_param("i", $id);

    //     if ($stmt->execute()) {
    //         return true; // User deleted successfully
    //     } else {
    //         return false; // Error occurred while deleting user
    //     }
    // }
    public static function deleteUser($userId) {
        self::establishConnect();
           self::setTablename() ;
        $sql = "DELETE FROM users WHERE id_user = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->bind_param("i", $userId);

        if ($stmt->execute()) {
            return true; // Suppression réussie
        } else {
            return false; // Erreur lors de la suppression
        }
    }


    public static function deleteCars($id_voiture) {
        self::establishConnect();
       

        $sql = "DELETE FROM voiture WHERE id_voiture = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->bind_param("i", $id_voiture);
        $res=$stmt->execute();
        //echo $stmt->execute();die;
        if ($res) {
            return true; // Deletion successful
        } else {
            return false; // Error during deletion
        }
    }
    public static function getAllPhotos($carId) {
        self::establishConnect();
        self::setTablename();
        
        $sql = "SELECT * FROM car_photo WHERE id_voiture = ?";
        $stmt = self::$conn->prepare($sql);
        $stmt->bind_param("i", $carId); // Assuming car_id is an integer
    
        $photos = [];
    
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $photos[] = $row;
            }
        } else {
            // Handle the error, e.g., return an empty array or log the error
        }
    
        return $photos;
    }
    
}

?>