<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer\src\PHPMailer.php';
require 'PHPMailer\src\SMTP.php';
require 'PHPMailer\src\Exception.php';

$mail = new PHPMailer(true);

session_start();

if(isset($_POST['sumbit1'])){

    $_SESSION['email'] = $_POST['confirm_email'];
    $_SESSION['message'] = random_int(1000000,10000000);

    $mysqli = new mysqli('localhost', 'root', "", 'it');

    $sql = " SELECT * FROM student";
    $result = $mysqli->query($sql);

    while($rows=$result->fetch_assoc()){

            if ($rows['email'] == $_SESSION['email']){
                

                try {
                        $mail->isSMTP();                                     
                        $mail->Host       = 'smtp.gmail.com';                     
                        $mail->SMTPAuth   = true;                                   
                        $mail->Username   = 'sardarovsarvar@gmail.com';                     
                        $mail->Password   = 'wwmiqulvvpngqdpe';
                        //$mail->Password   = 'samirka11022';
                        
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
                        $mail->Port       = 465;                   
                    
                        //То что мы получим 
                        $mail->setFrom($_SESSION['email'], 'Debug');
                        $mail->addAddress($_SESSION['email'], 'Joe User');     
                    
                    
                        $meassage = "Kod   " . $_SESSION['message'];
                    
                    
                        $mail->isHTML(true);                                 
                        $mail->Subject = 'IT School';
                        $mail->Body    = $meassage;
                    
                    
                        $mail->send();
                        echo 'На вашу почту был отправлен код проверки пожайлуста ведите ее';
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                header('Location: avtozab1.php');
                break;
            }

    }$mysqli->close();
echo '<script>alert("Введите адрес электронной почты коректно!")</script>';
}



?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Подтвердите почту</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/font.css">
    <script defer src="js/reset-script.js"></script>
</head>
<body>
    <div class="container">
        <div class="image-container">
            <img src="img/12.png" alt="Illustration" class="illustration">
        </div>
        <div class="form-container">
            <h1>Введите почту</h1>
            <form action="" method="POST" class="reset-form" id="resetForm">
                

                <label for="confirm-password">Введите email*</label>
                <input type="email" id="confirm-email" name="confirm_email" required>
                <?php ?>
                <input type="submit" name="sumbit1"/>
            </form>
            
        </div>
    </div>
</body>
</html>