            <!-- New Version -->
            <main>
    <div class="outerFormContiner">
        <form action="" method="POST">
            <!-- Facility Name -->
            <div class="input out-inp1">
                <label for="facility-name">أسم المنشاة</label>
                <input type="text" name="facility-name" id="facility-name" disabled value="<?php echo $initiRequest['facility_name']?>">
            </div>
            <!-- Department Name-->
            <div class="input out-inp2">
                <label for="department-name">القسم</label>
                <input type="text" name="department-name" id="department-name" disabled value="<?php echo $initiRequest['department']?>">
            </div>
            <!-- Volunteer initive Name -->
            <div class="input out-inp3">
                <label for="initiative-name">أسم المبادرة التطوعية</label>
                <input type="text" name="initiative-name" id="initiative-name" disabled value="<?php echo $initiRequest['initiative_name']?>">
            </div>
            <!-- Volunteer initiative Type  -->
            <div class="input out-inp4">
                <label for="initiative-type">نوعها</label>
                <input type="text" name="initiative-type" id="initiative-type" disabled value="<?php echo $initiRequest['initiative_type']?>">
            </div>
            <!-- External -->
            <div class="input out-inp5">
                <label for="external">أسم الجهة الخارجية</label>
                <input type="text" name="external" id="external" disabled value="<?php echo $initiRequest['external']?>" >
            </div>
            <!-- Nature -->
            <div class="input out-inp6">
                <label for="nature">طبيعة علاقة المبادرة التطوعية </label>
                <input type="text" name="nature" id="nature" disabled value="<?php echo $initiRequest['relationship_nature']?>">
                <small class="warring-msg">يحدد من هي الجهة صاحبة المبادرة ومن هي الجهة المشاركة معها</small>
            </div>
            <!-- men/women numbers -->
            <div class="input out-inp7">
                <label for="men-number">العدد المطلوب</label>
                <div>
                    <label for="men-number"><small class="warring-msg">رجال</small></label>
                    <input name="men-number" id="men-number" type="number" disabled value="<?php echo $initiRequest['men_number']?>">

                </div>

                <div>
                    <label for="women-number"><small class="warring-msg">نساء</small></label>
                    <input name="women-number" id="women-number" type="number" disabled value="<?php echo $initiRequest['women_number']?>">
                </div>

            </div>
            <!-- Initiative Duration -->
            <div class="input out-inp8">
                <label for="initiative-duration">مدة المبادرة</label>
                <input type="number" name="initiative-duration" id="initiative-duration" disabled value="<?php echo $initiRequest['initiative_duration']?>">
            </div>
            <!-- start/end Date -->
            <div class="input out-inp9">
                <label for="start-date">تاريخ بداية المبادرة</label>
                    <div>
                    <small class="warring-msg">من</small>
                    <input type="date"  name="start-date"  id="start-date" disabled value="<?php echo $initiRequest['start_date']?>">
                    </div>
                    <div>
                    <small class="warring-msg">الى</small>
                    <input type="date"  name="end-date"  id="end-date" disabled value="<?php echo $initiRequest['end_date']?>">
                    </div>
            </div>
            <!-- work hours -->
            <div class="input out-inp10">
            <label for="start-time">أوقات العمل</label>
                <div>
                    <small class="warring-msg">من</small>
                    <input type="time"  name="start-time"  id="start-time" disabled value="<?php echo $initiRequest['start_time']?>">
                </div>
                <small class="warring-msg">الى</small>
                <input type="time"  name="end-time"  id="end-time" disabled value="<?php echo $initiRequest['end_time']?>">

            </div>
            <!-- profession-->
            <div class="input out-inp11">
                <label for="required-profession">التخصص المطلوب</label>
                <input type="text" name="required-profession" id="required-profession" disabled value="<?php echo $initiRequest['required_profession']?>">
            </div>
            <!-- Area -->
            <div class="input out-inp12">
                <label for="area">المكان</label>
                <input type="text" name="area" id="area" disabled value="<?php echo $initiRequest['area']?>">
            </div>
            <!-- Explained Initiative -->
            <div class="input out-inp13">
                <label for="explained-initiative">شرح المبادرة <small class="warring-msg"> (الهدف منها)</small></label>
                <textarea name="explained-initiative" id="explained-initiative" cols="10" rows="10" disabled><?php echo $initiRequest['explained_initiative'] ?></textarea>
            </div>
            <!-- Volunteers Roles -->
            <div class="input out-inp14">
                <label for="volunteers-roles">أدوار المتطوعين</label>
                <textarea name="volunteers-roles" id="volunteers-roles" cols="10" rows="10" disabled> <?php echo $initiRequest['volunteers_roles'] ?></textarea>
            </div>
            <div class="acceptance-rejection inp14">
                <div class="status-select">
                    <label for="status">رفض\قبول الطلب <small class="warring-msg">*</small> </label>
                    <select name="status" id="status">
                        <option value="accepted">قبول</option>
                        <option value="rejected">رفض</option>
                    </select>
                </div>

                <div>
                    <label for="reason">سبب الرفض\القبول؟ <small class="warring-msg">*</small></label>
                    <textarea name="reason" id="" cols="30" rows="10"></textarea>
                </div>

                <div>
                    <button class="custom-btn" type="submit">رفع حالة الطلب</button>
                </div>
            </div>
        </form>
    </div>
</main>



<?php
require_once "../template/footer.php"
?>