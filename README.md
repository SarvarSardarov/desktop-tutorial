<?php

$login = $_POST['login'];
$pass = $_POST['pass'];
$email = $_POST['email'];
$repit = $_POST['repit'];

$conn = mysqli_connect("localhost", "root", "", "mydock");

if (empty($login) || empty($pass) || empty($email) || empty($repit)){
    echo "Заполните все поля ";
} else
{
    if ($pass != $repit){
        echo "";
    }
    else
    {
        if(strlen($login) < 26 && strlen($login) > 2 && strlen($pass) > 7){
            $domain = substr(strrchr($email, "@"), 1);
            
            $pass = pack('H*', $pass);
            $pass = md5("sik" . $pass);
            $sql = "INSERT INTO `users` (login, pal, email) 
            VALUES ('$login', '$pass', '$email')";

            if($conn -> query($sql) === TRUE){
                echo "Успешная регистрация";
            }
            else{
                echo "Регистрация не удалась!";
            }
        }
        else if (strlen($pass) < 8) {
            echo "Недопустимое количество символов в пароле";
        }
        else{
            echo "Недопустимое количество в имени";
        }
    }
}
?>
