<div class="col-8 col-lg-4 mx-auto mt-3">
    <h2>הוספת קטגוריה למערכת</h2>
    <div class="form-group text-right">
        <label for="category">שם קטגוריה</label>
        <input type="text" id="category" class="form-control">
    </div>
    <div class="col-12 text-center">
        <button class="btn text-center createCategory" style="background-color:#ef577a;color:#fff;">הוספה</button>
    </div>
</div>

<table class="table text-center mx-auto mt-3" style="width:80%;">
    <thead>
        <tr>
            <th scope="col">פעולה</th>
            <th scope="col">שם הקטגוריה</th>
        </tr>
    </thead>
    <tbody id="show_list">
    </tbody>
</table>

<script src="/javascript/Model/Admin/categories.js" type="module"></script>