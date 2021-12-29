<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/classes/CDataBase.php');
$del = filter_var(trim($_POST['delete']), FILTER_SANITIZE_STRING);
$CDataBase = new CDataBase;
if($del != ''){
    $CDataBase->Delete($del);
    header('Location: /html/users.php');
}
$CDataBase->close();
?>