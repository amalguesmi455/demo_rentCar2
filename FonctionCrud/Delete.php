<?php
require_once 'db.php';
require_once 'UserController.php';

$controller = new UserController($conn);

$id = $_GET['id'];

if ($id) {
    $controller->deleteUser($id);
}

header('Location: user_list.php');
?>
