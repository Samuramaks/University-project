<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/classes/CDataBase.php');

$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
$pas = filter_var(trim($_POST['pas']), FILTER_SANITIZE_STRING);

$is_bad = false;

$CDataBase = new CDataBase;
$user = $CDataBase->authorize($login, $pas);
if ($user == false){
    $CDataBase->close();
    header('Location: /html/login.php?error=wronginput');
    die();
}

setcookie('login', $user['login'], time() + 3600*2, "/");
setcookie('id', $user['id'], time() + 3600*2, "/");

$CDataBase->close();

header('Location: /')

?>