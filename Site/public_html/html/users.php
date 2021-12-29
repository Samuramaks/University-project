<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/layOut/header.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/classes/CDataBase.php');
if ($_COOKIE['login'] == 'Admin') {
    $CDataBase = new CDataBase;
    $array = $CDataBase->Row();
    if($array) {
        echo "<div class = 'table'>";
        echo "<h2 id='table-article'> Зарегестрированные пользователи</h2>";
        echo "<table border='1' id='h'>";
        echo "<tr>
                    <td class='table-names'>id</td>
                    <td class='table-names'>login</td>
                    <td class='table-names'>pas</td> 
                  <tr>";
        foreach ($array as $i => $row) {
            echo "<tr>
                    <td class='table-info'>" . $row['id'] . "</td>
                    <td class='table-info'>" . $row['login'] . "</td>
                    <td class='table-info'>" . $row['pas'] . "</td>
                  <tr>";
        }
        echo "</table>";
        echo "<form action='../functions/delete.php' method='post'>";
        echo "<input  type='text' class='form-control-courses' name='delete' placeholder='Введите id для удаления'> <br>";
        echo "<button class='btn btn-success' type='submit'>Отправить</button>";
        echo "</form>";
        echo "</div>";
    }
}
require_once ($_SERVER['DOCUMENT_ROOT'] . '/layOut/footer2.php');
?>