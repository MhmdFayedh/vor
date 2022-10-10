<?php
require_once __DIR__.'/../../config/app.php';
require_once __DIR__.'/../../config/database.php';
require_once __DIR__.'/../../classes/User.php';
require_once __DIR__.'/../../classes/Methods.php';
session_start();
$methods = new Methods;
$user = new User;

if(!$user->isAdmin() ){
    header("Location: /vor/unknown.php");
    die();
}

$notifysQuery = "SELECT * FROM `notification`  WHERE `nstatus` = 0 AND `nfor` = 'admin' ORDER BY `ntime` desc ";
$notifys = $dbConn->query($notifysQuery)->fetch_all(MYSQLI_ASSOC);




?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta dir="rtl">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <!-- VOR custom CSS  -->
    <link rel="stylesheet" href="/vor/assets/css/main.css">
    <title><?php echo $config['appName'].' - '.$title ?></title>
</head>
<body>
    <header>
        <div class="HHC-logo"><a href="<?php echo $config['appUrl'].'admin/index.php' ?>"><img src="/vor/assets/imgs/HHC-Logo.png" alt="Hail Health Cluster LOGO"></a></div>

        <div class="side">

            <!-- <div class="side-item"></div> -->
            <div class="dropdown side-item" data-dropdown>
                <a href="#" class="link" >
                <span class="badge"><?php echo count($notifys) ?></span>    
                <img src="/vor/assets/imgs/notification.png" data-dropdown-button style="width:30px;" alt=""></a>
                <div class="dropdown-menu">
                    <?php
                        if(count($notifys) != 0):
                        foreach($notifys as $notify):
                        ?>
                        <a href="<?php echo $config['appUrl'] .'admin/notification_display.php?notify='. $notify['id']?>"><?php echo $methods->displayNotify($notify['message'])  ?></a>
                        <hr>
                    <?php endforeach;
                    else:
                    ?>
                    <p>لا توجد أشعارات</p>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="dropdown user side" data-dropdown>
                <a href="#" class="link" ><img style="width: 40px;" data-dropdown-button src="/vor/assets/imgs/user.png" alt=""></a>
                <div class="dropdown-menu">
                <h3><?php echo $_SESSION['name']?></h3>
                <a href="<?php echo $config['appUrl'].'logout.php'?>"><img src="/vor/assets/imgs/logout.png" alt="Logout Icons" style="width: 30px ;"></a>
                </div>
            </div>
            <!-- <a href=" $config['appUrl'].'admin/notification_display.php'?>"><img src="/vor/assets/imgs/notification.png" alt="Notification Icon" style="width: 30px ;"></a> -->
        </div>

    </header>
