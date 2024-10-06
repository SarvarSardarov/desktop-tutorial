<?php

session_start();

if(isset($_POST['psumbit1'])){

    if($_POST['prl'] == $_POST['nvprl']){

        $_SESSION['prl'] = md5($_POST['prl']);

        $mysqli = new mysqli('localhost','root', "", 'it');
        $sql = "SELECT * FROM student";

        $result = $mysqli -> query($sql);
        
        while($per = $result->fetch_assoc()){
            
            if($per['email'] == $_SESSION['email']){

                $sqlll = "UPDATE student SET  password = '$_SESSION[prl]' WHERE ID = '$per[ID]'";
                if(mysqli_query($mysqli, $sqlll)){ 
                    echo "Record was updated successfully."; 
                    header('Location: mysor.php');
                    $mysqli->close();
                } 
                break;
            }
    
        }
    }
        else{
    echo '<script>alert("Неверно введен повторный пароль!")</script>';   
    }
    }

?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Восстановление пароля</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/font.css">
    <script defer src="js/reset-script.js"></script>
</head>
<body>
    <div class="container">
        <div class="image-container">
            <img src="img/reset-illustration.png" alt="Illustration" class="illustration">
        </div>
        <div class="form-container">
            <h1>Восстановить пароль</h1>
            <form action="" method="POST" class="reset-form" id="resetForm">
                <label for="new-password">Новый пароль*</label>
                <input type="password" id="new-password" name="prl" required>

                <label for="confirm-password">Повторите Ваш пароль*</label>
                <input type="password" id="confirm-password" name="nvprl" required>
                <?php?>
                <button  type="submit" name = "psumbit1">Изменить пароль</button>
            </form>
            <div id="notification" class="notification hidden">На вашу почту отправлено письмо для восстановления пароля.</div>
        </div>
    </div>
</body>
</html>