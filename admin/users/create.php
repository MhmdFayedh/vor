<?php
$title = 'أضافة مستخدم';
require_once '../template/header.php';


// For errors handling
$username_error = $password_error = $name_error = $phone_error = $role_error = $sql_error = '';

// To dispaly the value if not submit it correctly (UX purposes )
$username = $password = $name = $phone = $role = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Filter Username&Password input
        $username = $methods->usernameFilter($_POST['username']);
        $password = $methods->passwordFilter($_POST['user-paswd']);
        $name = mysqli_real_escape_string($dbConn, $_POST['name']);
        $role = mysqli_real_escape_string($dbConn, $_POST['role']);
        $phone = $methods->numFilter($_POST['phone']);
        // If the filed empty will through an error
        if(!$username || empty($username)):
            $username_error = "حقل أسم المستخدم فارغ او لا يتوافق مع مواصفات أسم المستخدم";
        endif;

        if(!$password || empty($password)):
            $password_error = "حقل الرمز السري فارغ او لا يتوافق مع مواصقات الرمز السري";
        endif;

        if(empty($name)):
            $name_error = "يجب وضع أسم للمشرف او المدير";
        endif;

        if(empty($role)):
            $role_error = "يجب تحديد دور المستخدم في النظام";
        endif;

        if(!$phone || empty($phone)):
            $phone_error = "حقل الهاتف فارغ او لا يتوافق مع مواصفات الارقام";
        endif;

        // Check if the user in the system
        if(!$username_error && !$password_error && !$name_error && !$role_error && !$phone_error ){
                $checkUserQuery = $dbConn->query("SELECT * FROM users WHERE username='$username' limit 1");

                if($checkUserQuery->num_rows){
                    $username_error = "المستخدم مضاف مسبقًا للنظام";
                }else{
                    $password = password_hash($password, PASSWORD_DEFAULT) ;
                    $addUserQuery = "INSERT INTO users (username, password, name, role, phone ) VALUES ('$username', '$password', '$name', '$role', '$phone')";
                    $addUser = $dbConn->query($addUserQuery);
                    $_SESSION['msg'] = 'تم أنشاء المستخدم بنجاح';
                    if($addUser->error):
                        $sql_error = $dbConn->error;
                        echo "ERROR";
                    else:
                        header("Location: index.php");
                        $_SESSION['notifi'] = "تم أضافة المستخدم";
                        $notifi = $_SESSION['notifi'];
                        die();
                    endif;
                    }
    }
}
?>


<main>

    <div class="form-continer">

        <form action="" method="POST" enctype="multipart/form-data">
            <h1>أضافة مستخدم</h1>
                <div>
                    <small class="warring-msg"><?php echo $sql_error ?></small>
                </div>
                <!-- Username Continer -->
                <div class="filed">
                    <label for="username" class="form-label">أسم المستخدم</label>
                    <input type="text" name="username" id="username" class="username-inp" value="<?php echo $username?>" class="">
                    <div>
                        <small class="warring-msg"><?php echo $username_error ?></small>
                    </div>
                </div>
                <!-- Password Continer -->
                <div class="filed">
                    <label for="user-paswd" class="form-label">الرمز السري</label>
                    <input type="password" name="user-paswd" id="user-paswd" class="password-inp">
                    <div>
                        <small class="warring-msg"><?php echo $password_error ?></small>
                    </div>
                </div>

                <!-- Name Continer -->
                <div>
                    <label for="name" class="form-label">أسم المشرف\المدير</label>
                    <input type="text" name="name" id="name" value="<?php echo $name?>" class="">
                    <div>
                        <small class="warring-msg"><?php echo $name_error ?></small>
                    </div>
                </div>

                <!-- phone Continer -->
                <div>
                    <label for="phone" class="form-label">رقم المشرف\المدير</label>
                    <input type="text" name="phone" id="phone" value="<?php echo $phone?>" class="">
                    <div>
                        <small class="info">Ex: 05********</small>
                    </div>
                    <div>
                        <small class="warring-msg"><?php echo $phone_error ?></small>
                    </div>
                </div>
                <!--  Role Continer -->
                <div class="filed">
                    <label for="role" class="form-label">نوع المستخدم</label>
                    <select name="role" id="role">
                        <option value="supervisor">مشرف</option>
                        <option value="admin">مدير</option>
                    </select>
                    <div>
                        <small class="warring-msg"><?php echo $role_error ?></small>
                    </div>
                </div>

                <div class="filed">
                    <input type="submit" class="login-btn" value="أضافة">
                </div>
        </form>
    </div>

</main>



<?php

require_once '../template/footer.php';

?>