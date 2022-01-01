<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/header.php';
?>

<div class="col-8 col-lg-4 mx-auto mt-3">
    <div class="form-group text-right">
        <label for="userName">שם משתמש</label>
        <input type="text" id="userName" class="form-control">
    </div>
    <div class="form-group text-right">
        <label for="password">סיסמה</label>
        <input type="text" id="password" class="form-control">
    </div>
    <div class="col-12 text-center">
        <button class="btn text-center loginBTN" style="background-color:#ef577a;color:#fff;">התחבר</button>
    </div>
</div>
<script src="/javascript/Model/login.js" type="module"></script>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php';
?>
