<main>
    <div class="innerFormContianer">
        <form action="" method="POST" >
            <!-- Facility Name -->
            <div class="input inp1">
                <label for="">أسم المنشاة</label>
                <input type="text" disabled value="<?php echo $opportRequest['facility_name'] ?>">
            </div>
            <!-- Department Name-->
            <div class="input inp2">
                <label for="">القسم</label>
                <input type="text" disabled value="<?php echo $opportRequest['department'] ?>" >
            </div>
            <!-- Volunteer Opportunity Name -->
            <div class="input inp3">
                <label for="">أسم الفرصة التطوعية</label>
                <input type="text" disabled value="<?php echo $opportRequest['opportunity_name'] ?>">
            </div>
            <!-- Opportunity Type -->
            <div class="input inp4">
                <label for="opportunity-type">نوع الفرصة التطوعية</label>
                <input type="text" name="opportunity-type"  id="opportunity-type" disabled value="<?php echo $opportRequest['opportunity_name'] ?>">
            </div>
            <!-- men/women numbers -->
            <div class="input inp5">
                <label for="">العدد المطلوب</label>
                <div>
                    <label for="men-number"><small class="warring-msg">رجال</small></label>
                    <input name="men-number" id="men-number" type="number" disabled value="<?php echo $opportRequest['men_number']?>">
                    
                </div>
                <div>
                    <label for="women-number"><small class="warring-msg">نساء</small></label>
                    <input name="women-number" id="women-number" type="number" disabled value="<?php echo $opportRequest['women_number']?>">
                    
                </div>
            </div>
            <!--  -->
            <div class="input inp6">
                <label for="">مدة الفرصة <small class="warring-msg">يوم</small></label>
                <input type="number" pattern="[0-9]+" min="0" disabled value="<?php echo $opportRequest['opportunity_duration'] ?>">
            </div>
            <!-- Stating Date -->
            <div class="input inp7">
                <label for="">تاريخ بداية الفرصة</label>
                <input type="date"  name="start-date"  id="start-date" disabled value="<?php echo $opportRequest['start_date'] ?>">
            </div>
            <!-- work hours -->
            <div class="input inp8">
                <label for="">أوقات العمل</label>
                <input type="time"  name="start-time"  id="start-time" disabled value="<?php echo $opportRequest['start_time'] ?>">
                <small class="warring-msg">من</small>
                <input type="time"  name="end-time"  id="end-time" disabled value="<?php echo $opportRequest['end_time'] ?>">
                <small class="warring-msg">الى</small>
            </div>
            <!-- Nedded -->
            <div class="input inp9">
                <label for="">التخصص المطلوب</label>
                <input type="text" disabled value="<?php echo $opportRequest['required_profession'] ?>">
            </div>
            <!-- OX-->
            <div class="input inp10">
                <label for="OX">شرح الفرصة <small class="warring-msg">الهدف منها</small></label>
                <textarea name="OX" id="OX" cols="10" rows="10" disabled><?php echo $opportRequest['explained_opportunity'] ?></textarea>
            </div>
            <!--  -->
            <div class="input inp11">
                <label for="">أدوارالمتطوعين</label>
                <textarea name="" id="" cols="10" rows="10" disabled><?php echo $opportRequest['volunteers_roles']; ?></textarea>
            </div>

            <!--  -->
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