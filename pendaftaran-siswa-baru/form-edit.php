<?php
include("config.php");

if (!isset($_GET['id'])) {
    header('Location: list-siswa.php');
}

$id = $_GET['id'];
$sql = "SELECT * FROM calon_siswa WHERE id=$id";
$query = mysqli_query($db, $sql);
$siswa = mysqli_fetch_assoc($query);

if (mysqli_num_rows($query) < 1) {
    die("data tidak ditemukan...");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Siswa | SMK Coding</title>
</head>
<body>
    <header><h3>Form Edit Siswa</h3></header>

    <form action="proses-edit.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $siswa['id'] ?>" />

        <p><label>Nama: </label>
            <input type="text" name="nama" value="<?php echo $siswa['nama'] ?>" />
        </p>
        <p><label>Alamat: </label>
            <textarea name="alamat"><?php echo $siswa['alamat'] ?></textarea>
        </p>
        <p><label>Jenis Kelamin: </label>
            <?php $jk = $siswa['jenis_kelamin']; ?>
            <label><input type="radio" name="jenis_kelamin" value="laki-laki" <?php echo ($jk == 'laki-laki') ? "checked": "" ?>> Laki-laki</label>
            <label><input type="radio" name="jenis_kelamin" value="perempuan" <?php echo ($jk == 'perempuan') ? "checked": "" ?>> Perempuan</label>
        </p>
        <p><label>Agama: </label>
            <select name="agama">
                <?php $agama = $siswa['agama']; ?>
                <option <?php echo ($agama == 'Islam') ? "selected": "" ?>>Islam</option>
                <option <?php echo ($agama == 'Kristen') ? "selected": "" ?>>Kristen</option>
                <option <?php echo ($agama == 'Hindu') ? "selected": "" ?>>Hindu</option>
                <option <?php echo ($agama == 'Budha') ? "selected": "" ?>>Budha</option>
                <option <?php echo ($agama == 'Atheis') ? "selected": "" ?>>Atheis</option>
            </select>
        </p>
        <p><input type="submit" value="Simpan" name="simpan" /></p>
    </form>
</body>
</html>