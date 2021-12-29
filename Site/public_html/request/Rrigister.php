<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/classes/CDataBase.php');

$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
$pas = filter_var(trim($_POST['pas']), FILTER_SANITIZE_STRING);

$is_bad = false;

if (mb_strlen($pas) < 3 || mb_strlen($login) > 30){
    $is_bad = true;
}

if (mb_strlen($login) < 5 || mb_strlen($login) > 30){
    $is_bad = true;
}

if ($is_bad){
    header('Location: /html/registration.php?error=wronginput');
    die();
}

$CDataBase = new CDataBase;
if (!$CDataBase->addUser($login, $pas)){
    $CDataBase->close();
    header('Location: /html/registration.php?error=userexists');
    die();
}

setcookie('login', $login, time() + 3600*2, "/");
setcookie('id', $CDataBase->getUserID($login), time() + 3600*2, "/");

$CDataBase->close();

header('Location: /')

?>