<?php
$title = 'الصفحة الرئيسية';
require_once "template/header.php"
?>


<main>
    <div class="btns-continer">
        <div class="inner-request">
            <button class="custom-btn btn-req" id="inner-request"><a href="inner-request.php">طلب فرصة تطوعية</a></button>
        </div>
        <div class="outer-request">
            <button class="custom-btn btn-req "><a href="outer-request.php">طلب مبادرة تطوعية</a></button>
        </div>
        <div class="reqevious-request">
            <button class="custom-btn btn-req"><a href="previous-request">رؤية حالة الطلبات السابقة</a></button>
        </div>
    </div>
</main>


<?php
require_once "template/footer.php"

?>