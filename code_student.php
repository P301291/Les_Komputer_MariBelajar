<?php
session_start();
require 'dbcon.php';
if(isset($_POST['save_student']))
{ $student_id = mysqli_real_escape_string($con, $_POST['id']);
    $name = mysqli_real_escape_string($con, $_POST['Nama']);
    $email = mysqli_real_escape_string($con, $_POST['Jenis_Kelamin']);
    $phone = mysqli_real_escape_string($con, $_POST['Kursus']);
    $course = mysqli_real_escape_string($con, $_POST['Alamat']);
    $Date = mysqli_real_escape_string($con, $_POST['Date']);
    $Wa = mysqli_real_escape_string($con, $_POST['No_Hp']);


    $query = "INSERT INTO toy (id,Nama,Jenis_Kelamin,Kursus,Alamat,Date,No_Hp) VALUES ('$student_id','$name','$email','$phone','$course','$Date','$Wa')";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Student Created Successfully";
        header("Location: Beranda.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Created";
        header("Location: Beranda.php");
        exit(0);
    }
}

?>
