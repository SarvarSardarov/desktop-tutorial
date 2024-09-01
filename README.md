1 Основной код + в процессе происходит переход на новый файл

<?php
$message = random_int(1000000, 10000000);
if(isset($_POST['SubmitButton'])){
$fio = $_POST['student_fio'];
$phone = $_POST['student_phone'];
$dob = $_POST['student_dob'];
$koki = new DateTime($dob);
$email = $_POST['student_email'];
$password = $_POST['student_password'];
$password_con = $_POST['student_password_confirm'];

$FIO = $_POST['parent_fio'];
$PHONE= $_POST['parent_phone'];

//$conn = mysqli_connect("localhost", "root", "", "it");

if($password != $password_con){
 
    echo '<script>alert("Пароли не совпадают пожалуйста повторно ведите пароль ")</script>'; 

}

else if(((($koki->format('Y') == (date('Y')-18)) &&
(($koki->format('m') == date('m')) && ($koki->format('d') > date('d')) || $koki->format('m') > date('m'))) ||
 ($koki -> format('Y') > date('Y')-18)) && empty($FIO) && empty($PHONE)){
 
    echo '<script>alert("Заполните поля Родители")</script>';

}
else{

$subject = "Код проверки";

$headers = '<br>' . "From: ШколаПро IT" . '<br>';
mail($email, $subject, $message, $headers);

header("Location: regon.php", true);
}
/*
else{
$password = md5($password);
$baza = "INSERT INTO `student` (fio,number,data_bird,email,password,fiop,numberp) 
    VALUES ('$fio','$phone','$dob','$email','$password','$FIO','$PHONE')";
$conn->query($baza);
    //header("Location: regon.php", true);
}
*/
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
    <a href="javascript:history.back()" class="back-arrow">&#8592; Назад</a>
    <div class="container">
        <div class="image-container">
            <img src="img/image_placeholder.png" alt="Image">
            
        </div>
        <div class="form-container">
            <h1>Регистрация</h1>
            
            <form id="registration-form" action="" method="POST">
                <?php ?>
                <fieldset>
                    <legend>Ученик:</legend>
                    <input type="submit" name="SubmitButton"/>
                    

                    <label for="student-fio">ФИО:</label>
                    <input type="text" id="student-fio" name="student_fio" required>

                    <label for="student-phone">Контактный номер:</label>
                    <input type="tel" id="student-phone" name="student_phone" required>

                    <label for="student-dob">Дата рождения:</label>
                    <input type="date" id="student-dob" name="student_dob" required>

                    <label for="student-email">Адрес электронной почты:</label>
                    <input type="email" id="student-email" name="student_email" required>

                    <label for="student-password">Пароль:</label>
                    <input type="password" id="student-password" name="student_password" required>

                    <label for="student-password-confirm">Повторите пароль:</label>
                    <input type="password" id="student-password-confirm" name="student_password_confirm" required>
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

2 Продолжение кода на дугом файле


<?php include 'innn.php'; ?>

<html>
    <head>
        <meta></meta>
    </head>
    <body>
        <form action="" method="post">
<input type="hidden" name="storeRandVal" value="<?php echo $message ?>">
            <fieldset>
                <label for="test_input" id="label_input">Enter value: <?php echo $message;?></label>
                <input id="test_input" name="test_input_p">
                <input type="submit" id="ibutton_send" name="button_post" value="Send"></input>
            </fieldset>
        </form>
    </body>
</html>

<?php
if(isset($_POST['button_post']))
{
    $enteredValue = htmlspecialchars(trim($_POST['test_input_p']));
    $hidden = $_POST['storeRandVal'];

    if($enteredValue == $hidden)
    {
        $conn = mysqli_connect("localhost", "root", "", "it");
        $password = md5($password);
        $baza = "INSERT INTO `student` (fio,number,data_bird,email,password,fiop,numberp) 
        VALUES ('$fio','$phone','$dob','$email','$password','$FIO','$PHONE')";
        $conn->query($baza);
    }

    else if($message != $hidden)
    {
        echo "FALSE";
    }
    
    else
    {
        echo "Er__!";
    }
}
?>
