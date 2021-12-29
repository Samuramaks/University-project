<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/layOut/header.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/classes/CDataBase.php');
?>
    <?php
    if ($_COOKIE['login'] == 'Admin') {
        $CDataBase = new CDataBase;
        $array = $CDataBase->Rows();
        if (!$array) {
            echo "<div class='center'> <p>На данный момент никто нет вопросов.</p></div>";
        }
        else {
            echo "<div class = 'table'>";
            echo "<h2 id='table-article'> База данных с вопросами</h2>";
            echo "<table border='1' id='q'>";
            echo "<tr>
                    <td class='table-names'>№</td>
                    <td class='table-names'>login</td>
                    <td class='table-names'>name</td>
                    <td class='table-names'>quest</td>
                    <td class='table-names'>school</td>
                  <tr>";
            foreach ($array as $i => $row) {
                echo "<tr>
                    <td class='table-info'>" . $i . "</td>
                    <td class='table-info'>" . $row['login'] . "</td>
                    <td class='table-info'>" . $row['name'] . "</td>
                    <td class='table-info'>" . $row['quest'] . "</td>
                    <td class='table-info'>" . $row['school'] . "</td>
                  <tr>";
            }
            echo "</table>";
            echo "</div>";
        }
    }
    ?>
<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/layOut/footer2.php');