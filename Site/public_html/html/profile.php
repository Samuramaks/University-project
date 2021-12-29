<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/layOut/header.php');
?>

    <div class="content">
        <div class="headtext">
            <h2><?php echo $_COOKIE['login'] . "." ?></h2>
            <h2>Личный кабинет.</h2>
        </div>
        <br>

            <br>
            <form action="/request/Runlogin.php" method="post">
                <button class="btn btn-option">Выйти</button>
            </form>


    </div>



<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/layOut/footer2.php');
?>