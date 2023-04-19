<?php

session_start();
if(isset($_SESSION['fb_userid']))
{  
    $_SESSION['fb_userid']=NULL;
    unset($_SESSION['fb_userid']);
}


header("Location:login.php");
die;
