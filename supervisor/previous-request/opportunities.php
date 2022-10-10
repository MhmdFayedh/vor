<?php
$title = "حالة الفرص التطوعية السابقة";
require_once "../template/header.php";

$preInnerQuery = "SELECT * FROM volunteer_opportunities WHERE status IS NOT NULL AND `user_id`=".$_SESSION['user_id'];
$preInner = $dbConn->query($preInnerQuery);


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
            <?php foreach($preInner as $inner):?>
                <tr>
                    <td><?php echo $inner['id'] ;?></td>
                    <td><?php echo $inner["opportunity_name"] ?></td>
                    <td><?php echo $inner["opportunity_type"] ?></td>
                    <td><?php
                                if($inner["status"] == "rejected"){
                                    echo "<span class='status-btn rejected-btn' >مرفوض</span>";
                                } elseif($inner["status"] == "accepted") {
                                    echo "<span class='status-btn accepted-btn' >مقبول</span>";
                                } elseif($inner["status"] == "done"){
                                    echo "<span class='status-btn done-btn' >منتهية</span>";
                                }
                        ?></td><a href=""><img src="" alt=""></a>
                    <td><?php echo $inner['reason'] ?></td>
                    <td><?php if($inner['status'] == 'accepted' && $inner['isAdded'] == 0 ):?>
                            <a href="?id=<?php echo $inner['id']?>"><img src="<?php echo $config['appUrl'].'assets/imgs/group.png'?>" alt="أضافة الاسماء"></a>
                        <?php endif;?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
    </table>

<?php

    else:
        if(isset($_GET['id'])):
            require '../template/o_volunteers.php';
        endif;

endif;

require_once "../template/footer.php";


?>