<?php
final class RentModel {
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
        self::$tablename= rentTablename;   
     }

    
    
    
     public static function createRent($voitureId, $userId, $totalPrice,$rentStart, $rentEnd) {
       
        self::establishConnect();
        self::setTablename();
        $stmt = self::$conn->prepare("INSERT INTO location (id_voiture, id_user, total_price, rent_start, rent_end, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
        
        if ($stmt === false) {
            // Add error handling here
            echo "Error in SQL query: " . self::$conn->error;
            return null;
        }
    
        $stmt->bind_param("iisss", $voitureId, $userId, $totalPrice,$rentStart, $rentEnd);
    
        if ($stmt->execute()) {
            // Return the ID of the created voiture
            return true ;
        } else {
            // Add error handling here
            echo "Error executing query: " . $stmt->error;
            return null;
        }
    }
   


    public static function getRentById($id) {
        self::establishConnect();
        self::setTablename() ;
        $stmt = self::$conn->prepare("SELECT * FROM location WHERE id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }



    public static function getAllRents() {
        self::establishConnect();
        self::setTablename();
        $stmt = self::$conn->prepare("SELECT voiture.id_voiture, voiture.marque, voiture.modele, voiture.prix_location, location.rent_start, location.rent_end, location.total_price, users.email
                                     FROM voiture
                                     INNER JOIN location ON voiture.id_voiture = location.voiture_id
                                     INNER JOIN users ON location.id_user = id_user ;");
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $rents = array();
            while ($row = $result->fetch_assoc()) {
                $rents[] = $row;
            }
            return $rents;
        } else {
            return array();
        }
    }
    

    public static function getUserRents($userId) {
        self::establishConnect();
        self::setTablename() ;
        $stmt = self::$conn->prepare("SELECT voiture.marque, voiture.model, voiture.hourly_price, location.rent_start, location.rent_end, location.total_price
                                        FROM voiture
                                        INNER JOIN location ON voiture.id = location.voiture_id
                                        WHERE location.user_id = ? ;");
        $stmt->bind_param("s", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $rents = array();
            while ($row = $result->fetch_assoc()) {
                $rents[] = $row;
            }
            return $rents;
        } else {
            return array();
        }
    }


    public static function deleteRent($rentId) {
        self::establishConnect();
        self::setTablename() ;
        $stmt = self::$conn->prepare("DELETE FROM " . self::$tablename . " WHERE id_Contrat = ?");
        $stmt->bind_param("i", $rentId);

        if ($stmt->execute()) {
            return true; // voiture deleted successfully
        } else {
            return false; // Error occurred while deleting voiture
        }
    }
    public static function search_cars($start, $end) {
        self::establishConnect();
        self::setTablename() ;
        $query = "SELECT v.* FROM voiture v LEFT JOIN location r ON v.id_voiture = r.id_voiture  WHERE (r.rent_start > '".$end."'
        OR r.rent_end < '".$start."' ) OR r.id_voiture IS NULL;";
        $stmt =self::$conn->prepare($query);

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $rents = array();
            while ($row = $result->fetch_assoc()) {
                $rents[] = $row;
            }
            return $rents;
        } else {
            return array();
        }
    }

    
}