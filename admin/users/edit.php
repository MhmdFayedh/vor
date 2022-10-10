<?php
$title = "تعديل المستخدم";
require_once  '../template/header.php';



if(!isset($_GET['id']) || !$_GET['id']){
    die('Missing id param');
}


// Fetch the user data to disply it into the form
$editUser = $dbConn->prepare("SELECT * FROM users WHERE id = ? limit 1");

$editUser->bind_param('i', $userId);

$userId = $_GET['id'];

$editUser->execute();

$user =  $editUser->get_result()->fetch_assoc();

$username = $user['username'];
$password = $user['password'];
$name = $user['name'];
$phone = $user['phone'];
$role = $user['role'];


$username_error = $password_error = $name_error = $role_error = $phone_error = '';


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // When Post it to update user data {Prepare Stmt}
    $editStmt = $dbConn->prepare('UPDATE users SET username = ?, password = ?, name = ?, phone = ?, role = ? WHERE id = ?');
    $editStmt->bind_param('sssssi', $bindUsername, $bindPassword, $bindName, $bindPhone, $bindRole, $bindId);

    // Binding + cehck if there is post[password] if yes hash it
    $bindUsername = $methods->usernameFilter($_POST['username']) ;
    $_POST['user-paswd'] ? $bindPassword = password_hash($methods->passwordFilter($_POST['user-paswd']), PASSWORD_DEFAULT) : $bindPassword = $user['password'];
    $bindName = $_POST['name'];
    $bindPhone = $methods->numFilter($_POST['phone']); 
    $bindRole = $_POST['role'];
    $bindId = $_GET['id'];
    
    if(!$bindUsername):
        $username_error = "حقل أسم المستخدم فارغ او لا يتوافق مع مواصفات أسم المستخدم";
    endif;

    if(!$bindPassword):
        $password_error = "حقل الرمز السري فارغ او لا يتوافق مع مواصقات الرمز السري";
    endif;



    if(!$bindPhone):
        $phone_error = "حقل الهاتف فارغ او لا يتوافق مع مواصفات الارقام";
    endif;

    $editStmt->execute();

    if($editStmt->error):
        echo $editStmt->error;
    else:
        header('Location: index.php');
        $_SESSION['msg'] = 'تم تعديل المستخدم';
        die();
    endif;
}
?>

<main>

    <div class="form-continer">

        <form action="" method="POST" enctype="multipart/form-data">
        <h1>تعديل مستخدم</h1>
                <!-- Continer -->
                <div class="filed">
                    <label for="username" class="form-label">أسم المستخدم</label>
                    <input type="text" name="username" id="username" class="username-inp" value="<?php echo $username?>" class="">
                    <div>
                        <small class="warring-msg"><?php echo $username_error ?></small>
                    </div>
                    <!--  -->
                <!-- Password Continer -->
                <div class="filed">
                    <label for="user-paswd" class="form-label">الرمز السري</label>
                    <input type="password" name="user-paswd" id="user-paswd"  class="password-inp">
                    <div>
                        <small class="warring-msg"><?php echo $password_error ?></small>
                    </div>
                    <!--  -->

                <!-- name Continer -->
                <div>
                    <label for="name" class="form-label">أسم المشرف\المدير</label>
                    <input type="text" name="name" id="name" value="<?php echo $name?>" class="">
                    <div>
                        <small class="warring-msg"><?php echo $name_error ?></small>
                    </div>
                </div>
                    <!-- Phone Continer -->
                    <div>
                    <label for="phone" class="form-label">رقم المشرف\المدير</label>
                    <input type="text" name="phone" id="phone" value="<?php echo $phone?>" class="">
                    <div>
                        <small class="warring-msg"><?php echo $phone_error ?></small>
                    </div>
                </div>
                <!--  Role Continer -->
                <div class="filed">
                    <label for="role" class="form-label">نوع المستخدم</label>
                    <select name="role" id="role">
                        <option value="supervisor"
                        <?php if($role == 'supervisor') echo 'selected'?> >مشرف</option>
                        <option value="admin"
                        <?php if($role == 'admin') echo 'selected'?>>مدير</option>
                    </select>
                    <div>
                        <small class="warring-msg"><?php echo $role_error ?></small>
                    </div>

                </div>

                <div class="filed">
                    <input type="submit" value="تعديل" class="login-btn">
                </div>
        </form>
    </div>

</main>


<?php
require_once  '../template/footer.php';
?>