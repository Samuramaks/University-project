<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/classes/CDataBase.php');

$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
$quest = filter_var(trim($_POST['quest']), FILTER_SANITIZE_STRING);
$school = filter_var(trim($_POST['school']), FILTER_SANITIZE_STRING);

$CDataBase = new CDataBase;
$login = $_COOKIE['login'];
if ($login == ''){
    $CDataBase->close();
    header('Location: /html/registration.php');
}
else{
    if (mb_strlen($name) > 5){
        $user = $CDataBase->questions($login, $name, $quest,$school);
        require_once($_SERVER["DOCUMENT_ROOT"] . '/layOut/header.php');
        echo "<div class='center'> <p> Спасибо за обращение! Мы ответим как можно скорее! </p> <br> <a href=\"/index.php\" style='text-decoration: none'> Вернуться на главную </a></div>";
        print "";
        require_once($_SERVER["DOCUMENT_ROOT"] . '/layOut/footer.php');
    }
    else{
        echo "Недопустимый ввод в поле 'ФИО'";
        exit();
    }
}

$CDataBase->close();