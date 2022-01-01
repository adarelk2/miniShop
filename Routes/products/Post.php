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

define("EDIT_PRODUCT","EDIT_PRODUCT");//עריכת מוצר
define("DELETE_PRODUCT","DELETE_PRODUCT");// מחיקת מוצר

$response = new Response();
$state = true;
$msg = "הצלחנו";
$function = "created";

if(isset($_POST['model']))//אם יש מודל
{
    switch($_POST['model'])
    {
        case EDIT_PRODUCT:
            command(checkPermission(),"אין לך הרשאות עבור פעולה זאת");
            if($state)
            {
                $product = new Product($_POST['details']['id']);
                command($product);
                if($state)
                {
                    setResponse($product->updateProduct($_POST['details']));
                }
            }
            echo $response->$function()->setState($state)->setMsg($msg)->renderToEncode();
            break;   
        case DELETE_PRODUCT:
            command(checkPermission(),"אין לך הרשאות עבור פעולה זאת");
            if($state)
            {
                $product = new Product($_POST['id']);
                command($product);
                if($state)
                {
                    setResponse($product->deleteProduct());
                }
            }
            echo $response->$function()->setState($state)->setMsg($msg)->renderToEncode();
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
