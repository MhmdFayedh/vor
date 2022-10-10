<?php
$title = 'أدارة المستخدمين';
require_once  '../template/header.php';

// Fetch the users data to diplay it into the table
$usersQuery = "SELECT * FROM users";
$users = $dbConn->query($usersQuery)->fetch_all(MYSQLI_ASSOC);


// Whene 'delete-user' post it, delete the user based on users.id form database isset($_POST['user-id'])
if($_SERVER['REQUEST_METHOD'] == "POST"){

    //BUG [PREPARE STMT NOT WORKING]
    // $deleteQuery = $dbConn->prepare('DELETE FROM users WHERE id = ?');
    // $deleteQuery->bind_param('i', $userID);
    $userId = $_POST['user-id'];
    // $deleteQuery->execute();
    $dbConn->query('DELETE FROM users WHERE id = '.$userId);
    $_SESSION['msg'] = 'تم حذف المستخدم ';
    if(!$dbConn->query('DELETE FROM users WHERE id = '.$userId)):
        $_SESSION['msg'] = 'حدثت مشكلة '.$dbConn->errno;
    else:
        header('Location: index.php');
        die();
    endif;
}


?>



    <table>
        <thead>
            <tr>
                <td>#</td>
                <td>أسم المستخدم</td>
                <td>ألاسم</td>
                <td>نوع المستخدم</td>
                <td></td>
                <td></td>
                <td>تم الانشاء</td>
                <td><a href="create.php"><img src="../../assets/imgs/add-user.png" alt="" style="width:30px ;"></a></td>
                <td>عدد المستخدمين (<?php echo count($users) ?>)</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user):?>
                <tr>
                    <td><?php echo $user['id'] ?></td>
                    <td><?php echo $user['username']?></td>
                    <td><?php echo $user['name']?></td>
                    <td><?php if($user['role'] == 'admin'){echo 'مدير';}
                            if($user['role'] == 'supervisor'){echo 'مشرف';}
                    ?></td>
                    <td><button class="user-handler-btn  edit-btn"><a href="edit.php?id=<?php echo $user['id'] ?>">تعديل</a></button></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" value="<?php echo $user['id'] ?>" name="user-id">
                            <button onclick="return confirm('متأكد من حذف المستخدم <?php echo $user['name'] ?> ؟')" class="user-handler-btn del-btn" name="delete-user" type="submit">حذف</button>
                        </form>
                    </td>
                    <td><?php echo $user['created_time']?></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>



<?php
require_once  '../template/footer.php';
?>