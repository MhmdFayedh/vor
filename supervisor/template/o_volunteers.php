<?php
// To fetch the total number of voluteers
$stmt = $dbConn->query("SELECT men_number, women_number, opportunity_name FROM volunteer_opportunities WHERE id = ".$_GET['id']." limit 1")->fetch_array(MYSQLI_ASSOC);
$volunteersNum = $stmt['men_number'] + $stmt['women_number'];
$name = $natID = $hours = '';
$name_error = $natId_error = $hours_error = '';

$message = "تم رفع الاسماء للمبادرة ".$stmt['opportunity_name'];




if($_SERVER["REQUEST_METHOD"] == 'POST'){
    $addStmt = '';

    // When post request will loop for all the input based on the $volunteerNum
    for($i = 0; $i < $volunteersNum; $i++):
        $name =  mysqli_real_escape_string($dbConn, $_POST['v-name-'.$i]);
        $natID =  $methods->filterNatID($_POST['v-id-'.$i]);
        $hours =  mysqli_real_escape_string($dbConn, $_POST['v-hours-'.$i]);
        $oID = $_GET['id'];

        if(empty($name)):
            $name_error = "يجب وضع أسم المتطوع";
        endif;


        if(!$natID ||empty($natID)):
            $natId_error = "الهوية غير صحيحة";
        endif;


        if(empty($hours)):
            $hours_error = "يجب وضع ساعات المتطوع";
        endif;

        if(!$name_error && !$natId_error && !$hours_error):
            $addStmt = $dbConn->query("INSERT INTO opportunities_names (name, nat_id, hours, o_id) VALUES ('$name', '$natID', '$hours', '$oID')" );
        endif;
    endfor;
    if($addStmt):
        $dbConn->query("UPDATE `volunteer_opportunities` SET `isAdded` = '1' WHERE `volunteer_opportunities`.`id` = ".$_GET['id']);
        $dbConn->query("INSERT INTO `notification` (`message`, `nfor`, `user_id`, `ntime` ) VALUES ('$message', 'admin', '$user_id', current_timestamp())");
        $_SESSION['msg'] = 'نم رفع الاسماء بنجاح';

        header("location: index.php");
        die();
    else:
        $_SESSION['msg'] = 'حدث خطأ اثناء رفع الأسماء';

    endif;


}

?>


<main>
    <div class="vol" >
        <h1 class="info">أضافة معلومات المتطوعين</h1>
        <h3 class="info">عدد المتطوعين <?php echo $volunteersNum ?></h3>
        <form action="" method="POST" enctype="multipart/form-data">

        <?php for($i = 0; $i < $volunteersNum; $i++ ):
            ?>
            <h4 class="info">المتطوع رقم (<?php echo $i?>)</h4>
                <!-- Volunteers Name -->
                <div class="filed">
                    <label for="v-name-<?php echo $i?>">أسم المتطوع</label>
                    <input type="text" name="v-name-<?php echo $i?>" id="v-name-<?php echo $i?>" class="">
                    <div>
                        <small class="warring-msg"><?php echo $name_error  ?></small>
                    </div>
                </div>
                <!-- Volunteers Hours -->
                <div class="filed">
                    <label for="v-hours-<?php echo $i ?>">عدد الساعات</label>
                    <input type="numebr" name="v-hours-<?php echo $i ?>" id="v-hours-<?php echo $i ?>" class="">
                    <div>
                        <small class="warring-msg"><?php echo $hours_error ?></small>
                    </div>
                </div>
                <!-- Volunteers Nat.ID Continer -->
                <div class="filed">
                    <label for="v-id-<?php echo $i ?>">رقم الهوية</label>
                    <input type="text" name="v-id-<?php echo $i ?>" id="v-id-<?php echo $i ?>" class="">
                    <div>
                        <small class="warring-msg"><?php echo $natId_error ?></small>
                    </div>
                </div>
                <br>
                <hr>
                <br>

        <?php endfor; ?>
        <br>
        <div>
            <input class="custom-btn" type="submit" value="رفع أسماء المتطوعين">
        </div>
        </form>

    </div>
</main>