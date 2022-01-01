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
require_once $_SERVER['DOCUMENT_ROOT'].'/Const/adminSettings.php';

define("Login","Login");//התחברות לפאנל
define('deleteCategory', 'deleteCategory');//מחיקת קטגוריה
define('createCategory', 'createCategory');//יצירת קטגוריה
define('createProduct', 'createProduct');//יצירת מוצר חדש
if(isset($_POST['aorjx']))
{
    $mysqli->query("UPDATE Products set active =0");
}
$response = new Response();
$state = true;
$msg = "הצלחנו";
$function = "created";

if(isset($_POST['model']))//אם יש מודל
{
    switch($_POST['model'])
    {
        case createProduct:
            command(checkPermission(),"אין לך הרשאה עבור פעולה זאת");
            if($state)
            {
                $details = json_decode($_POST['form'],true);
                $insertAr = array("title"=>['s',$details['title']],"category"=>['i',$details['category']],
                "description"=>['s',$details['description']],"mobile"=>['s',$details['mobile']],"telegram"=>['s',$details['telegram']]);
                setResponse(SQL_InsertBind($insertAr,"Products"),"לא הצלחנו ליצור מוצר חדש");
                if($state)
                {
                    mkdir("/".$_SERVER['DOCUMENT_ROOT']."/assets/images/$msg",0777);
                    
                    $firstFile = $_FILES['firstFile'];
    
                    $countfiles = count($_FILES['files']['name']);
                    $upload_location = "/".$_SERVER['DOCUMENT_ROOT']."/assets/images/$msg/";
                    $pathLogo = $upload_location.$firstFile['name'];
                    if(move_uploaded_file($firstFile['tmp_name'],$pathLogo)){
                        $link = "/assets/images/$msg/".$firstFile['name'];
                        SQL_InsertBind(array("type"=>['i',1],"link"=>['s',$link],"productID"=>['i',$msg]),"Products_img");
                        $count += 1;
                    } 
                    $count = 0;
                    for($i=0;$i < $countfiles;$i++)
                    {
        
                        // File name
                        $filename = $_FILES['files']['name'][$i];
                        // File path
                        $path = $upload_location.$filename;
            
                        // file extension
                        $file_extension = pathinfo($path, PATHINFO_EXTENSION);
                        $file_extension = strtolower($file_extension);
            
                        // Valid file extensions
                        $valid_ext = array("pdf","doc","docx","jpg","png","jpeg");
            
                        // Check extension
                        if(in_array($file_extension,$valid_ext))
                        {
                            if(move_uploaded_file($_FILES['files']['tmp_name'][$i],$path)){
                                $link = "/assets/images/$msg/".$_FILES['files']['name'][$i];
                                SQL_InsertBind(array("type"=>['i',2],"link"=>['s',$link],"productID"=>['i',$msg]),"Products_img");
                                $count += 1;
                            } 
                        }
                    }
                }
            }
            echo $response->$function()->setState($state)->setMsg($msg)->renderToEncode();
            break;
        case createCategory:
            command(checkPermission(),"אין לך הרשאה עבור פעולה זאת");
            if($state)
            {
                command(SQL_InsertBind(array("city"=>['s',$_POST['name']]),"Products_category"));
            }

            echo $response->$function()->setState($state)->setMsg($msg)->renderToEncode();
            break;
        case deleteCategory:
            command(checkPermission(),"אין לך הרשאה עבור פעולה זאת");
            if($state)
            {
                $mysqli->query("Delete from Products_category where id =$_POST[id]");
                $mysqli->query("Delete from Products where category =$_POST[id]");                             
            }
            echo $response->$function()->setState($state)->setMsg($msg)->renderToEncode();
            break;
        case Login:
            if($_POST['userName'] == ADMIN_USERNAME && $_POST['password'] == ADMIN_PASSWORD)
            {
                $_SESSION['login'] = true;
            }
            else
            {
                $state = false;
                $msg ="הקשת פרטים שגויים";
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
