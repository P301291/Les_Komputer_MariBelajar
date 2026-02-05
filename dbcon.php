<?php

$con = mysqli_connect("localhost","root","","db_user");

if(!$con){
    die('Connection Failed'. mysqli_connect_error());
}

?>