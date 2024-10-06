<?php

session_start();

if(isset($_POST['Submit'])){

    if($_POST['kod_prod'] == $_SESSION['message']){

        $_SESSION['password'] = md5($_SESSION['password']);
        
        $conn = mysqli_connect("localhost", "root", "", "it");

        $baza = "INSERT INTO `student` (fio,number,data_bird,email,password,fiop,numberp) 
        VALUES ('$_SESSION[fio]',
                '$_SESSION[phone]',
                '$_SESSION[koki]',
                '$_SESSION[email]',
                '$_SESSION[password])',
                '$_SESSION[FIO]',
                '$_SESSION[PHONE]')";
        
        $conn->query($baza);
        $mysqli->close();
        header("Location: rega3.php");
    }
    
    else{
        echo "LOXPED KAVO NAEBAT PITAESA";
    }
}?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <body>

        <form id="registration-form" action="" method="POST">

            <input type="text" id="kod-prod" name="kod_prod" require>
            <input type="submit" name="Submit"/>

        </form>
    </body>
</html>