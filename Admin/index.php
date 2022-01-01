<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/include/header.php';
if(!checkPermission())
{
    echo "<script>location.replace('/login.php');</script>";
}

switch($_GET['page'])
{
    case "Category":
        require_once $_SERVER['DOCUMENT_ROOT'] . '/Admin/Pages/Category.php';
        break;
    case "Product":
        require_once $_SERVER['DOCUMENT_ROOT'] . '/Admin/Pages/Product.php';
        break;
    default:
    require_once $_SERVER['DOCUMENT_ROOT'] . '/Admin/Pages/home.php';
    break;
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php';
?>
