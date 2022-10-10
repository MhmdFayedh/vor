<?php $title = 'أرشيف المبادرات التطوعية';
require_once '../template/header.php';
$inits_arcive = "SELECT * FROM voluntary_initiatives  WHERE `status` = 'rejected' OR  `status` =  'done' ";
$inits = $dbConn->query($inits_arcive);

if(!isset($_GET["volunteers"])):
?>

<table>
    <thead>
        <tr>
            <td>#</td>
            <td>أسم الفرصة التطوعية</td>
            <td>أسم المنشأة</td>
            <td>حالة الفرصة</td>
            <td>الحالة</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
    <?php foreach($inits as $init):?>
        <tr>
        <td><?php echo $init['id'] ?></td>
                        <td><?php echo $init['initiative_name'] ?></td>
                        <td><?php echo $init['facility_name'] ?></td>
                        <td>فرصة تطوعية</td>
                        <td>
                            <?php if($init['status'] == 'accepted'):?>
                                <span class='status-btn accepted-btn' >مقبول</span>
                            <?php endif;?>

                            <?php if($init['status'] == 'rejected'):?>
                                <span class='status-btn rejected-btn' >مرفوض</span>
                            <?php endif;?>
                        </td>
                        <td>
                            <?php if($init['status'] == 'accepted'): ?>
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
        $initNames = "SELECT * FROM initiative_names WHERE i_id = ".$_GET['inames'];
        $inamesQ = $dbConn->query($initNames)
        ->fetch_all(MYSQLI_ASSOC);

        require_once '../template/header.php';
        // require an interface to disply the o_names that loop based on the query "Opportunities_Names" table num_rows 
        require '../template/o_volunteers.php';

        require_once '../template/footer.php';
    endif;
endif;