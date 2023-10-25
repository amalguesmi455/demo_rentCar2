<?php
require_once 'db.php';
require_once 'UserController.php';

$controller = new UserController($conn);

$users = $controller->readUsers();

include 'user_list.php';
?>