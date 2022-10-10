<?php
$title = 'الأشعارات';
require_once 'template/header.php';

$message = isset($notify['meassage'])? $notify['message']: "No Record";
$time = isset($notify['ntime'])? $notify['ntime']: "No Record ";
?>


<table>
    <tbody>
        <thead>
            <tr>
                <td>الاشعار</td>
                <td>الوقت</td>
            </tr>
        </thead>
                <tr>
                    <td><?php echo  $notify['message']?></td>
                    <td><?php echo $notify['ntime']?></td>
                </tr>
    </tbody>

</table>

<?php


require_once 'template/footer.php';