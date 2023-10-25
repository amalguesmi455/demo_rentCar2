<?php
session_start();

// Include necessary files and define your routes
require_once './Controlleur/Controller.php';
require_once './Controlleur/AuthController.php';
require_once './Controlleur/rentController.php';

$controller = '';
$action = '';


if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    header('Location: ../Views/Index.php');

}
$userController = new Controller();
$rentController = new RentController();

// Route requests to the appropriate controllers and actions
switch ($action) {

    case 'register':

        $userController->register();

        break;
    case 'login':
        $authController = new AuthController();

        $authController->login();
        break;
    case 'add_car':

        $userController->add_car();

        break;

    case 'search_cars':

        $rentController->search_cars();

        break;
    case 'logout':
        $authController = new AuthController();

        $authController->logout();
        break;
    case 'profile':
        if (isset($_GET['isAdmin']) && $_GET['isAdmin'] == "admin") {
            include "./Views/homeAdmin.php";
        } else
            include "./Views/homeUser.php";
        break;
    case 'edit':
        $userController->adminEdit($_GET['id']);
        break;
    case 'editCar':
        $userController->editCar($_GET['id']);
        break;
    case 'adminedit':
        $userController->adminEdit($_GET['id']);
        break;

    case 'delete':
        if (isset($_GET['id'])) {
            $userController->deleteUser($_GET['id']);
        }
        break;
    case 'deleteCar':
        $userController->deleteCar($_GET['id']);

        break;
    case 'allUsers':
        $userController->allUsers();
        break;
    case 'allCars':
        $userController->allCars();
        break;

    case 'admin':
        $userController->admin();
        break;
    case 'deleteUser':
        $userController->deleteUser($_GET['id']);
        break;

    case 'profil':
        if (isset($_GET['id'])) {
            $userController->uploadpic($_GET['id']);
        }

        break;
 case 'getCarPhotos':
        if (isset($_GET['id'])) {
            $userController->getCarPhotos($_GET['id']);
        }
        case 'location':
            if (isset($_GET['id'])) {
                $userController->getCarPhotos($_GET['id']);
            }
    default:
        // Redirect to the login page or home page
        $userController->allUsers();
        break;
}