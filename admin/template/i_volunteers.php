<?php

if(!isset($_GET['addVolunteers']) && !isset($_GET['aVolu'])):
$stmt = $dbConn->query("SELECT men_number, women_number FROM voluntary_initiatives WHERE id = ".$_GET['volunteers']." limit 1")
->fetch_array(MYSQLI_ASSOC);
$menNumber = $stmt['men_number'];
$womenNumber = $stmt['women_number']; ?>

    <table>
        <thead>
            <tr>
                <td>الاسم</td>
                <td>الساعات</td>
                <td>رقم الهوية</td>
                <td class="info"> عدد الرجال: <?php echo $menNumber ?></td>
                <td class="info"> عدد النساء: <?php echo $womenNumber ?></td>
                <td class=""><a href="?addVolunteers=<?php echo $_GET['volunteers'] ?>"><img src="../../assets/imgs/add-user.png" alt="" style="width: 30px;"></a></td>
                <td class=""><a href="?aVolu=<?php echo $_GET['volunteers'] ?>"><img src="../../assets/imgs/add.png" alt="" style="width: 30px;"></a></td>
            </tr>
        </thead>

        <tbody>
        <?php foreach($inamesQ as $iname):
            $name = isset($iname['name']) ?  $iname['name']: null;
            $hours  = isset($iname['hours']) ?  $iname['hours']: null;
            $natID = isset($iname['nat_id']) ?  $iname['nat_id']: null;
            ?>
            <tr>
                <td><?php echo $name?></td>
                <td><?php echo $hours?></td>
                <td><?php echo $natID?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php
else:
    if(isset($_GET['addVolunteers'])):
            require '../template/add-volunteers.php';
    endif;

    if(isset($_GET['aVolu'])):
        require '../template/add-volunteers.php';
    endif;

endif;
