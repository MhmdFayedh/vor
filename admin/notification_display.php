<?php
$title = 'الأشعارات';
require_once 'template/header.php';

$message = isset($notify['message'])? $notify['message']: "No Record";
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
                    <td><?php echo  $message?></td>
                    <td><?php echo $time?></td>
                </tr>
    </tbody>

</table>

<?php


require_once 'template/footer.php';