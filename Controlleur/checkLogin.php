<?php

if (!isset($_COOKIE['user'])) {
    // If the user is not logged in, you can redirect them to the login page
    header('Location: Task.php?action=login');
    exit;
}

?>