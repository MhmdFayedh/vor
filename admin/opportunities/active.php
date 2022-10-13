<?php
$title = 'الفرص التطوعية في حالة الانتظار';
require_once  '../template/header.php';
$status_error =  $reason_error = '';

$oppotunityQuery = "SELECT `id`, `facility_name`, `opportunity_name`, `status`, `user_id`, `start_date`, `end_date`  FROM volunteer_opportunities  WHERE `status` = 'accepted' ";
$oppoturtuities = $dbConn->query($oppotunityQuery)->fetch_all(MYSQLI_ASSOC);

if(!isset($_GET["id"]) && !isset($_GET["volunteers"]) && !isset($_GET['addVolunteers']) && !isset($_GET['aVolu'])):

    // $mysqldate = date( 'Y-m-d H:i:s', $phpdate );
?>



<div>

        <table>
            <thead>
                <tr>
                    <td>#</td>
                    <td>أسم المشرف</td>
                    <td>أسم المنشأة</td>
                    <td>ألاسم</td>
                    <td>تاريخ بداية الفرصة التطوعية</td>
                    <td>تاريخ نهاية الفرصة التطوعية</td>
                    <td></td>
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

                        $startDate = strtotime($oppotunity['start_date']);
                        $endDate = strtotime($oppotunity["end_date"]);
                        $user_id = $oppotunity['user_id'];
                        $message = 'أنتهت الفرصة التطوعية '.$oppotunity['opportunity_name'];

                        if(date('l jS \of F Y') == date('l jS \of F Y',$endDate)){
                            $destoryNotActiveQ = "UPDATE `volunteer_opportunities` SET `status` = 'done' WHERE id = ".$oppotunity['id'];
                            $dbConn->query($destoryNotActiveQ);
                            $dbConn->query("INSERT INTO `notification` (`message`, `nfor`, `user_id`, `ntime` ) VALUES ('$message', 'admin', '$user_id', current_timestamp())");
                        }
                        
                        ?>
                    <tr>
                        <td class="info"><?php echo $oppotunity['id']?></td>
                        <td class="info"><?php
                            foreach($oNames as $name):
                                echo $name;
                            endforeach;

                        ?></td>
                        <td class="info"><?php echo $oppotunity['facility_name'] ?></td>
                        <td class="info"><?php echo $oppotunity['opportunity_name'] ?></td>
                        <td class="info"><?php echo date('l jS \of F Y', $startDate) ?></td>
                        <td class="info"><?php echo date('l jS \of F Y', $endDate )?></td>
                        <td>
                            <a href="?id=<?php echo $oppotunity['id'] ?>" class="details-btn">التفاصيل</a>
                        </td>
                        <td>
                        <a href="?volunteers=<?php echo $oppotunity['id']?>" class="details-btn">المتطوعين</a>
                        </td>
                    </tr>
                <?php endforeach;?>

            </tbody>
        </table>

</div>

<?php
require_once '../template/footer.php';

else:

    if(isset($_GET['id'])):
        $opportQuery = "SELECT * FROM volunteer_opportunities WHERE id =".$_GET['id']." limit 1";
        $opportRequest = $dbConn->query($opportQuery)->fetch_array(MYSQLI_ASSOC);
        require_once '../template/opportunity-details.php';
    endif;





if(isset($_GET['volunteers'])):
    $oppNames = "SELECT * FROM opportunities_names WHERE o_id = ".$_GET['volunteers'];
    $onamesQ = $dbConn->query($oppNames)->fetch_all(MYSQLI_ASSOC);

    require_once '../template/header.php';

    // require an interface to disply the o_names that loop based on the query "Opportunities_Names" table num_rows
    require '../template/o_volunteers.php';

    require_once '../template/footer.php';

endif;
require_once '../template/footer.php';

if(isset($_GET['addVolunteers'])):
    // To Get The Number of Volunteers

    $stmt = $dbConn->query("SELECT men_number, women_number FROM volunteer_opportunities WHERE id = ".$_GET['addVolunteers']." limit 1")
    ->fetch_array(MYSQLI_ASSOC);
    $menNumber = $stmt['men_number'];
    $womenNumber = $stmt['women_number'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $menNumber = mysqli_real_escape_string($dbConn, $_POST['men-number']);
        $womenNumber = mysqli_real_escape_string($dbConn, $_POST['women-number']);

        $changeNumberQ = "UPDATE `volunteer_opportunities` SET `men_number` = '$menNumber', `women_number` = '$womenNumber' WHERE `volunteer_opportunities`.`id` = ".$_GET['addVolunteers'];
        $deleteVolunteersQ =  "DELETE FROM opportunities_names WHERE `opportunities_names`.`o_id` = ".$_GET['addVolunteers'];
        $ChangeIsAddedQ = "UPDATE `volunteer_opportunities` SET `isAdded` = '0'  WHERE `volunteer_opportunities`.`id` = ".$_GET['addVolunteers'];

        $chnage = $dbConn->query($changeNumberQ);
        $delete = $dbConn->query($deleteVolunteersQ);
        $isAdded = $dbConn->query($ChangeIsAddedQ);

        if($chnage && $delete && $isAdded){
            $_SESSION['msg'] = 'تم تعديل أرقام المتطوعيين وحذف جسمع المتطوعيين السابقيين';
            echo "<script>location.href = 'index.php'</script>";
        }
    }


    require_once '../template/header.php';

    // require an interface to disply the i_names that loop based on the query "initiatives_Names" table num_rows
    require '../template/add-volunteers.php';

    require_once '../template/footer.php';

endif;

if(isset($_GET['aVolu'])):

    $name = $natId = $hours ='';
    $name_error = $natId_error = $hours_error = '';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $name =  mysqli_real_escape_string($dbConn, $_POST['name']);
    $natID =  mysqli_real_escape_string($dbConn,$_POST['nat-id']);
    $hours =  mysqli_real_escape_string($dbConn, $_POST['hours']);
    $iID = $_GET['aVolu'];

    // When the input is empty will through an error msg

    if(empty($name)):
        $name_error = "يجب وضع أسم المتطوع";

    endif;

    if(empty($natID)):
        $natId_error = "الهوية غير صحيحة";
    endif;

    if(empty($hours)):
        $hours_error = "يجب وضع ساعات المتطوع";
    endif;

    // Check if there is no error;
    if(!$name_error && !$natId_error && !$hours_error):
        $addStmt = $dbConn->query("INSERT INTO opportunities_names  (name, nat_id, hours, o_id) VALUES ('$name', '$natID', '$hours', '$iID')" );
        $_SESSION['msg'] = 'تم أضافة المتطوع';
        header('location: index.php');
    endif;
}

    require_once '../template/header.php';

    // require an interface to disply the i_names that loop based on the query "initiatives_Names" table num_rows
    require '../template/aVolu.php';

    require_once '../template/footer.php';

endif;
endif;
require_once '../template/footer.php';

?>