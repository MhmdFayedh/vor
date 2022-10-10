<?php
if(!isset($_GET['addVolunteers'])):
$stmt = $dbConn->query("SELECT men_number, women_number FROM volunteer_opportunities WHERE id = ".$_GET['volunteers']." limit 1")
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
                    <?php foreach($onamesQ as $oname):
                        $name = isset($oname['name']) ?  $oname['name']: "No recorde";
                        $hours  = isset($oname['hours']) ?  $oname['hours']: "No recorde";
                        $natID = isset($oname['nat_id']) ?  $oname['nat_id']: "No recorde";
                    ?>
                    <tr>
                        <td><?php echo $name ?></td>
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
        require '../template/aVolu.php';
    endif;

endif;
