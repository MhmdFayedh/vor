<?php 
$title = 'المبادرات التطوعية في حالة الانتظار';
require_once  '../template/header.php';

$status_error =  $reason_error = '';

$initiativeQuery = "SELECT `id`, `facility_name`, `initiative_name` , `status`, `user_id` FROM voluntary_initiatives WHERE `status` IS NULL";
$initiatives = $dbConn->query($initiativeQuery)->fetch_all(MYSQLI_ASSOC);

if(!isset($_GET["id"])):?>

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

                <?php foreach($initiatives as $initiative):?>
                    <?php
                        // Fetch the name of assoc user for initiatives
                        $nameQuery = "SELECT name FROM users
                        LEFT JOIN  voluntary_initiatives  on users.name =  	voluntary_initiatives.user_id WHERE users.id = ".$initiative['user_id'];
                        $iNames = $dbConn->query($nameQuery)->fetch_array(MYSQLI_ASSOC);

                        ?>
                <tr>
                    <td><?php echo $initiative['id'] ?></td>
                    <td><?php
                        foreach($iNames as $name):
                            echo $name;
                        endforeach;
                    ?></td>
                    <td><?php echo $initiative['facility_name'] ?></td>
                    <td><?php echo $initiative['initiative_name'] ?></td>
                    <td>مبادرة تطوعية</td>
                    <td>
                        <a href="?id=<?php echo $initiative['id'] ?>" class="details-btn">التفاصيل</a>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>

</div>

<?php
require_once  '../template/header.php';
else:
    if(isset($_GET['id'])):
        $initQuery = "SELECT * FROM voluntary_initiatives WHERE id =".$_GET['id']." limit 1";
        $initiRequest = $dbConn->query($initQuery)->fetch_array(MYSQLI_ASSOC);
        require_once '../template/initiative.php';

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $status =  mysqli_real_escape_string($dbConn,$_POST['status']);
            $reason =  mysqli_real_escape_string($dbConn,$_POST['reason']);

            if(empty($status)){ $status_error = "يجب وضع حالة الطلب رفض او قبول";}
            if(empty($reason)){ $reason_error = "يجب وضع سبب الرفض";}

            $updateStmt = "UPDATE `voluntary_initiatives` set status = '".$status."' , reason = '".$reason."' WHERE id = ".$_GET['id'];
            $reqStmt = $dbConn->query($updateStmt);
            
            
            $message =  $initiRequest['opportunity_name'];
            $user_id = $initiRequest['user_id'];

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
?>