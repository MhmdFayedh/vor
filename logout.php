<?php

// Will make the session empty, and redirect to the login page(index.php) 
// this way cannot access the system without login agian 
session_start();

if(isset($_SESSION['Loggedin'])):
    $_SESSION = [];
    header('Location: index.php');
    die();
endif;