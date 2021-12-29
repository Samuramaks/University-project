<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/layOut/header.php');
?>

    <div class="container mt-4">
        <h1>Авторизация</h1>
        <form action="../request/Rlogin.php" method="post">
            <input class="oneline_input" type="text" class="form-control" name="login" id="login" placeholder="Введите логин"> <br> <br>
            <input class="oneline_input" type="password" class="form-control" name="pas" id="pas" placeholder="Введите пароль"> <br> <br>
            <button class="btn btn-success">Войти</button>
        </form>
    </div>



<?php
if ($_GET['error'] == "wronginput"){
    echo "<br><p style='text-align: center'>Ошибка. Пользователь не существует либо пароль/логин были набраны неверно.</p>";
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/layOut/footer2.php');
?>