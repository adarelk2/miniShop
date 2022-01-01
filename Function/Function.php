<?php
function checkPermission()
{
    return (isset($_SESSION['login']) && $_SESSION['login']) ? true : false;
}

function command($callback,$_msg = "הפעולה נכשלה, יש לפנות לצוות פיתוח")//function for response controll אין להשתמש בפונקציה זאת יותר
{
    global $msg;
    global $state;
    global $function;
    $update = $callback;
    if(!$update || isset($update->errors) && !empty($update->errors))
    {
        $msg = $_msg;
        if(isset($update->errors))
        {
            $msg = implode(",",$update->errors);
        }
        $state = false;
        $function = "success";
    }

    return $update;
}

function setResponse($callback,$_msg = "הפעולה נכשלה, יש לפנות לצוות פיתוח")//פונקציה שמכינה את הרספונס יש להשתמש בה כעת
{
    global $msg;
    global $state;
    global $function;
    $update = $callback;
    if(!$update || isset($update->errors) && !empty($update->errors))
    {
        $msg = $_msg;
        if(isset($update->errors))
        {
            $msg = implode(",",$update->errors);
        }
        $state = false;
        $function = "success";
    }
    else
    {
        $msg = $update;
    }
    return $update;
}
?>