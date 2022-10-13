<?php
require_once __DIR__.'/../../config/database.php';
// Function check for the NatId filed to match the stander natId and real excape it
$name = $natID = $hours = '';
$name_error = $natId_error = $hours_error = '';





// To fetch the total number of voluteers
$stmt = $dbConn->query("SELECT men_number, women_number , initiative_name FROM voluntary_initiatives WHERE id = ".$_GET['id']." limit 1")->fetch_array(MYSQLI_ASSOC);
$volunteersNum = $stmt['men_number'] + $stmt['women_number'];
$message = "تم رفع الاسماء للمبادرة ".$stmt['initiative_name'];
if($_SERVER["REQUEST_METHOD"] == 'POST'){
    $addStmt = '';

    // When post request will loop for all the input based on the $volunteerNum
    for($i = 0; $i < $volunteersNum; $i++):
        $name =  mysqli_real_escape_string($dbConn, $_POST['v-name-'.$i]);
        $natID =  $methods->filterNatID(($_POST['v-id-'.$i]));
        $hours =  mysqli_real_escape_string($dbConn, $_POST['v-hours-'.$i]);
        $iID = $_GET['id'];

        // When the input is empty will through an error msg

        if(empty($name)):
            $name_error = "يجب وضع أسم المتطوع";

        endif;

        if(!$natID || empty($natID)):
            $natId_error = "الهوية غير صحيحة";
        endif;

        if(empty($hours)):
            $hours_error = "يجب وضع ساعات المتطوع";
        endif;

        // Check if there is no error;
        if(!$name_error && !$natId_error && !$hours_error):
            $addStmt = $dbConn->query("INSERT INTO initiative_names  (name, nat_id, hours, i_id) VALUES ('$name', '$natID', '$hours', '$iID')" );
        endif;

    endfor;
    if($addStmt):
        $dbConn->query("UPDATE voluntary_initiatives SET `isAdded` = '1' WHERE id = ".$_GET['id']);
        $dbConn->query("INSERT INTO `notification` (`message`, `nfor`, `user_id`, `ntime` ) VALUES ('$message', 'admin', '$user_id', current_timestamp())");
        $_SESSION['msg'] = 'نم رفع الاسماء بنجاح';
        header("location: index.php");
        die();
    else:
        $_SESSION['error-msg'] = 'حدث خطأ اثناء رفع الأسماء';

    endif;
}

?>


<main>
    <div class="vol">
        <h2 class="info">أضافة معلومات المتطوعين</h2>
        <h4 class="warring-msg">عدد المتطوعين: <?php echo $volunteersNum ?></h4>
        <form action="" method="POST" enctype="multipart/form-data">

        <?php for($i = 0; $i < $volunteersNum; $i++ ): ?>
            <h4 class="info">المتطوع رقم <?php echo $i?></h4>
                <!-- Volunteers Name -->
                <div class="filed">
                    <label for="v-name-<?php echo $i?>">أسم المتطوع <small class="warring-msg">*</small></label>
                    <input type="text" name="v-name-<?php echo $i?>" id="v-name-<?php echo $i?>" value="<?php echo $name?>" class="">
                    <div>
                        <small class="warring-msg"><?php echo $name_error  ?></small>
                    </div>
                </div>
                <!-- Volunteers Hours -->
                <div class="filed">
                    <label for="v-hours-<?php echo $i ?>">عدد الساعات <small class="warring-msg">*</small></label>
                    <input type="numebr" name="v-hours-<?php echo $i ?>" id="v-hours-<?php echo $i ?>" value="<?php echo $hours?>" class="">
                    <div>
                        <small class="warring-msg"><?php echo $hours_error ?></small>
                    </div>
                </div>
                <!-- Volunteers Nat.ID Continer -->
                <div class="filed">
                    <label for="v-id-<?php echo $i ?>">رقم الهوية <small class="warring-msg">*</small></label>
                    <input type="text" name="v-id-<?php echo $i ?>" id="v-id-<?php echo $i ?>" value="<?php echo $natID?>" class="">
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