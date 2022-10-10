<!-- VOR JS -->
<script src="/vor/assets/js/main.js"></script>
<!-- NOTYF JS -->
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

<?php include 'notification.php';

if(isset($_GET['notify'])):
    $dbConn->query("UPDATE `notification` SET `nstatus` = '1' WHERE `notification`.`id` =".$_GET['notify']);
    $notify = "SELECT * FROM `notification`  WHERE `nstatus` = 1 AND id =".$_GET['notify']." LIMIT 1";
    $notify = $dbConn->query($notifysQuery)->fetch_array(MYSQLI_ASSOC);
    require_once __DIR__.'/../notification_display.php';


endif;
?>
</body>
</html>

