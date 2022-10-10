<?php
$title = 'الأرشيف';
require_once 'template/header.php';
$opps_arcive = "SELECT * FROM volunteer_opportunities WHERE `status` IS NOT NULL";
$opps = $dbConn->query($opps_arcive);


$inits_arcive = "SELECT * FROM voluntary_initiatives  WHERE `status` IS NOT NULL";
$inits = $dbConn->query($inits_arcive);




if(!isset($_GET["onames"]) && !isset($_GET["inames"])):
?>

<div>
        <table>
            <thead>
                <tr>
                    <td>#</td>
                    <td>أسم الفرصة\المبادرة التطوعية</td>
                    <td>أسم المنشأة</td>
                    <td>فرصة\مبادرة تطوعية</td>
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
                        <td>فرصة تطوعية</td>
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
                                <a href="?onames=<?php echo $opp['id']?>" class="details-btn">المتطوعين</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach;?>

                <?php foreach($inits as $init):?>

                    <tr>
                        <td><?php echo $init['id'] ?></td>
                        <td><?php echo $init['initiative_name'] ?></td>
                        <td><?php echo $init['facility_name'] ?></td>
                        <td>مبادرة تطوعية</td>
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
                                <a href="?inames=<?php echo $init['id'] ?>" class="details-btn">المتطوعين</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach;?>
            </tbody>
        </table>

</div>


<?php
require_once '../template/footer.php';
else:
    if(isset($_GET['onames'])):
        $oppNames = "SELECT * FROM opportunities_names WHERE o_id = ".$_GET['onames'];
        $onamesQ = $dbConn->query($oppNames)->fetch_all(MYSQLI_ASSOC);

        require_once '..template/header.php';

        // require an interface to disply the o_names that loop based on the query "Opportunities_Names" table num_rows 
        require '../template/o_volunteers.php';


        require_once 'template/footer.php';
    endif;

    if(isset($_GET['inames'])):
        $initNames = "SELECT * FROM initiative_names WHERE i_id = ".$_GET['inames'];
        $inamesQ = $dbConn->query($initNames)->fetch_all(MYSQLI_ASSOC); 

        
        require_once '../template/header.php';

        // require an interface to display the i_names that loop based on the query "Initiatives_Names" table num_rows 
        require '../template/i_volunteers.php';


        require_once '../template/footer.php';


    endif;
endif;
?>