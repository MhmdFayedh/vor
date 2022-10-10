<?php
$title = 'الصفحة الرئيسية';
require_once 'template/header.php';


?>


<main>
    <div class="btns-continer">
        <div class="">
            <button class="custom-btn btn-req "><a href="opportunities">رؤية الفرص التطوعية</a></button>
        </div>
        <div class="">
            <button class="custom-btn btn-req "><a href="initiatives">رؤية المبادرات التطوعية</a></button>
        </div>
        <div class="outer-request">
            <button class="custom-btn btn-req "><a href="users">إدارة المستخدمين</a> </button>
        </div>
        <div class="">
            <button class="custom-btn btn-req"><a href="archives">الارشيف</a></button>
        </div>
    </div>
</main>


<?php
require_once 'template/footer.php';
?>