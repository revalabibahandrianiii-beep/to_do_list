
<?php

require_once "koneksi.php";
require_once "class/Task.php";

$task = new Task($koneksi);

if (isset($_POST['nama_tugas'])) {

    $nama = $_POST['nama_tugas'];

    $task->tambah(1, $nama);
}

header("Location: index.php");
exit;

?>
