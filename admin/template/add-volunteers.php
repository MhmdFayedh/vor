<main>
    <div class="vol">
        <form method="POST" action="">
            <div>
                <label for="men-number">تعديل عدد الرجال</label>
                <input type="number" name="men-number" id="men-number" value="<?php echo $menNumber ?>">
            </div>

            <div>
                <label for="women-number">تعديل عدد النساء</label>
                <input type="number" name="women-number" id="women-number" value="<?php echo $womenNumber ?>">
            </div>
            <br><br>
            <div>
                <input type="submit" class="custom-btn" name="submit" value="تغيير عدد المتطوعين" >
            </div>
        </form>
    </div>

</main>