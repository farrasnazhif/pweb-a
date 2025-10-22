<!DOCTYPE html>
<html>
<head>
    <title>Formulir Pendaftaran Siswa Baru | SMK Coding</title>
</head>
<body>
    <header>
        <h3>Formulir Pendaftaran</h3>
    </header>

    <form action="proses-pendaftaran.php" method="POST">
        <p>
            <label>Nama: </label>
            <input type="text" name="nama" required />
        </p>
        <p>
            <label>Alamat: </label>
            <textarea name="alamat"></textarea>
        </p>
        <p>
            <label>Jenis Kelamin: </label>
            <label><input type="radio" name="jenis_kelamin" value="laki-laki"> Laki-laki</label>
            <label><input type="radio" name="jenis_kelamin" value="perempuan"> Perempuan</label>
        </p>
        <p>
            <label>Agama: </label>
            <select name="agama">
                <option>Islam</option>
                <option>Kristen</option>
                <option>Hindu</option>
                <option>Budha</option>
                <option>Atheis</option>
            </select>
        </p>
         <p>
    <label for="sekolah_asal">Sekolah Asal: </label>
    <input type="text" name="sekolah_asal" />
</p>
        <p>
            <input type="submit" value="Daftar" name="daftar" />
        </p>
       
    </form>
</body>
</html>