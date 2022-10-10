<main>
    <div class="outerFormContiner">
        <form action="" method="POST">
            <!-- Facility Name -->
            <div class="input out-inp1">
                <label for="">أسم المنشاة</label>
                <input type="text" disabled value="<?php echo $initiRequest['facility_name'] ?>">
            </div>
            <!-- Department Name-->
            <div class="input out-inp2">
                <label for="">القسم</label>
                <input type="text" disabled value="<?php echo $initiRequest['department']?>">
            </div>
            <!-- Volunteer Opportunity Name -->
            <div class="input out-inp3">
                <label for="">أسم المبادرة التطوعية</label>
                <input type="text" disabled value="<?php echo $initiRequest['initiative_name']?>">
            </div>
            <!-- Volunteer Opportunity Name -->
            <div class="input out-inp4">
                <label for="">نوعها</label>
                <input type="text" disabled value="<?php echo $initiRequest['initiative_type']?>">
            </div>
            <!--  -->
            <div class="input out-inp5">
                <label for="">طبيعة علاقة الفرص التطوعية </label>
                <input type="text" disabled value="<?php echo $initiRequest['relationship_nature']?>">
            </div>
            <!-- men/women numbers -->
            <div class="input out-inp6">
                <label for="">العدد المطلوب</label>
                <div>
                    <label for="men-number"><small class="warring-msg">رجال</small></label>
                    <input name="men-number" id="men-number" type="number" disabled value="<?php echo $initiRequest['men_number']?>">
                    
                </div>
                <div>
                    <label for="women-number"><small class="warring-msg">نساء</small></label>
                    <input name="women-number" id="women-number" type="number" disabled value="<?php echo $initiRequest['women_number']?>">
                    
                </div>
            </div>
            <!--  -->
            <div class="input out-inp7">
                <label for="">مدة الفرصة</label>
                <input type="number" disabled value="<?php echo $initiRequest['initiative_duration']?>">
            </div>
            <!-- Stating Date -->
            <div class="input out-inp8">
                <label for="">تاريخ بداية الفرصة</label>
                <input type="date" name="start-date"  id="start-date" disabled value="<?php echo $initiRequest['start_date']?>">
            </div>
            <!-- work hours -->
            <div class="input out-inp9">
                <label for="">أوقات العمل</label>
                <input type="time" name="start-time"  id="start-time" disabled value="<?php echo $initiRequest['start_time']?>">
                <input type="time" name="end-time"  id="end-time" disabled value="<?php echo $initiRequest['end_time']?>">
            </div>
            <!-- Nedded -->
            <div class="input out-inp10">
                <label for="">التخصص المطلوب</label>
                <input type="text" disabled value="<?php echo $initiRequest['required_profession']?>">
            </div>
            <!--  -->
            <div class="input out-inp11">
                <label for="">المكان</label>
                <input type="text"  disabled value="<?php echo $initiRequest['area']?>">
            </div>
            <!-- Volunteer Opportunity Name -->
            <div class="input out-inp12">
                <label for="">أسم الجهة الخارجية</label>
                <input type="text" disabled value="<?php echo $initiRequest['external'] ?>" >
            </div>
            <!-- OX-->
            <div class="input out-inp13">
                <label for="OX">شرح الفرصة (الهدف منها)</label>
                <textarea name="OX" id="OX" cols="10" rows="10" disabled>
                    <?php echo $initiRequest['explained_initiative']?>
                </textarea>
            </div>
            <!--  -->
            <div class="input out-inp14">
                <label for="OX">أدوارالمتطوعين</label>
                <textarea name="OX" id="OX" cols="10" rows="10" disabled>
                    <?php echo $initiRequest['volunteers_roles']?>
                </textarea>
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