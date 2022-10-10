<?php
$title = "طلب مبادرة تطوعية";
require_once "template/header.php";


// Declaer the varaibles for form, to disply it again
$facilityName = $departmentName = $external = $nature =
$initiativeName = $initiativeType = $area = $menNumebr =
$womenNumber = $initiative_duration = $startDate = $endDate = $startTime =
$endTime = $required_profession = $explained_initiative = $volunteersRoles = '';


// Declare the errors varables to dispaly errors if it's happen
$fName_error = $dName_error = $external_error = $nature_error =
$iName_error = $iType_error = $area_error =
$mNum_error = $wNum_error = $iDuration_error =
$sDate_error = $eDate_error = $sTime_error =
$eTime_error = $reqPro_error = $exInit_error = $vRoles_error = '';



if($_SERVER['REQUEST_METHOD'] == "POST"){


$facilityName = mysqli_real_escape_string($dbConn, $_POST['facility-name']);
$departmentName =  mysqli_real_escape_string($dbConn, $_POST['department-name']);
$external =  mysqli_real_escape_string($dbConn, $_POST['external']);
$nature =  mysqli_real_escape_string($dbConn, $_POST['nature']);
$initiativeName = mysqli_real_escape_string($dbConn, $_POST['initiative-name']);
$initiativeType = mysqli_real_escape_string($dbConn, $_POST['initiative-type']);
$area = mysqli_real_escape_string($dbConn, $_POST['area']);
$menNumber = mysqli_real_escape_string($dbConn, $_POST['men-number']);
$womenNumber = mysqli_real_escape_string($dbConn, $_POST['women-number']);
$initiative_duration = mysqli_real_escape_string($dbConn, $_POST['initiative-duration']);
$startDate = mysqli_real_escape_string($dbConn, $_POST['start-date']); 
$endDate = mysqli_real_escape_string($dbConn, $_POST['end-date'] ); 
$startTime = mysqli_real_escape_string($dbConn, $_POST['start-time']); 
$endTime = mysqli_real_escape_string($dbConn, $_POST['end-time']);
$required_profession = mysqli_real_escape_string($dbConn, $_POST['required-profession']); 
$explained_initiative = mysqli_real_escape_string($dbConn, $_POST['explained-initiative']);
$volunteersRoles = mysqli_real_escape_string($dbConn, $_POST['volunteers-roles']);



if(empty($facilityName)){ $fName_error = 'يجب وضع أسم المنشأة';}
if(empty($departmentName)){ $dName_error = 'يجب وضع أسم القسم';}
if(empty($external)){ $external_error = 'يجب وضع أسم الجهة الخارجية';}
if(empty($nature)){ $nature_error = 'يجب وضع طبيعة العلاقة';}
if(empty($initiativeName)){ $iName_error = 'يجب وضع أسم المبادرة التطوعية';}
if(empty($initiativeType)){ $iType_error = 'يجب وضع نوع المبادرة التطوعية';}
if(empty($area)){ $area_error = 'يجب وضع نوع المبادرة التطوعية';}
if(empty($menNumber)){ $mNum_error = 'يجب وضع عدد الرجال';}
if(empty($womenNumber)){ $wNum_error = 'يجب وضع عدد النساء';}
if(empty($initiative_duration)){ $iDuration_error = 'يجب وضع مدة المبادرة';}
if(empty($startDate)){ $sDate_error = 'يجب وضع بداية المبادرة';}
if(empty($endDate)){ $eDate_error = 'يجب وضع نهاية المبادرة';}
if(empty($startTime)){ $sTime_error = 'يجب وضع بداية وقت العمل';}
if(empty($endTime)){ $eTime_error = 'يجب وضع نهاية وقت العمل';}
if(empty($required_profession)){ $reqPro_error = 'يجب وضع التخصص المطلوب';}
if(empty($explained_initiative)){ $exInit_error = 'يجب وضع شرح المبادرة';}
if(empty($volunteersRoles)){ $vRoles_error = 'يجب وضع أدوار المتطوعين';}

if(!$fName_error && !$dName_error && !$external_error && !$nature_error && !$iName_error && !$iType_error && !$area_error && !$mNum_error && !$wNum_error && 
!$iDuration_error && !$sDate_error && !$eDate_error && !$sTime_error && !$reqPro_error 
&& !$exInit_error && !$vRoles_error){

    $user_id = $_SESSION['user_id'];


    $insertStmt = "INSERT INTO voluntary_initiatives (facility_name, department, external, relationship_nature," 
                ."initiative_name, initiative_type, area, men_number, women_number, initiative_duration, start_date" 
                .", end_date, start_time, end_time, required_profession, explained_initiative, volunteers_roles, user_id )"
                ."VALUES ('$facilityName', '$departmentName' , '$external', '$nature', '$initiativeName', '$initiativeType', '$area', '$menNumber', '$womenNumber', '$initiative_duration', '$startDate', '$endDate', '$startTime', '$endTime', '$required_profession', '$explained_initiative', '$volunteersRoles', ".$_SESSION['user_id'].")";

    $notificationQuery = "INSERT INTO `notification` (`message`, `nfor`, `user_id`, `ntime` ) VALUES ('$initiativeName', 'admin', '$user_id', current_timestamp());";

    $outerRequest = $dbConn->query($insertStmt);
    $dbConn->query($notificationQuery);

    if($outerRequest):
        $_SESSION['msg'] = "تم أرسال طلب المبادرة التطوعية";
        header('Location: index.php');
        die();
    elseif(mysqli_error($dbConn)):
        $_SESSION['msg'] = mysqli_errno($dbConn);
    endif;
}

}
?>

<main>
    <div class="outerFormContiner">
        <form action="" method="POST">
            <!-- Facility Name -->
            <div class="input out-inp1">
                <label for="facility-name">أسم المنشاة</label>
                <input type="text" name="facility-name" id="facility-name">
                <div>
                        <small class="warring-msg"><?php echo $fName_error ?></small>
                </div>
            </div>
            <!-- Department Name-->
            <div class="input out-inp2">
                <label for="department-name">القسم</label>
                <input type="text" name="department-name" id="department-name">
                <div>
                        <small class="warring-msg"><?php echo $dName_error ?></small>
                </div>
            </div>
            <!-- Volunteer initive Name -->
            <div class="input out-inp3">
                <label for="initiative-name">أسم المبادرة التطوعية</label>
                <input type="text" name="initiative-name" id="initiative-name">
                <div>
                        <small class="warring-msg"><?php echo $iName_error ?></small>
                </div>
            </div>
            <!-- Volunteer initiative Type  -->
            <div class="input out-inp4">
                <label for="initiative-type">نوعها</label>
                <input type="text" name="initiative-type" id="initiative-type">
                <div>
                        <small class="warring-msg"><?php echo $iType_error ?></small>
                </div>
            </div>
            <!-- External -->
            <div class="input out-inp5">
                <label for="external">أسم الجهة الخارجية</label>
                <input type="text" name="external" id="external">
                <div>
                        <small class="warring-msg"><?php echo $external_error ?></small>
                </div>
            </div>
            <!-- Nature -->
            <div class="input out-inp6">
                <label for="nature">طبيعة علاقة المبادرة التطوعية </label>
                <input type="text" name="nature" id="nature">
                <small class="warring-msg">يحدد من هي الجهة صاحبة المبادرة ومن هي الجهة المشاركة معها</small>
                <div>
                        <small class="warring-msg"><?php echo $nature_error ?></small>
                </div>
            </div>
            <!-- men/women numbers -->
            <div class="input out-inp7">
                <label for="men-number">العدد المطلوب</label>
                <div>
                    <label for="men-number"><small class="warring-msg">رجال</small></label>
                    <input name="men-number" id="men-number" type="number">
                    
                </div>
                <div>
                        <small class="warring-msg"><?php echo $mNum_error ?></small>
                </div>
                <div>
                    <label for="women-number"><small class="warring-msg">نساء</small></label>
                    <input name="women-number" id="women-number" type="number">
                </div>
                <div>
                        <small class="warring-msg"><?php echo $wNum_error ?></small>
                </div>
            </div>
            <!-- Initiative Duration -->
            <div class="input out-inp8">
                <label for="initiative-duration">مدة المبادرة</label>
                <input type="number" name="initiative-duration" id="initiative-duration">
                <div>
                        <small class="warring-msg"><?php echo $iDuration_error ?></small>
                </div>
            </div>
            <!-- start/end Date -->
            <div class="input out-inp9">
                <label for="start-date">تاريخ بداية المبادرة</label>
                    <div>
                    <small class="warring-msg">من</small>
                    <input type="date"  name="start-date"  id="start-date">
                    <div>
                        <small class="warring-msg"><?php echo $sDate_error ?></small>
                    </div>
                    </div>
                    <div>
                    <small class="warring-msg">الى</small>
                    <input type="date"  name="end-date"  id="end-date">
                    <div>
                        <small class="warring-msg"><?php echo $eDate_error ?></small>
                    </div>
                    </div>
            </div>
            <!-- work hours -->
            <div class="input out-inp10">
            <label for="start-time">أوقات العمل</label>
                <div>  
                    <small class="warring-msg">من</small>
                    <input type="time"  name="start-time"  id="start-time">
                    <div>
                        <small class="warring-msg"><?php echo $sTime_error ?></small>
                    </div>
                </div>
                <small class="warring-msg">الى</small>
                <input type="time"  name="end-time"  id="end-time">
                <div>
                    <small class="warring-msg"><?php echo $eTime_error ?></small>
                </div>
            </div>
            <!-- profession-->
            <div class="input out-inp11">
                <label for="required-profession">التخصص المطلوب</label>
                <input type="text" name="required-profession" id="required-profession">
                <div>
                        <small class="warring-msg"><?php echo $reqPro_error ?></small>
                </div>
            </div>
            <!-- Area -->
            <div class="input out-inp12">
                <label for="area">المكان</label>
                <input type="text" name="area" id="area"> 
            </div>
            <div>
                    <small class="warring-msg"><?php echo $area_error?></small>
            </div>
            <!-- Explained Initiative -->
            <div class="input out-inp13">
                <label for="explained-initiative">شرح المبادرة <small class="warring-msg"> (الهدف منها)</small></label>
                <textarea name="explained-initiative" id="explained-initiative" cols="10" rows="10"></textarea>
                <div>
                        <small class="warring-msg"><?php echo $exInit_error ?></small>
                </div>
            </div>
            <!-- Volunteers Roles -->
            <div class="input out-inp14">
                <label for="volunteers-roles">أدوار المتطوعين</label>
                <textarea name="volunteers-roles" id="volunteers-roles" cols="10" rows="10"></textarea>
                <div>
                        <small class="warring-msg"><?php echo $vRoles_error ?></small>
                </div>
            </div>

            <!-- Supervisor -->
            <div class="input out-inp15">
                <label for="supervisor">مشرف المبادرة</label>
                <input type="text" name="supervisor" id="supervisor" disabled value="<?php echo $_SESSION['name']?>">
            </div>
            <!-- Phone number -->
            <div class="input out-inp16">
                <label for="phone">الجوال</label>
                <input type="text" name="phone" id="phone" disabled value="<?php echo '0'.$_SESSION['phone']?>">
            </div>
            <!-- submit btn -->
            <div class="input out-inp17">
                <button type="submit" class="custom-btn">رفع الطلب</button>
            </div>
        </form>
    </div>
</main>

<?php
require_once "template/footer.php"
?>