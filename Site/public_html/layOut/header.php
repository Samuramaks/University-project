<!DOCTYPE html>
<html lang = "ru">
<head>
    <meta charset="utf-8">
    <title>Сайт об автошколах</title>
    <meta name="description" content="Сайт об автошколах">
    <link href="../css/style.css" rel="stylesheet" type="text/css"/>
    <link href="../css/reset.css" rel="stylesheet" type="text/css"/>
   <link href="../image/favic.png" rel="shortcut icon" type="image/x-icon"/>
</head>
<body>
<header>
   <div class="topnav">

       <nav><div> <img src="../image/logo.png" class="logo"></div>
        <a href="../index.php"> Главная </a>
        <?php
        if ($_COOKIE['login'] == ''){
            echo "<a href=\"../html/login.php\" class='space'> Войти </a>";
            echo "<a href=\"../html/registration.php\" class='space'> Зарегестрироваться </a>";
        }
        else{
            echo "<a href=\"../html/profile.php\" class='space'>" . $_COOKIE['login'] . "</a>";
            if($_COOKIE['login'] != 'Admin'){
                echo "<a href=\"../html/formquest.php\" class='space'> Задать вопрос </a>";
            }
        }
        if($_COOKIE['login'] == 'Admin'){
            echo "<a href=\"../html/Dataquestions.php\" class='space'> Просмотреть вопросы </a>";
            echo "<a href=\"../html/users.php\" class='space'> Пользователи </a>";
        }
        ?>
        </nav>
   </div>
</header>
<main>