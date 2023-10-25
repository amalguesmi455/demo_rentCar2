
<?php
final class  dbConnect {

    private $host ;
    private $username ;
    private $password ;
    private $dbName ;
    private $conn ;

    private function __construct(){
       

    }
    public static function connection (){
        
   
        $conn=new mysqli('localhost', 'root', '', 'projet');
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn ;

    }
}
 

?>