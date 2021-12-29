<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/layOut/header.php');
?>

    <div class="container mt-4">
        <h1>Регистрация</h1>
        <form action="../request/Rrigister.php" method="post">
            <input class="oneline_input" type="text" class="form-control" name="login" id="login" placeholder="Введите логин"> <br> <br>
            <input class="oneline_input" type="password" class="form-control" name="pass" id="pass" placeholder="Введите пароль"> <br> <br>
            <button class="btn btn-success">Зарегистрироваться</button>
        </form>
    </div>



<?php
if ($_GET['error'] == "wronginput"){
    echo "<br><p style='text-align: center'>Ошибка. Логин и пароль не должны превышать 30 символов. <br>
                 Пароль должен быть больше 3 символов. <br>
                 Логин должен быть больше 5 символов.</p>";
}

if ($_GET['error'] == "userexists"){
    echo "<br><p style='text-align: center'>Ошибка. Пользователь с таким логином уже существует.</p>";
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/layOut/footer2.php');
?>