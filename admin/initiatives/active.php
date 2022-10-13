<?php
$title = 'المبادرات التطوعية النشطة';
require_once  '../template/header.php';


$status_error =  $reason_error = '';

$initiativeQuery = "SELECT `id`, `facility_name`, `initiative_name` , `status`, `user_id`, `start_date`, `end_date` FROM voluntary_initiatives WHERE `status` = 'accepted'";
$initiatives = $dbConn->query($initiativeQuery)->fetch_all(MYSQLI_ASSOC);

if(!isset($_GET["id"]) && !isset($_GET["volunteers"]) && !isset($_GET['addVolunteers']) && !isset($_GET['aVolu'])):?>

<div>

        <table>
            <thead>
                <tr>
                    <td>#</td>
                    <td>أسم المشرف</td>
                    <td>أسم المنشأة</td>
                    <td>ألاسم</td>
                    <td>تاريخ بداية الفرصة</td>
                    <td>تاريخ نهاية الفرصة</td>
                    <td></td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($initiatives as $initiative):?>
                    <?php
                        // Fetch the name of assoc user for initiatives
                        $nameQuery = "SELECT name FROM users
                        LEFT JOIN  voluntary_initiatives  on users.name = voluntary_initiatives.user_id WHERE users.id = ".$initiative['user_id'];
                        $iNames = $dbConn->query($nameQuery)->fetch_array(MYSQLI_ASSOC);?>
                        <tr>
                            <td class="info"><?php echo $initiative['id'] ?></td>
                            <td class="info"><?php
                                foreach($iNames as $name):
                                    echo $name;
                                endforeach;

                                $startDate = strtotime($initiative['start_date']);
                                $endDate = strtotime($initiative["end_date"]);
                                $user_id = $initiative['user_id'];
                                $message = "أنتهت المبادرة ".$initiative['initiative_name'];
                                if(date('l jS \of F Y') == date('l jS \of F Y',$endDate)){
                                    $destoryNotActiveQ = "UPDATE `volunteer_opportunities` SET `status` = 'done' WHERE id = ".$oppotunity['id'];
                                    $dbConn->query($destoryNotActiveQ);
                                    $dbConn->query("INSERT INTO `notification` (`message`, `nfor`, `user_id`, `ntime` ) VALUES ('$message', 'admin', '$user_id', current_timestamp())");

                                }

                            ?></td>
                            <td class="info"><?php echo $initiative['facility_name'] ?></td>
                            <td class="info"><?php echo $initiative['initiative_name'] ?></td>
                            <td class="info"><?php echo date('l jS \of F Y', $startDate) ?></td>
                            <td class="info"><?php echo date('l jS \of F Y', $endDate )?></td>
                            <td>
                                <a href="?id=<?php echo $initiative['id'] ?>" class="details-btn">التفاصيل</a>
                            </td>
                            <td>
                                <a href="?volunteers=<?php echo $initiative['id']?>" class="details-btn">المتطوعين</a>
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
        $initQuery = "SELECT * FROM voluntary_initiatives WHERE id =".$_GET['id']." limit 1";
        $initiRequest = $dbConn->query($initQuery)->fetch_array(MYSQLI_ASSOC);
        require_once '../template/initiative-details.php';
    endif;


    if(isset($_GET['volunteers'])):
        $initNames = "SELECT * FROM initiative_names WHERE i_id = ".$_GET['volunteers'];
        $inamesQ = $dbConn->query($initNames)->fetch_all(MYSQLI_ASSOC);


        require_once '../template/header.php';

        // require an interface to disply the i_names that loop based on the query "initiatives_Names" table num_rows
        require '../template/i_volunteers.php';

        require_once '../template/footer.php';
    endif;

    if(isset($_GET['addVolunteers'])):
        // To Get The Number of Volunteers

        $stmt = $dbConn->query("SELECT men_number, women_number FROM voluntary_initiatives WHERE id = ".$_GET['addVolunteers']." limit 1")
        ->fetch_array(MYSQLI_ASSOC);
        $menNumber = $stmt['men_number'];
        $womenNumber = $stmt['women_number'];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $menNumber = mysqli_real_escape_string($dbConn, $_POST['men-number']);
            $womenNumber = mysqli_real_escape_string($dbConn, $_POST['women-number']);

            $changeNumberQ = "UPDATE `voluntary_initiatives` SET `men_number` = '$menNumber', `women_number` = '$womenNumber' WHERE `voluntary_initiatives`.`id` = ".$_GET['addVolunteers'];
            $deleteVolunteersQ =  "DELETE FROM initiative_names WHERE `initiative_names`.`i_id` = ".$_GET['addVolunteers'];
            $ChangeIsAddedQ = "UPDATE `voluntary_initiatives` SET `isAdded` = '0'  WHERE `voluntary_initiatives`.`id` = ".$_GET['addVolunteers'];

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


        function filterNatID($field){
            if(preg_match("/^[0-9]{11}$/", $field)){
                return $field;
            }else {
                return false;
            }
        }
        $name = $natId = $hours ='';
        $name_error = $natId_error = $hours_error = '';

        if($_SERVER['REQUEST_METHOD'] == 'POST'){



        $name =  mysqli_real_escape_string($dbConn, $_POST['name']);
        $natID =  mysqli_real_escape_string($dbConn, $_POST['nat-id']);
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
            $addStmt = $dbConn->query("INSERT INTO initiative_names  (name, nat_id, hours, i_id) VALUES ('$name', '$natID', '$hours', '$iID')");
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
require_once  '../template/footer.php';


?>