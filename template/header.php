<?php
require_once __DIR__.'/../config/app.php'; 
require_once __DIR__.'/../config/database.php'; 

session_start()

?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta dir="rtl">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- VOR custom CSS link -->
    <link rel="stylesheet" href="/vor/assets/css/main.css">
    <title><?php echo $config['appName'].' - '.$title ?></title>
</head>
<body>
    <header>
        <div class="HHC-logo"><a href="#"><img src="/vor/assets/imgs/HHC-Logo.png" alt="Hail Health Cluster LOGO"></a></div>
    </header>
