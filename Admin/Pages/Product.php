<div class="col-8 col-lg-4 mx-auto mt-3">
    <h2>הוספת פריט למערכת</h2>
    <div class="form-group text-right">
        <label for="category">שם הפריט</label>
        <input type="text" id="category" class="form-control">
    </div>
    <div class="form-group text-right">
        <label for="description">תיאור הפריט</label>
        <input type="text" id="description" class="form-control">
    </div>
    <div class="form-group text-right">
        <label for="mobile">מספר טלפון</label>
        <input type="text" id="mobile" class="form-control">
    </div>
    <div class="form-group text-right">
        <label for="telegram"> שם משתמש בטלגרם</label>
        <input type="text" id="telegram" class="form-control">
    </div>
    <div class="form-group text-right">
        <label for="category">קטגוריה</label>
        <select class="select2 col-12" id="selectCategory">
            <option value="">בחר</option>
            <?php 
            $result = $mysqli->query("Select * from Products_category");
            foreach($result as $category)
            {
                echo "<option value=$category[id]>$category[city]</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group text-right">
        <label for="firstFile" style="width:100px;" class="btn btn-primary">
            בחר קובץ
        </label>
        <span style="width:100px">:תמונה ראשית</span>
        <input type="file" id="firstFile" style='display:none;'>
    </div>
    <div class="form-group text-right">
        <label for="files" style="width:100px;" class="btn btn-primary">
            בחירה מרובה
        </label>
        <span style="width:100px">:תמונות נוספות </span>
        <input type="file" id="files" name="files" multiple style="display:none;">
    </div>
    <div class="col-12 text-center">
        <button class="btn text-center createCategory" style="background-color:#ef577a;color:#fff;">הוספה</button>
    </div>
</div>

<script src="/javascript/Model/Admin/product.js" type="module"></script>