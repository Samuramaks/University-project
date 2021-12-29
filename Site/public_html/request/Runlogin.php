<?php
setcookie('login', $_COOKIE['login'], time() - 3600*2, "/");
setcookie('id', $_COOKIE['id'], time() - 3600*2, "/");

header('Location: /');
?>