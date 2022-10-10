<?php $title = 'أرشيف الفرص التطوعية';
require_once '../template/header.php';
$opps_arcive = "SELECT * FROM volunteer_opportunities WHERE `status` IS NOT NULL";
$opps = $dbConn->query($opps_arcive);


if(!isset($_GET["volunteers"])):
?>

<table>
    <thead>
        <tr>
            <td>#</td>
            <td>أسم الفرصة التطوعية</td>
            <td>أسم المنشأة</td>
            <td>حالة الفرصة</td>
            <td>الاسماء</td>
        </tr>
    </thead>
    <tbody>
    <?php foreach($opps as $opp):?>
        <tr>
        <td><?php echo $opp['id'] ?></td>
                        <td><?php echo $opp['opportunity_name'] ?></td>
                        <td><?php echo $opp['facility_name'] ?></td>
                        <td>
                            <?php if($opp['status'] == 'accepted'):?>
                                <span class='status-btn accepted-btn' >مقبول</span>
                            <?php endif;?>

                            <?php if($opp['status'] == 'rejected'):?>
                                <span class='status-btn rejected-btn' >مرفوض</span>
                            <?php endif;?>
                        </td>
                        <td>
                            <?php if($opp['status'] == 'accepted'): ?>
                                <a href="?volunteers=<?php echo $opp['id']?>" class="details-btn">المتطوعين</a>
                            <?php endif; ?>
                        </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php
else:
    if(isset($_GET['volunteers'])):
        $oppNames = "SELECT * FROM opportunities_names WHERE o_id = ".$_GET['volunteers'];
        $onamesQ = $dbConn->query($oppNames)
        ->fetch_all(MYSQLI_ASSOC);

        require_once '../template/header.php';
        // require an interface to disply the o_names that loop based on the query "Opportunities_Names" table num_rows 
        require '../template/o_volunteers.php';

        require_once '../template/footer.php';
    endif;
endif;