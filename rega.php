<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer\src\PHPMailer.php';
require 'PHPMailer\src\SMTP.php';
require 'PHPMailer\src\Exception.php';

$mail = new PHPMailer(true);

session_start();

if(isset($_POST['SubmitButton'])){
    $_SESSION['message'] = random_int(1000000,10000000);
    $_SESSION['fio'] = $_POST['student_fio'];
    $_SESSION['phone'] = $_POST['student_phone'];
    $_SESSION['koki'] = new DateTime($_POST['student_dob']);
    $_SESSION['email'] = $_POST['student_email'];
    $_SESSION['password'] = $_POST['student_password'];
    $_SESSION['password_con'] = $_POST['student_password_confirm'];
    
    $_SESSION['FIO'] = $FIO = $_POST['parent_fio'];
    $_SESSION['PHONE'] = $PHONE = $_POST['parent_phone'];

    if($_SESSION['password'] != $_SESSION['password_con']){

        echo '<script>alert("Пароли не совпадают пожалуйста повторно ведите пароль!")</script>';    

    }
    
    else if(((($_SESSION['koki']->format('Y') == (date('Y')-18)) &&
    (($_SESSION['koki']->format('m') == date('m')) && 
     ($_SESSION['koki']->format('d') > date('d')) ||
      $_SESSION['koki']->format('m') > date('m'))) ||
     ($_SESSION['koki'] -> format('Y') > date('Y')-18)) &&
       empty($_SESSION['FIO']) && empty($_SESSION['PHONE'])){
    
        echo '<script>alert("Заполните поля Родители")</script>';
    }
    
    else if(strlen($_SESSION['password']) < 8){
    
        echo '<script>alert("Пароль должен быть не менее 8 символов")</script>';    
    }

    else{
        try {
            $mail->isSMTP();                                     
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'sardarovsarvar@gmail.com';                     
            $mail->Password   = 'wwmiqulvvpngqdpe';
            
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
            $mail->Port       = 465;                   
        
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
        
        $_SESSION['koki'] = $_SESSION['koki'] -> format('d-m-Y');
            header("Location: rega2.php");
        }    
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/font.css">
</head>
<body>
        </div>
        <div class="form-container">
            <h1>Регистрация</h1>
            
            <form id="registration-form" action="" method="POST">
                <?php ?>
                <fieldset>
                    <legend>Ученик:</legend>
                    <input type="submit" name="SubmitButton"/>
                    

                    <label for="student-fio">ФИО:</label>
                    <input type="text" id="student-fio" name="student_fio" require>

                    <label for="student-phone">Контактный номер:</label>
                    <input type="tel" id="student-phone" name="student_phone" require>

                    <label for="student-dob">Дата рождения:</label>
                    <input type="date" id="student-dob" name="student_dob" require>

                    <label for="student-email">Адрес электронной почты:</label>
                    <input type="email" id="student-email" name="student_email" require>

                    <label for="student-password">Пароль:</label>
                    <input type="password" id="student-password" name="student_password" require>

                    <label for="student-password-confirm">Повторите пароль:</label>
                    <input type="password" id="student-password-confirm" name="student_password_confirm" require>
                </fieldset>

                <fieldset>
                    <legend>Родитель:</legend>
                    <label for="parent-fio">ФИО:</label>
                    <input type="text" id="parent-fio" name="parent_fio">

                    <label for="parent-phone">Контактный номер:</label>
                    <input type="tel" id="parent-phone" name="parent_phone">

                   
                </fieldset>
            </form>
        </div>
    </div>
</body>
</html>