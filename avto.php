<?php

$mysqli = new mysqli('localhost', 'root', "", 'it');

$sql = " SELECT * FROM student";
$result = $mysqli->query($sql);

if (isset($_POST['polol'])){
$e = $_POST['em_ail'];
$p = $_POST['password'];
    while($rows=$result->fetch_assoc()){

            if ($rows['email'] == $e && $rows['password'] == md5($p)){
            echo header("Location: rega3.php");
        }

    }
}
$mysqli->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/font.css">
    <script defer src="js/script.js"></script>
</head>
<body>
    <a href="javascript:history.back()" class="back-arrow">&#8592; Назад</a>
    <div class="container">
        <div class="image-container">
            <img src="img/illustration.png" alt="Illustration" class="illustration">
        </div>
        <div class="form-container">
            
        <h1>Открой новые горизонты и пройди этот путь вместе с нами!</h1>
        
        <form action="" method="POST"  id="loginForm">
                
            <?php ?>
                
                <label for="email">Почта*</label>
                <input type="text" id="email" name="em_ail" required>

                <label for="password">Пароль*</label>
                <input type="password" id="password" name="password" required>
                
                <button type="submit" class="submit-button"  name = "polol" >Авторизация</button>

                <div class="links">
        
                <a href="avtozab.php" class="forgot-password" id="forgotPasswordLink">Забыли пароль?</a>
                    <span> | </span>
        
                <a href="rega.php" class="register">Не зарегистрированы?</a>
                    <div>
                        Быстрей аторизируйтесь чтоб узнать много нового и интересного!
                    </div>
                </div>
            </form>
            <div class="social-links">
                <p>Нас можно найти здесь:</p>
                <a href="https://telegram.org/" target="_blank"><img src="img/telegram-icon.png" alt="Telegram"></a>
                <a href="https://vk.com/" target="_blank"><img src="img/vk-icon.png" alt="VK"></a>
                <a href="https://ya.ru/" target="_blank"><img src="img/ya-icon.png" alt="Yandex"></a>
            </div>
        </div>
    </div>
</body>
</html> 