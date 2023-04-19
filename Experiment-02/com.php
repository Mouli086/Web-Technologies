<?php

session_start();

$uid=$_SESSION['fb_userid'];
$pid=$_POST['submit'];
$c=mysqli_connect("localhost","root","","mouli_86");
$q2="select * from comments1 where usid='$uid' and postid='$pid'";
$r2=mysqli_query($c,$q2);
if(mysqli_num_rows($r2) >0)
{
   

    $q1="insert into comments1(postid,usid) values('$pid','$uid')";
    $rr=mysqli_query($c,$q1);
   header("Location:profile.php"); 
}
