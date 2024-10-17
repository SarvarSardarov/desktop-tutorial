<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer\src\PHPMailer.php';
require 'PHPMailer\src\SMTP.php';
require 'PHPMailer\src\Exception.php';

$mail = new PHPMailer(true);
session_start();

$mysqli = new mysqli('localhost', 'root', "", 'it');
$sql = " SELECT * FROM student";
$sqlk = "SELECT * FROM komands";
$result = $mysqli->query($sql);
$results = $mysqli->query($sql);
$resultk = $mysqli->query($sqlk);
$ch = 0;
while($rows=$result->fetch_assoc()){
    if($_SESSION['e'] == false){
        header("Location: avto.php");
    }
    else if ($rows['email'] == $_SESSION['e'] && $rows['password'] == md5($_SESSION['p'])){
        break;
    }
}
while($rowk=$resultk->fetch_assoc()){
    if ($rowk['id1'] == $rows['ID'] || $rowk['id2'] == $rows['ID'] || $rowk['id3'] == $rows['ID'] || 
    $rowk['id4'] == $rows['ID'] || $rowk['id5'] == $rows['ID'] || $rowk['id6'] == $rows['ID']){
    break;
    }
}

if(isset($_POST['Sohranit'])){
$fio = $_POST['last_name'] . ' ' . $_POST['first_name'] . ' ' . $_POST['middle_name'];
$number = $_POST['phone'];
$data_bird = $_POST['birthdate'];
$fiop = $_POST['parent_name'];
$numberp = $_POST['parent_phone'];
$ischool = $_POST['school'];
$Socset = $_POST['social_media'];
$sqlll = "UPDATE student SET fio = '$fio', number = '$number', data_bird = '$data_bird', 
    fiop = '$fiop', numberp = '$numberp', ischool = '$ischool', Socset = '$Socset'
     WHERE ID = '$rows[ID]'";
    if(mysqli_query($mysqli,$sqlll)){
        echo '<script>alert("Изменение прошло успешно")</script>';
    }else{echo 'lox';}
}    

else if(isset($_POST['govno'])){

    try {
        $mail->isSMTP();                                     
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'sardarovsarvar@gmail.com';                     
        $mail->Password   = 'wwmiqulvvpngqdpe';
        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
        $mail->Port       = 465;                   
    
        $mail->setFrom('sardarovsarvar@gmail.com');
        $mail->addAddress('sardarovsarvar@gmail.com');        

        $meassage = $_POST['direction'] . "<br/>" . 
                    "Навыки ученика(цы) из сферы IT: " . $_POST['skills'] . "<br/>" . 
                    "Чему хочет научится: " . $_POST['learning_goals'] . "<br/>" .
                    "Есть ли опыт работы в этой сфере: " .  $_POST['experience'];
    
        $mail->isHTML(true);                                 
        $mail->Subject = 'IT School';
        $mail->Body    = $meassage;
    
    
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";        
    }
    }




?>



<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль ученика</title>
    <link rel="stylesheet" href="css/font.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <img src="img/Menuitem.png" alt="Школа проIT">
            </div>
            <div class="student-info">
                <p><?php echo $rows['fio']?></p>
                <p>Направление: <?php echo $rows['Uschool']?></p>
            </div>
            <nav class="menu">
                <ul>
                    <li><a href="#" onclick="showSection('profile')">Профиль</a></li>
                    <li><a href="#" onclick="showSection('team')">Моя команда</a></li>
                    <li><a href="#" onclick="showSection('application')">Заявка</a></li>
                </ul>
            </nav>
            <a class="logout" href="#">
                <img src="img/Vector.png" alt="Выйти">
                Выйти
            </a>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Profile Section -->
            <div id="profile" class="section active">
                <h2>Данные профиля</h2>
                <div class="profile-content">
                    <form action = "" method = "POST" id="profile-form">
                        <div class="form-group">
                            <label for="last-name">Фамилия*</label>
                            

                            


                            <input type="text" id="last-name" value="<?php print_r(explode(' ', $rows['fio'])[0]);?>" name="last_name" required >
                        </div>

                        <div class="form-group">
                            <label for="first-name">Имя*</label>
                            <input type="text" id="first-name" value="<?php print_r(explode(' ', $rows['fio'])[1])?>" name="first_name" required>
                        </div>

                        <div class="form-group">
                            <label for="middle-name">Отчество*</label>
                            <input type="text" id="middle-name" value="<?php print_r(explode(' ', $rows['fio'])[2]);?>" name="middle_name" required>
                        </div>

                        <div class="form-group">
                            <label for="birthdate">Дата рождения*</label>
                            <input type="text" id="birthdate" value="<?php echo $rows['data_bird']?>" name="birthdate" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Почта*</label>
                            <input type="email" id="email" value="<?php echo $rows['email']?>" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">Номер телефона*</label>
                            <input type="text" id="phone" value="<?php echo $rows['number']?>" name="phone" required>
                        </div>

                        <div class="form-group">
                            <label for="school">Место обучения*</label>
                            <input type="text" id="school" value="<?php echo $rows['ischool'];?>" name="school" required>
                        </div>

                        <div class="form-group">
                            <label for="social-media">Социальные сети (Телеграм, ВК и тд)*</label>
                            <input type="text" id="social-media" value="<?php echo $rows['Socset']?>" name="social_media" required>
                        </div>

                        <div class="form-group">
                            <label for="parent-name">ФИО родителя*</label>
                            <input type="text" id="parent-name" value="<?php echo $rows['fiop']?>" name="parent_name" required>
                        </div>

                        <div class="form-group">
                            <label for="parent-phone">Номер родителя*</label>
                            <input type="text" id="parent-phone" value="<?php echo $rows['numberp']?>" name="parent_phone"required>
                        </div>

                        <button name="Sohranit" type="submit">Сохранить</button>
                    
                        
                    </form>
                    <div class="profile-image">
                        <img src="img/rafiki.png" alt="Profile Image">
                    </div>
                
                </div>
            </div>

            
            <!-- Team Section -->
            <div id="team" class="section active">
                <h2>Моя команда</h2>
                <div class="team-grid">
                    <div class="team-box">
                        <p><strong>Наставник:</strong> Фабияк Альбина Александровна</p>
                        <p><strong>Направление:</strong> <?php echo $rows['Uschool']?></p>
                        <p><strong>Тема проекта:</strong> Создание робота пылесоса с динамиками для радио</p>
                    </div>
                    <div class="team-box">
                        <p><strong>Задание</strong></p>
                        <p>Разработать информационный портал об обучающем учреждении с возможностью записи на представленные курсы</p>
                    </div>
                    <div class="team-box">
                        <p><strong>Участники команды</strong></p>
                        <ul>
                            <li><?php while($rots=$results->fetch_assoc()){ if($rowk['id1'] == $rots['ID'] ){ echo $rots['fio'] . "<br/>"; mysqli_data_seek($results,0); $ch = false; break;} else {$ch = true;}} if($ch == true){echo "Нет участника по команде";};?></li>
                            <li><?php while($rots=$results->fetch_assoc()){ if($rowk['id2'] == $rots['ID'] ){ echo $rots['fio'] . "<br/>"; mysqli_data_seek($results,0); $ch = false; break;} else {$ch = true;}} if($ch == true){echo "Нет участника по команде";};?></li>
                            <li><?php while($rots=$results->fetch_assoc()){ if($rowk['id3'] == $rots['ID'] ){ echo $rots['fio'] . "<br/>"; mysqli_data_seek($results,0); $ch = false; break;} else {$ch = true;}} if($ch == true){echo "Нет участника по команде";};?></li>
                            <li><?php while($rots=$results->fetch_assoc()){ if($rowk['id4'] == $rots['ID'] ){ echo $rots['fio'] . "<br/>"; mysqli_data_seek($results,0); $ch = false; break;} else {$ch = true;}} if($ch == true){echo "Нет участника по команде";};?></li>
                            <li><?php while($rots=$results->fetch_assoc()){ if($rowk['id5'] == $rots['ID'] ){ echo $rots['fio'] . "<br/>"; mysqli_data_seek($results,0); $ch = false; break;} else {$ch = true;}} if($ch == true){echo "Нет участника по команде";};?></li>
                            <li><?php while($rots=$results->fetch_assoc()){ if($rowk['id6'] == $rots['ID'] ){ echo $rots['fio'] . "<br/>"; mysqli_data_seek($results,0); $ch = false; break;} else {$ch = true;}} if($ch == true){echo "Нет участника по команде";};?></li>
                        </ul>
                    </div>
                    <div>
                        <img src="img/amico.png" alt="Team Image" class="team-image">
                    </div>
                </div>
            </div>
            

            <div id="application" class="section">
                    <h2>Заявка <div class="aye">(не подана)</div></h2>
                    <form action = "" method = "POST" id="application-form">
                        <div class="form-group form-type">
                            <button type="button" id="project-button" class="form-option">Проект</button>
                            <button type="button" id="intensive-button" class="form-option active">Интенсив</button>
                        </div>
                        
                        <div class="form-group">
                            <label for="direction">Выбор направления</label>
                            <select action = "" id="direction" name="direction" required>
                                <option value="" disabled selected>Выберите направление</option>
                                <option value="Робототехника">Робототехника</option>
                                <option value="Интернет вещей (умный дом)">Интернет вещей (умный дом)</option>
                                <option value="Искусственный интеллект">Искусственный интеллект</option>
                                <option value="WEB-разработка">WEB-разработка</option>
                                <option value="Мобильная разработка">Мобильная разработка</option>
                                <option value="Противодействие дронам">Противодействие дронам</option>
                                <option value="Проектирование нейроинтерфейсов">Проектирование нейроинтерфейсов</option>
                                <option value="Квантовые сети">Квантовые сети</option>
                                <option value="3D-печать и прототипирование">3D-печать и прототипирование</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="skills">Что ты умеешь из сферы IT?</label>
                            <input type="text" id="skills" name="skills" required>
                        </div>
                        <div class="form-group">
                            <label for="learning-goals">Чему ты хочешь научиться?</label>
                            <input type="text" id="learning-goals" name="learning_goals" required>
                        </div>
                        <div class="form-group">
                            <label for="experience">Есть у тебя опыт в разработке?</label>
                            <input type="text" id="experience" name="experience" required>
                        </div>
                        <button name="govno" type="submit" id="submit-button" disabled>Подать заявку</button>
                    </form>
                    <p id="submission-status"></p>
            </div>
        </div>
    </div>   
  

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const submitButton = document.getElementById('submit-button');
    const form = document.getElementById('application-form');

    form.addEventListener('input', function() {
        let allFilled = true;
        form.querySelectorAll('input, select').forEach(input => {
            if (!input.value) {
                allFilled = false;
            }
        });

        if (allFilled) {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = true;
        }
    });
});

        // JavaScript to toggle between the buttons
    document.addEventListener('DOMContentLoaded', function () {
    const projectButton = document.getElementById('project-button');
    const intensiveButton = document.getElementById('intensive-button');
    
    projectButton.addEventListener('click', function () {
        toggleActiveButton(projectButton, intensiveButton);
    });
    
    intensiveButton.addEventListener('click', function () {
        toggleActiveButton(intensiveButton, projectButton);
    });

    function toggleActiveButton(activeButton, inactiveButton) {
        activeButton.classList.add('active');
        inactiveButton.classList.remove('active');
    }
});

        function showSection(sectionId) {
    // Скрыть все секции
    document.querySelectorAll('.section').forEach(section => {
        section.classList.remove('active');
    });
    // Показать выбранную секцию
    document.getElementById(sectionId).classList.add('active');
}

// Убедитесь, что по умолчанию только профильная секция активна
document.addEventListener('DOMContentLoaded', function () {
    showSection('profile');
});

    </script>
</body>
</html>