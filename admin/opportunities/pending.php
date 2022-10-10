<?php
$title = 'الفرص التطوعية في حالة الانتظار';
require_once  '../template/header.php';

$status_error =  $reason_error = '';

$oppotunityQuery = "SELECT `id`, `facility_name`, `opportunity_name`, `status`, `user_id` FROM volunteer_opportunities  WHERE `status` IS NULL";
$oppoturtuities = $dbConn->query($oppotunityQuery)->fetch_all(MYSQLI_ASSOC);

if(!isset($_GET["id"]) ):?>

<div>

        <table>
            <thead>
                <tr>
                    <td>#</td>
                    <td>أسم المشرف</td>
                    <td>أسم المنشأة</td>
                    <td>ألاسم</td>
                    <td>فرصة\مبادرة تطوعية</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($oppoturtuities as $oppotunity):?>
                    <?php
                        // Fetch the name of assoc user for opportunity
                        $nameQuery = "SELECT name FROM users
                        LEFT JOIN volunteer_opportunities on users.name = volunteer_opportunities.user_id WHERE users.id = ".$oppotunity['user_id'];
                        $oNames = $dbConn->query($nameQuery)->fetch_array(MYSQLI_ASSOC);
                        $userID = $oppotunity['user_id'];
                        ?>
                    <tr>
                        <td><?php echo $oppotunity['id']?></td>
                        <td><?php
                            foreach($oNames as $name):
                                echo $name;
                            endforeach;
                        ?></td>
                        <td><?php echo $oppotunity['facility_name'] ?></td>
                        <td><?php echo $oppotunity['opportunity_name'] ?></td>
                        <td>فرصة تطوعية</td>
                        <td>
                            <a href="?id=<?php echo $oppotunity['id'] ?>" class="details-btn">التفاصيل</a>
                        </td>
                    </tr>
                <?php endforeach;?>

            </tbody>
        </table>

</div>

<?php

else:

    if(isset($_GET['id'])):
        $opportQuery = "SELECT * FROM volunteer_opportunities WHERE id = ".$_GET['id']." limit 1";
        $opportRequest = $dbConn->query($opportQuery)->fetch_array(MYSQLI_ASSOC);
        require_once '../template/opportunity-details.php';

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $status =  mysqli_real_escape_string($dbConn,$_POST['status']);
            $reason =  mysqli_real_escape_string($dbConn,$_POST['reason']);

            if(empty($status)){ $status_error = "يجب وضع حالة الطلب رفض او قبول";}
            if(empty($reason)){ $reason_error = "يجب وضع سبب الرفض";}

            $updateStmt = "UPDATE `volunteer_opportunities` set status = '".$status."' , reason = '".$reason."' WHERE id = ".$_GET['id'];
            $reqStmt = $dbConn->query($updateStmt);


            $message =  $opportRequest['opportunity_name'];
            $user_id = $opportRequest['user_id'];
            if($reqStmt){
                if($status == 'accepted'){
                    $message .= " تم قبول الفرصة التطوعية";
                    $dbConn->query("INSERT INTO `notification` (`message`, `nfor`, `user_id`, `ntime` ) VALUES ('$message', 'supervisor', '$user_id', current_timestamp());");
                    $_SESSION['msg'] = 'تم تحديث حالة الفرصة وقبولها';
                }elseif($status == 'rejected'){
                    $message .= " تم رفض الفرصة التطوعية";
                    $dbConn->query("INSERT INTO `notification` (`message`, `nfor`, `user_id`, `ntime` ) VALUES ('$message', 'supervisor', '$user_id' , current_timestamp());");
                    $_SESSION['msg'] = 'تم تحديث حالة الفرصة ورفضها';
                }
                echo "<script>location.href = 'index.php'</script>";
                die();
            }else {
                echo 'wrong';
            }
        }
    endif;
endif;
require_once '../template/footer.php';

?>