<?php
/**
 * Summary of RentController
 */
class RentController
{
    /**
     * Summary of carModel
     * @var 
     */
    private $carModel;
    /**
     * Summary of rentModel
     * @var 
     */
    private $rentModel;
    /**
     * Summary of uploaddir
     * @var string
     */
    private $uploaddir = 'Views/carPhoto/';

    /**
     * Summary of __construct
     */
    public function __construct()
    {
        require_once('./DB/dbConnect.php');
        require_once('./Model/RentModel.php');

        $this->carModel = UserModel::class;
        $this->rentModel = RentModel::class;
    }

    /**
     * Summary of calculateHoursDifference
     * @param mixed $startDateTime
     * @param mixed $endDateTime
     * @return float
     */
    function calculateHoursDifference($startDateTime, $endDateTime)
    {
        // Create DateTime objects from the provided strings or timestamps
        $start = new DateTime($startDateTime);
        $end = new DateTime($endDateTime);

        // Calculate the interval between the two DateTime objects
        $interval = $start->diff($end);

        // Calculate the total hours difference as a float
        $hoursDifference = $interval->h + ($interval->i / 60) + ($interval->s / 3600) + ($interval->days * 24);

        return $hoursDifference;
    }




    /**
     * Summary of loadRentForm
     * @return void
     */
    public function loadRentForm()
    {
        require('checkLogin.php');





        include './Views/addContrat.php';

    }


    /**
     * Summary of addRent
     * @return void
     */
    public function addRent()
    {
        require('checkLogin.php');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $date_start = date("Y-m-d H:i", strtotime($_POST["rent_start"]));
            $date_end = date("Y-m-d H:i", strtotime($_POST["rent_end"]));
            $action = $_POST["action"];
            $carId = $_POST["id_voiture"];
            $userId = unserialize($_COOKIE['user'])['id'];
            if ($action == "rent")
                try {
                    $car = $this->carModel::getCarById($carId);
                    $totalPrice = $this->calculateHoursDifference($date_start, $date_end) * $car['hourly_price'];
                    $this->rentModel::createRent($carId, $userId, $totalPrice, $date_start, $date_end);
                    header('Location: Task.php?action=profile');

                } catch (Exception) {
                    echo '<script>alert("rent failed please try again")</script>';
                } else {
                $carsList = $this->carModel::getFreeCar($date_start, $date_end);
                include('Views/Card.php');

            }
        } else

            echo '<script>alert("rent failed please try again")</script>';

    }


    /**
     * Summary of edit
     * @param mixed $carId
     * @return void
     */
    public function edit($carId)
    {
        require_once('checkLogin.php');
        require_once('checkAdmin.php');
        $car = $this->carModel::getCarById($carId);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle form submission and update the car's info
            $modele = filter_input(INPUT_POST, 'modele', FILTER_SANITIZE_STRING);
            $marque = filter_input(INPUT_POST, 'marque', FILTER_SANITIZE_STRING);
            $prix_location = filter_input(INPUT_POST, 'prix_location', FILTER_SANITIZE_STRING);

            if (count($_FILES['file']) > 0) {
                for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
                    $fileName = $_FILES['file']['name'][$i];
                    $fileTmpName = $_FILES['file']['tmp_name'][$i];


                    $uploadfile = uniqid() . basename($fileName);

                    try {
                        move_uploaded_file($fileTmpName, $this->uploaddir . $uploadfile);
                        $this->carModel::createCarPhoto($carId, $uploadfile);

                    } catch (Exception) {
                        echo "error while uploading file\n";
                    }
                }
            }
            if ($this->carModel::updatecar($carId, $model, $marque, $prix_location)) {

                header('Location: Task.php?action=admin&whereTo=cars');
            } else {
                // Registration failed, show an error message
                echo '<script>alert("failed to update the profile")</script>';
            }

        } else {
            // Load the edit profile form
            include './views/editCar.php';
        }
    }


    /**
     * Summary of allRents
     * @return void
     */
    public function allRents()
    {
        require_once('checkLogin.php');
        require_once('checkAdmin.php');

        $rentList = $this->rentModel::getAllRents();
        include './Views/listContrat.php';
    }

    /**
     * Summary of myRents
     * @return void
     */
    public function myRents()
    {
        require_once('checkLogin.php');

        $rentList = $this->rentModel::getUserRents(unserialize($_COOKIE["user"])['id']);
        include './Views/Galerie.php';
    }

    /**
     * Summary of calendar
     * @return void
     */
    public function calendar()
    {
        require_once('checkLogin.php');
        require_once('checkAdmin.php');
        $rentList = $this->rentModel::getAllRents();
        include './Views/calendar.php';
    }

    public function search_cars()
    {       

        $start = $_POST['rent_start'];
        $end = $_POST['rent_end'];
        $cars = $this->rentModel::search_cars($start, $end);
        include './Views/list_Car.php';
    }


}