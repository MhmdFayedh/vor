<main>
    <div class="vol">
        <form method="POST" action="">
            <div>
                <label for="name">أسم المتطوع</label>
                <input type="text" name="name" id="name" value="<?php echo $name ?>">
                <div>
                    <small class="warring-msg"><?php echo $natId  ?></small>
                </div>
            </div>

            <div>
                <label for="nat-id">الهوية الوطنية للتطوع</label>
                <input type="text" name="nat-id" id="nat-id" value="<?php echo $natId ?>">
                <div>
                    <small class="warring-msg"><?php echo  $natId_error  ?></small>
                </div>
            </div>


            <div>
                <label for="hours">عدد الساعات</label>
                <input type="number" name="hours" id="hours" value="<?php echo $hours  ?>">
                <div>
                    <small class="warring-msg"><?php echo $hours_error  ?></small>
                </div>
            </div>
            <br><br>
            <div>
                <input type="submit" class="custom-btn" name="submit" value="أضاقة متطوع" >
            </div>
        </form>
    </div>

</main>