<?php
$title = 'تسجيل الدخول';
require_once 'template/header.php';


// For errors handling 
$username_error = $password_error = '';

// To dispaly the value if not completed (UX purposes )
$username = $password = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Filter Username&Password input 
        $username = mysqli_real_escape_string($dbConn, $_POST['username']);
        $password = mysqli_real_escape_string($dbConn, $_POST['user-paswd']);
        // If the filed empty will through an error  
        if(empty($username)):
            $username_error = "يجب وضع أسم المستخدم";
        endif;
        
        if(empty($password)):
            $password_error = "يجب وضع الرمز السري";
        endif;
        // Check if the user in the system
        if(!$username_error && !$password_error){
                $checkUserQuery = $dbConn->query("SELECT * FROM users WHERE username = '$username'");
            

                if(!$checkUserQuery->num_rows){
                    $username_error = "تعذر وجود أسم المستخدم";
                }else{
                    $userInfo = $checkUserQuery->fetch_assoc();
                    $passwordHash = $userInfo['password'];
                    if(password_verify($password, $passwordHash)){
                        $_SESSION['Loggedin'] = true;
                        $_SESSION['user_id'] = $userInfo['id'];
                        $_SESSION['role'] = $userInfo['role'];
                        $_SESSION['name'] = $userInfo['name'];
                        $_SESSION['phone'] = $userInfo['phone'];
                        $_SESSION['msg'] = "تم تسجيل دخولك";
                        
                            if($_SESSION['role'] == 'admin'){header("Location: /vor/admin"); die();}
                            if($_SESSION['role'] == 'supervisor'){header("Location: /vor/supervisor"); die();}

                    }else{
                        $password_error = "معلومات غير صحيحة";
                        }    
                    }
    }
}
?>


<main>
    <div class="form-continer">
        
        <form action="" method="POST" enctype="multipart/form-data">
        <h1>تسجيل الدخول</h1>
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
                    <input type="password" name="user-paswd" id="user-paswd" class="password-inp" value="<?php echo $password?>" class="">
                    <div>
                        <small class="warring-msg"><?php echo $password_error ?></small>
                    </div>
                </div>

                <div class="filed">
                    <input type="submit" class="login-btn"  value="سجل دخولك" >
                </div>
        </form>
    </div>
    
</main>



<?php

require_once 'template/footer.php';

?>