
<?php

require_once "koneksi.php";
require_once "class/Task.php";

$task = new Task($koneksi);

if (isset($_POST['ubah'])) {

    $id = $_POST['id'];
    $nama = $_POST['nama_tugas'];
    $status = $_POST['status'];

    $task->ubah($id, 1, $nama, $status);

    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

$sql = "SELECT * FROM tasks WHERE id = $id AND user_id = 1";
$data = mysqli_query($koneksi, $sql);
$row = mysqli_fetch_assoc($data);

if (!$row) {
    die("Tugas tidak ditemukan.");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Tugas</title>
</head>
<body>

<h2>Edit Tugas</h2>

<form method="POST">

    <input type="hidden" name="id"
           value="<?php echo $row['id']; ?>">

    <p>
        Nama Tugas:
        <input type="text" name="nama_tugas"
               value="<?php echo htmlspecialchars($row['nama_tugas']); ?>"
               required>
    </p>

    <p>
        Status:
        <select name="status">
            <option value="Belum Selesai"
                <?php if ($row['status'] == "Belum Selesai") echo "selected"; ?>>
                Belum Selesai
            </option>

            <option value="Selesai"
                <?php if ($row['status'] == "Selesai") echo "selected"; ?>>
                Selesai
            </option>
        </select>
    </p>

    <button type="submit" name="ubah">Simpan Perubahan</button>

</form>

<a href="index.php">Kembali</a>

</body>
</html>
