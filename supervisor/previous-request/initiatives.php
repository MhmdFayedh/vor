<?php
$title = "حالة الفرص التطوعية السابقة";
require_once "../template/header.php";

$preOuterQuery = "SELECT * FROM voluntary_initiatives WHERE status IS NOT NULL AND `user_id`=".$_SESSION['user_id'];
$preOuter = $dbConn->query($preOuterQuery);;


if(!isset($_GET['id'])):
?>


<table>
        <thead>
        <tr>
            <td>#</td>
            <td>أسم الفرصة التطوعية</td>
            <td>نوعها</td>
            <td>حالة الطلب</td>
            <td>سبب الرفص\القبول</td>
            <td>رفع الاسماء</td>
        </tr>
        </thead>

        <tbody>
        <?php foreach($preOuter as $outer):?>
                <tr>
                    <td><?php echo $outer['id'] ;?></td>
                    <td><?php echo $outer["initiative_name"] ?></td>
                    <td><?php echo $outer["initiative_type"] ?></td>
                    <td><?php
                            if($outer["status"] == "rejected"){
                                echo "<span class='status-btn rejected-btn' >مرفوض</span>";
                            } elseif($outer["status"] == "accepted") {
                                echo "<span class='status-btn accepted-btn' >مقبول</span>";
                            } elseif($outer["status"] == "done"){
                                echo "<span class='status-btn done-btn' >منتهية</span>";
                            }
                        ?></td>
                    <td><?php echo $outer['reason'] ?></td>
                    <td><?php if($outer['status'] == 'accepted' && $outer['isAdded'] == 0):?>
                            <a href="?id=<?php echo $outer['id']?>"><img src="<?php echo $config['appUrl'].'assets/imgs/group.png'?>" alt="أضافة الاسماء"></a>
                        <?php endif;?></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>

<?php

    else:
        if(isset($_GET['id'])):
            require '../template/i_volunteers.php';
        endif;

endif;

require_once "../template/footer.php";


?>