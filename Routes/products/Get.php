<?php
session_start();
ini_set('display_errors',0);

require_once $_SERVER['DOCUMENT_ROOT'].'/DB/db-config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Function/FunctionSQL.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Function/Function.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Classes/Response.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Classes/Product.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Const/product.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Const/userType.php';

define("GET_PRODUCTS_LIST","GET_PRODUCTS_LIST");//מחזיר מערך של מוצרים
define("GET_CATEGORIES","GET_CATEGORIES");//מחזיר מערך של כל הקטגוריותd
define('getProduct', 'getProduct');//מחזיר נתונים על מוצר

$response = new Response();
$state = true;
$msg = "הצלחנו";
$function = "created";

if(isset($_GET['model']))//אם יש מודל
{
    switch($_GET['model'])
    {
        case getProduct:
            $product = new Product($_GET['id']);
            setResponse($product);
            if($state)
            {
                $product->link = $product->getProfile();
                $product->images = $product->getAllImage();
                $msg = $product;
            }

            echo $response->success()->setState($state)->setMsg($msg)->renderToEncode();
            break;
        case GET_PRODUCTS_LIST:
            $msg = array();
            
            $where = "where Products.active=1 ";
            if(isset($_GET['category']) && $_GET['category'])
            {
                $where .= " and Products.category=$_GET[category] ";
            }
            
            $logoProduct = $productType['logo'];
            $result = $mysqli->query("Select Products.*,Products_img.link,Products_category.city FROM Products 
            LEFT JOIN Products_img on (Products_img.ProductID = Products.id)
            LEFT JOIN Products_category on (Products_category.id = Products.category) 
            $where and Products_img.type=$logoProduct")->fetch_all(MYSQLI_ASSOC);

            foreach($result as $row)
            {
                $row['userType'] = userRegular;
                if(checkPermission())
                {
                    $row['userType'] = userManager;
                }

                array_push($msg,$row);
            }
            
            echo $response->success()->setState($state)->setMsg($msg)->renderToEncode();
            break;
        case GET_CATEGORIES:
            $result = $mysqli->query("SELECT * FROM Products_category")->fetch_all(MYSQLI_ASSOC);
            echo $response->success()->setState($state)->setMsg($result)->renderToEncode();
            break;
        default:
        echo $response->success()->setState(false)->setMsg("המודל שנבחר אינו קיים במערכת")->renderToEncode();
            break;
    }
}
else
{
    echo $response->success()->setState(false)->setMsg("לא נבחר מודל")->renderToEncode();
}
?>
