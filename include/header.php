<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/DB/db-config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Function/Function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="/assets/css/style.css" >    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://use.fontawesome.com/95ff79937c.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>
<img src="/assets/images/logo.png" style="display:block;" class="col-12 col-lg-4 mx-auto">

<header class="container-fluid p-0 mb-2">
<div class="col-lg-7 mx-auto col-12 p-0" style="display:flow-root;background-color:#f2f2f2!important;">
    <div class="mx-2" style='float:left;margin-top:16px;'>

    </div>
    <nav class="navbar navbar-expand-lg navbar-light " style="">
        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">  
            <ul class="navbar-nav ml-auto p-0 text-right" >
                <?php
                $result = $mysqli->query("Select * from Products_category");
                foreach($result as $link)
                {
                    echo "<li class='nav-item'>
                            <a class='nav-link' href='/index.php?category=$link[id]'><span style='font-family:Bold;color:#ef577a;'>$link[city]</span></a>
                        </li>";
                }
                ?>
                <?php
                if(checkPermission())
                {
                    echo "<li class='nav-item'>
                            <a class='nav-link' href='/Admin'><span style='font-family:Bold;color:#ef577a;'>אזור מנהלים</span></a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='/logout.php'><span style='font-family:Bold;color:#ef577a;'>התנתק</span></a>
                        </li>"; 
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="/index.php"><span style='font-family:Bold;color:#ef577a;'>דף הבית</span></a>
                </li>
            </ul>
        </div>
    </nav>
</div>
</header>

<div class="col-lg-7 mx-auto col-12 p-3 text-light" style="background-color:#333;">
    <a href="">
        <img src="/assets/images/banner.jpeg" style="display:block;" class=" px-1 col-12 p-0 mx-auto">
    </a>
