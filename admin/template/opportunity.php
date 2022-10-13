
<main>
    <div class="innerFormContianer">
        <form action="" method="POST">
            <!-- Facility Name -->
            <div class="input inp1">
                <label for="facility-name">أسم المنشاة</label>
                <input type="text" name="facility-name" id="facility-name" disabled value="<?php echo $opportRequest['facility_name'] ?>">
                
            </div>
            <!-- Department Name-->
            <div class="input inp2">
                <label for="departmen-name">القسم</label>
                <input type="text" name="departmen-name" id="departmen-name" disabled value="<?php echo $opportRequest['department'] ?>">
            </div>
            <!-- Volunteer Opportunity Name -->
            <div class="input inp3">
                <label for="opportunity-name">أسم الفرصة التطوعية</label>
                <input type="text" name="opportunity-name"  id="opportunity-name" disabled value="<?php echo $opportRequest['opportunity_name'] ?>">

            </div>
            <!-- Volunteer Opportunity Type -->
            <div class="input inp4">
                <label for="opportunity-type">نوع الفرصة التطوعية</label>
                <input type="text" name="opportunity-type"  id="opportunity-type" disabled value="<?php echo $opportRequest['opportunity_type'] ?>">
            </div>
            <!-- men/women numbers -->
            <div class="input inp5">
                <label for="men-number">العدد المطلوب</label>
                <div>
                    <small class="warring-msg">رجال</small>
                    <input name="men-number" id="men-number" type="number" min="0" disabled value="<?php echo $opportRequest['men_number'] ?>">
                </div>
                <div>
                    <small class="warring-msg">نساء</small>
                    <input name="women-number" id="women-number" type="number" min="0" disabled value="<?php echo $opportRequest['women_number'] ?>">
                </div>
            </div>
            <!--  -->
            <div class="input inp6">
                <label for="opportunity_duration">مدة الفرصة <small class="warring-msg">يوم</small></label>
                <input type="number" pattern="[0-9]+" min="0" name="opportunity_duration" id="opportunity_duration" disabled value="<?php echo $opportRequest['opportunity_duration']?>">
            </div>
            <!-- start/end Date -->
            <div class="input inp7">
                <label for="start-date">تاريخ بداية الفرصة</label>
                <div>
                <small class="warring-msg">من</small>
                <input type="date"  name="start-date"  id="start-date" disabled value="<?php echo $opportRequest['start_date'] ?>">
                </div>
                <div>
                <small class="warring-msg">الى</small>
                <input type="date"  name="end-date"  id="end-date" disabled value="<?php echo $opportRequest['end_date'] ?>">
                </div>
            </div>
            <!-- work hours -->
            <div class="input inp8">
                <label for="start-time">أوقات العمل</label>
                <div>
                    <small class="warring-msg">من</small>
                    <input type="time"  name="start-time"  id="start-time" disabled value="<?php echo $opportRequest['start_time'] ?>">
                </div>
                <small class="warring-msg">الى</small>
                <input type="time"  name="end-time"  id="end-time" disabled value="<?php echo $opportRequest['end_time'] ?>">
            </div>
            <!-- Required Profession -->
            <div class="input inp9">
                <label for="required-profession">التخصص المطلوب</label>
                <input type="text" name="required-profession" id="required-profession" disabled value="<?php echo $opportRequest['required_profession'] ?>">
            </div>
            <!-- Explained Opportunity -->
            <div class="input inp10">
                <label for="explained-opportunity">شرح الفرصة <small class="warring-msg">الهدف منها</small></label>
                <textarea name="explained-opportunity" id="explained-opportunity" cols="10" rows="10" disabled><?php echo $opportRequest['explained_opportunity']?></textarea>
            </div>
            <!-- Voluntteers Roles -->
            <div class="input inp11">
                <label for="volunteers-roles">أدوار المتطوعين</label>
                <textarea name="volunteers-roles" id="volunteers-roles" cols="10" rows="10" disabled><?php echo $opportRequest['volunteers_roles'] ?></textarea>
            </div>

        <!-- Acceptance and Rejection Form-->
        <div class="acceptance-rejection inp14">
                <div class="status-select">
                    <label for="status">رفض\قبول الطلب <small class="warring-msg">*</small> </label>
                    <select name="status" id="status">
                        <option value="accepted">قبول</option>
                        <option value="rejected">رفض</option>
                    </select>
                    <div>
                        <small class="warring-msg"><?php echo $status_error ?></small>
                    </div>
                </div>
                
                <div>
                    <label for="reason">سبب الرفض\القبول؟ <small class="warring-msg">*</small></label>
                    <textarea name="reason" id="reason" cols="30" rows="10"></textarea>
                    <div>
                        <small class="warring-msg"><?php echo $reason_error ?></small>
                    </div>
                </div>
                <div>
                    <button class="custom-btn" type="submit" name="submit">رفع حالة الطلب</button>
                </div>
            </div>
        </form>
    </div>
</main>