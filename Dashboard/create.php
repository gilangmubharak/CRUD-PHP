<?php
class DatabaseConnection {
    protected $conn;

    public function __construct($host, $user, $pass, $db) {
        $this->conn = mysqli_connect($host, $user, $pass, $db);

        if (!$this->conn) {
            die("Koneksi Gagal: " . mysqli_connect_error());
        }

        mysqli_set_charset($this->conn, "utf8");
    }

    public function executeQuery($sql) {
        return mysqli_query($this->conn, $sql);
    }

    public function closeConnection() {
        mysqli_close($this->conn);
    }
}

class LayananController extends DatabaseConnection {
    public function tambahDataLayanan($no_regis, $tg_regis, $no_rm, $nama, $poliklinik, $nama_dok, $keluhan, $diagnosa, $tindakan, $terapi_obat, $jadwal) {
        $sql = "INSERT INTO layanan (no_regis, tg_regis, no_rm, nama, poliklinik, nama_dok, keluhan, diagnosa, tindakan, terapi_obat, jadwal)
                VALUES ('$no_regis', '$tg_regis', '$no_rm', '$nama', '$poliklinik', '$nama_dok', '$keluhan', '$diagnosa', '$tindakan', '$terapi_obat', '$jadwal')";

        return $this->executeQuery($sql);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_regis = $_POST['no_regis'];
    $tg_regis = $_POST['tg_regis'];
    $no_rm = $_POST['no_rm'];
    $nama = $_POST['nama'];
    $poliklinik = $_POST['poliklinik'];
    $nama_dok = $_POST['nama_dok'];
    $keluhan = $_POST['keluhan'];
    $diagnosa = $_POST['diagnosa'];
    $tindakan = $_POST['tindakan'];
    $terapi_obat = $_POST['terapi_obat'];
    $jadwal = $_POST['jadwal'];

    $layananController = new LayananController("localhost", "root", "", "klinik");

    if ($layananController->tambahDataLayanan($no_regis, $tg_regis, $no_rm, $nama, $poliklinik, $nama_dok, $keluhan, $diagnosa, $tindakan, $terapi_obat, $jadwal)) {
        echo "<div class='container mt-4'><div class='alert alert-success' role='alert'>Data berhasil ditambahkan</div></div>";
        header("refresh:2;url=index.php");
    } else {
        echo "<div class='container mt-4'><div class='alert alert-danger' role='alert'>Error: " . mysqli_error($layananController->conn) . "</div></div>";
    }

    $layananController->closeConnection();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>DashBoard</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" type="text/css" href="css/icon.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class="bg-grey">
    <title>Tambah Data Layanan</title>
</head>
<body>

<div class="container-fluid">
<div class="user-stats card card-blended">
<div class="container m-4">
    <h3><strong>Tambah Data Layanan</strong></h3>
    <form action="create.php" method="post">
        <!-- Isi formulir sesuai dengan kolom tabel -->
        <div class="input-field">
            <label for="no_regis">No Registrasi:</label>
            <input type="number" class="form-control" placeholder="Masukkan No Registrasi" name="no_regis" required>
        </div>
        <div class="input-field">
            <label for="tg_regis">Tanggal Registrasi:</label>
            <input type="date" class="form-control" name="tg_regis" required>
        </div>
        <div class="input-field">
            <label for="no_rm">No Rekam Medis:</label>
            <input type="number" class="form-control" placeholder="Masukkan No Rekam Medis" name="no_rm" required>
        </div>
        <div class="input-field">
            <label for="nama">Nama Pasien:</label>
            <input type="text" class="form-control" placeholder="Masukkan Nama Pasien" name="nama" required>
        </div>
        <div class="input-field">
    <label for="poliklinik">Poli Klinik:</label>
    <select class="form-control" name="poliklinik" required>
        <option value="" disabled selected>Pilih Poli Klinik</option>
        <option value="Poli Umum">Poli Umum</option>
        <option value="Poli Gigi">Poli Gigi</option>
        <option value="Poli Gizi">Poli Gizi</option>
        <option value="Poli Spesialis Paru">Poli Spesialis Paru</option>
        <option value="Poli Spesialis Jantung">Poli Spesialis Jantung</option>
        <option value="Poli Rehabilitas Medik">Poli Rehabilitas Medik</option>
        <option value="Poli Spesialis Okupasi Kerja">Poli Spesialis Okupasi Kerja</option>
    </select>
        </div>
        <div class="input-field">
            <label for="nama_dok">Nama Dokter:</label>
            <input type="text" class="form-control" placeholder="Masukkan Nama Dokter" name="nama_dok" required>
        </div>
        <div class="input-field">
            <label for="keluhan">Keluhan:</label>
            <input type="text" class="form-control" placeholder="Masukkan Keluhan" name="keluhan" required>
        </div>
        <div class="input-field">
            <label for="diagnosa">Diagnosa:</label>
            <input type="text" class="form-control" placeholder="Masukkan Diagnosa" name="diagnosa" required>
        </div>
        <div class="input-field">
            <label for="tindakan">Tindakan:</label>
            <input type="text" class="form-control" placeholder="Masukkan Tindakan" name="tindakan" required>
        </div>
        <div class="input-field">
            <label for="terapi_obat">Terapi Obat:</label>
            <input type="text" class="form-control" placeholder="Masukkan Nama Obat" name="terapi_obat" required>
        </div>
        <div class="form-group">
            <label for="jadwal">Jadwal:</label>
            <input type="text" class="form-control" placeholder="Masukkan Jadwal" name="jadwal" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Data</button>
        <a href="index.php" class="btn btn-danger">Batal</a>
    </form>
</div>