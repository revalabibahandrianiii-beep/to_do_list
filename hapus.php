
<?php

require_once "koneksi.php";
require_once "class/Task.php";

$task = new Task($koneksi);

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $task->hapus($id, 1);
}

header("Location: index.php");
exit;

?>
