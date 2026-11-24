
<?php

require_once "koneksi.php";
require_once "class/User.php";
require_once "class/PersonalUser.php";
require_once "class/Task.php";

// Membuat objek pengguna
$user = new PersonalUser(1, "Reva");

// Membuat objek Task
$task = new Task($koneksi);

?>

<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
</head>
<body>

<h2><?php echo $user->tampilkanNama(); ?></h2>

<!-- Form tambah tugas -->
<form action="tambah.php" method="POST">

    <label>Nama Tugas:</label>

    <input type="text" name="nama_tugas"
           placeholder="Masukkan nama tugas" required>

    <button type="submit">Tambah</button>

</form>

<h3>Daftar Tugas</h3>

<table border="1" cellpadding="8">

    <tr>
        <th>No</th>
        <th>Nama Tugas</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php

    $data = $task->tampil($user->getId());
    $no = 1;

    while ($row = mysqli_fetch_assoc($data)) {

    ?>

    <tr>

        <td><?php echo $no++; ?></td>

        <td>
            <?php echo htmlspecialchars($row['nama_tugas']); ?>
        </td>

        <td>

            <form action="edit.php" method="POST">

                <input type="hidden" name="id"
                       value="<?php echo $row['id']; ?>">

                <input type="hidden" name="nama_tugas"
                       value="<?php echo htmlspecialchars($row['nama_tugas']); ?>">

                <select name="status" onchange="this.form.submit()">

                    <option value="Belum Selesai"
                        <?php if ($row['status'] == "Belum Selesai") echo "selected"; ?>>
                        Belum Selesai
                    </option>

                    <option value="Selesai"
                        <?php if ($row['status'] == "Selesai") echo "selected"; ?>>
                        Selesai
                    </option>

                </select>

                <input type="hidden" name="ubah" value="1">

            </form>

        </td>

        <td>

            <a href="edit.php?id=<?php echo $row['id']; ?>">
                Edit
            </a>

            |

            <a href="hapus.php?id=<?php echo $row['id']; ?>"
               onclick="return confirm('Yakin ingin menghapus tugas ini?')">
                Hapus
            </a>

        </td>

    </tr>

    <?php } ?>

</table>

<p>
    Total tugas:
    <?php echo Task::total($koneksi, $user->getId()); ?>
</p>

</body>
</html>
