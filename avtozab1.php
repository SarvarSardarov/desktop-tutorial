<?php
session_start();
if(isset($_POST['sumbit1'])){
    if($_SESSION['message'] == $_POST['confirm_password']){
        header('Location: avtozab2.php');
    }
}?>

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
            <h1>Подтвердите полученный код</h1>
            <form action="" method="POST" class="reset-form" id="resetForm">
                

                <label for="confirm-password">Введите код*</label>
                <input type="password" id="confirm-password" name="confirm_password" required>
                <?php ?>
                <input type="submit" name="sumbit1"/>
            </form>
            
        </div>
    </div>
</body>
</html>