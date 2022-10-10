<?php
$title = "طلب فرصة تطوعية";
require_once "template/header.php";



$facilityName = $departmentName = $opportunityName = $opportunityType = $menNumebr = $womenNumber = 
$opportunity_duration = $startDate = $endDate = $startTime = $endTime =
$required_profession = $explained_opportunity = $volunteersRoles = '';

$fName_error = $dName_error = $oName_error = $oType_error =
$mNum_error = $wNum_error = $oDuration_error =
$sDate_error = $eDate_error = $sTime_error =
$eTime_error = $reqPro_error = $exOpp_error = $vRoles_error = '';

if($_SERVER['REQUEST_METHOD'] == "POST"){


$facilityName = mysqli_real_escape_string($dbConn, $_POST['facility-name']);
$departmentName =  mysqli_real_escape_string($dbConn, $_POST['departmen-name']);
$opportunityName = mysqli_real_escape_string($dbConn, $_POST['opportunity-name']) ;
$opportunityType = mysqli_real_escape_string($dbConn, $_POST['opportunity-type']) ;
$menNumebr = mysqli_real_escape_string($dbConn, $_POST['men-number']) ;
$womenNumber = mysqli_real_escape_string($dbConn, $_POST['women-number']) ;
$opportunity_duration = mysqli_real_escape_string($dbConn, $_POST['opportunity_duration']) ;
$startDate = mysqli_real_escape_string($dbConn, $_POST['start-date']);
$endDate = mysqli_real_escape_string($dbConn, $_POST['end-date'] );
$startTime = mysqli_real_escape_string($dbConn, $_POST['start-time']);
$endTime = mysqli_real_escape_string($dbConn, $_POST['end-time']);
$required_profession = mysqli_real_escape_string($dbConn, $_POST['required-profession']);
$explained_opportunity = mysqli_real_escape_string($dbConn, $_POST['explained-opportunity']);
$volunteersRoles = mysqli_real_escape_string($dbConn, $_POST['volunteers-roles']);



if(empty($facilityName)){ $fName_error = 'يجب وضع أسم المنشأة';}
if(empty($departmentName)){ $dName_error = 'يجب وضع أسم القسم';}
if(empty($opportunityName)){ $oName_error = 'يجب وضع أسم الفرصة التطوعية';}
if(empty($opportunityType)){ $oType_error = 'يجب وضع نوع الفرصة التطوعية';}
if(empty($menNumebr)){ $mNum_error = 'يجب وضع عدد الرجال';}
if(empty($womenNumber)){ $wNum_error = 'يجب وضع عدد النساء';}
if(empty($opportunity_duration)){ $oDuration_error = 'يجب وضع مدة الفرصة';}
if(empty($startDate)){ $sDate_error = 'يجب وضع بداية الفرصة';}
if(empty($endDate)){ $eDate_error = 'يجب وضع نهاية الفرصة';}
if(empty($startTime)){ $sTime_error = 'يجب وضع بداية وقت العمل';}
if(empty($endTime)){ $eTime_error = 'يجب وضع نهاية وقت العمل';}
if(empty($required_profession)){ $reqPro_error = 'يجب وضع التخصص المطلوب';}
if(empty($explained_opportunity)){ $exOpp_error = 'يجب وضع شرح الفرصة';}
if(empty($volunteersRoles)){ $vRoles_error = 'يجب وضع أدوار المتطوعين';}

if(!$fName_error && !$dName_error && !$oName_error && !$mNum_error && !$wNum_error &&
!$oDuration_error && !$sDate_error && !$eDate_error && !$sTime_error && !$reqPro_error
&& !$exOpp_error && !$vRoles_error){

    $user_id = $_SESSION['user_id'];
    $insertRequest = "INSERT INTO volunteer_opportunities (facility_name, department, opportunity_name, opportunity_type,"
                    ."men_number, women_number, opportunity_duration, start_date, end_date,"
                    ."start_time, end_time, required_profession, explained_opportunity, volunteers_roles, user_id)"
                    ."VALUES ('$facilityName', '$departmentName', '$opportunityName', '$opportunityName', '$menNumebr', '$womenNumber' ,'$opportunity_duration',"
                    ."'$startDate', '$endDate' ,'$startTime', '$endTime', '$required_profession' ,'$explained_opportunity ', '$volunteersRoles', ".$_SESSION['user_id'].")";

    $notificationQuery = "INSERT INTO `notification` (`message`, `nfor`, `user_id`, `ntime` ) VALUES ('$opportunityName', 'admin', '$user_id', current_timestamp());";

    $innerRequest = $dbConn->query($insertRequest);
    $dbConn->query($notificationQuery);
    if($innerRequest):
        $_SESSION['msg'] = "تم أرسال طلب الفرصة التطوعية";
        header('Location: index.php');
        die();
    elseif($innerRequest->error):
        $_SESSION['msg'] = "حدث خطأ";
    endif;


    $dbConn->query($notificationQuery);
}

}

?>




<main>
    <div class="innerFormContianer">
        <form action="" method="POST">
            <!-- Facility Name -->
            <div class="input inp1">
                <label for="facility-name">أسم المنشاة</label>
                <input type="text" name="facility-name" id="facility-name">
                <div>
                        <small class="warring-msg"><?php echo $fName_error ?></small>
                </div>
            </div>
            <!-- Department Name-->
            <div class="input inp2">
                <label for="departmen-name">القسم</label>
                <input type="text" name="departmen-name" id="departmen-name">
                <div>
                    <small class="warring-msg"><?php echo $dName_error ?></small>
                </div>
            </div>
            <!-- Volunteer Opportunity Name -->
            <div class="input inp3">
                <label for="opportunity-name">أسم الفرصة التطوعية</label>
                <input type="text" name="opportunity-name"  id="opportunity-name">
                <div>
                <small class="warring-msg"><?php echo $oName_error ?></small>
                </div>
            </div>
            <!-- Volunteer Opportunity Type -->
            <div class="input inp4">
                <label for="opportunity-type">نوع الفرصة التطوعية</label>
                <input type="text" name="opportunity-type"  id="opportunity-type">
                <div>
                <small class="warring-msg"><?php echo $oType_error ?></small>
                </div>
            </div>
            <!-- men/women numbers -->
            <div class="input inp5">
                <label for="men-number">العدد المطلوب</label>
                <div>
                    <small class="warring-msg">رجال</small>
                    <input name="men-number" id="men-number" type="number" min="0">
                    <div>
                        <small class="warring-msg"><?php echo $mNum_error ?></small>
                    </div>
                </div>
                <div>
                    <small class="warring-msg">نساء</small>
                    <input name="women-number" id="women-number" type="number" min="0">
                    <div>
                        <small class="warring-msg"><?php echo $wNum_error ?></small>
                    </div>
                </div>
            </div>
            <!--  -->
            <div class="input inp6">
                <label for="opportunity_duration">مدة الفرصة <small class="warring-msg">يوم</small></label>
                <input type="number" pattern="[0-9]+" min="0" name="opportunity_duration" id="opportunity_duration">
                <div>
                    <small class="warring-msg"><?php echo $oDuration_error ?></small>
                </div>
            </div>
            <!-- start/end Date -->
            <div class="input inp7">
                <label for="start-date">تاريخ بداية الفرصة</label>
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
            <div class="input inp8">
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
            <!-- Required Profession -->
            <div class="input inp9">
                <label for="required-profession">التخصص المطلوب</label>
                <input type="text" name="required-profession" id="required-profession">
                <div>
                    <small class="warring-msg"><?php echo $reqPro_error ?></small>
                </div>
            </div>
            <!-- Explained Opportunity -->
            <div class="input inp10">
                <label for="explained-opportunity">شرح الفرصة <small class="warring-msg">الهدف منها</small></label>
                <textarea name="explained-opportunity" id="explained-opportunity" cols="10" rows="10"></textarea>
                <div>
                    <small class="warring-msg"><?php echo $exOpp_error ?></small>
                </div>
            </div>
            <!--  -->
            <div class="input inp11">
                <label for="volunteers-roles">أدوار المتطوعين</label>
                <textarea name="volunteers-roles" id="volunteers-roles" cols="10" rows="10"></textarea>
                <div>
                    <small class="warring-msg"><?php echo $vRoles_error ?></small>
                </div>
            </div>

            <!-- Supervisor -->
            <div class="input inp12">
                <label for="supervisor" >مشرف الفرصة</label>
                <input type="text" name="supervisor" id="supervisor" disabled value="<?php echo $_SESSION['name']?>">
            </div>
            <!-- Phone number -->
            <div class="input inp13">
                <label for="supervisor-phone">الجوال</label>
                <input type="text" name="supervisor-phone" id="supervisor-phone" pattern="{05}[1]{1-9}[8]" disabled value="<?php echo '0'.$_SESSION['phone'] ?>">
            </div>
                <!-- Submit btn -->
            <div class="input inp14">
                <button type="submit" class="custom-btn" id="upload-request">رفع الطلب</button>
            </div>
        </form>
    </div>
</main>

<?php
require_once "template/footer.php"
?>