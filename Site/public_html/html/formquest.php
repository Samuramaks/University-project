<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/layOut/header.php');
?>
    <div class="container mt-4">
        <h1>Задать вопрос</h1>
        <form action="../functions/questions.php" method="post">
            <input  type="text" class="form-control-courses" name="name" placeholder="Введите ФИО"> <br> <br>
            <input  type="text" class="form-control-courses" name="quest" placeholder="Введите вопрос"> <br> <br>
            <select name="school" id="select">
                <option value="досааф">ДОСААФ</option>
                <option value="мегаполис">Мегаполис</option>
                <option value="перспектива">Перспектива</option>
                <option value="старт">Старт</option>
                <option value="филин">Филин</option>
                <option value="эталон">Эталон</option>
            </select> <br><br>
            <button class="btn btn-success" type="submit" name="button_name">Отправить</button>
        </form>
    </div>
<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/layOut/footer2.php');
?>