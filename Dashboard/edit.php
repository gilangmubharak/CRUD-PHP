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

    public function fetchData($sql) {
        $result = $this->executeQuery($sql);
        return mysqli_fetch_assoc($result);
    }
}

class LayananController extends DatabaseConnection {
    public function updateDataLayanan($id, $no_regis, $tg_regis, $no_rm, $nama, $poliklinik, $nama_dok, $keluhan, $diagnosa, $tindakan, $terapi_obat, $jadwal) {
        $sql = "UPDATE layanan 
                SET no_regis='$no_regis', tg_regis='$tg_regis', no_rm='$no_rm', nama='$nama', poliklinik='$poliklinik', 
                nama_dok='$nama_dok', keluhan='$keluhan', diagnosa='$diagnosa', tindakan='$tindakan', 
                terapi_obat='$terapi_obat', jadwal='$jadwal' 
                WHERE no_regis='$id'";

        return $this->executeQuery($sql);
    }

    public function fetchDataLayananById($id) {
        $sql = "SELECT * FROM layanan WHERE no_regis='$id'";
        return $this->fetchData($sql);
    }
}

$layananController = new LayananController("localhost", "root", "", "klinik");

$id = $_GET['id'];
$error = "";
$success = "";

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

    if ($layananController->updateDataLayanan($id, $no_regis, $tg_regis, $no_rm, $nama, $poliklinik, $nama_dok, $keluhan, $diagnosa, $tindakan, $terapi_obat, $jadwal)) {
        $success = "Data berhasil diperbarui";
        header("Location: index.php");
    } else {
        $error = "Error: " . mysqli_error($layananController->conn);
    }
}

$row_select = $layananController->fetchDataLayananById($id);

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
    <title>Edit Data Layanan</title>
</head>
<body>

<div class="container-fluid">
<div class="col-lg-12">
<div class="user-stats card card-blended table-responsive">
<div class="container m-4">
    <h3><strong>Edit Data Layanan</strong></h3>
    <form method="post" action="">
        <!-- Formulir Edit -->
        <!-- Isi formulir dengan data yang diambil dari database -->
    <div class="input-field">
    <label for="no_regis">No Registrasi:</label>
    <input type="number" class="form-control" name="no_regis" value="<?php echo $row_select['no_regis']; ?>" required>
    </div>
    <div class="input-field">
    <label for="tg_regis">Tanggal Registrasi:</label>
    <input type="text" class="form-control" name="tg_regis" value="<?php echo $row_select['tg_regis']; ?>" required>
    </div>
    <div class="input-field">
    <label for="no_rm">No Rekam Medis:</label>
    <input type="number" class="form-control" name="no_rm" value="<?php echo $row_select['no_rm']; ?>" required>
    </div>
    <div class="input-field">
    <label for="nama">Nama Pasien:</label>
    <input type="text" class="form-control" name="nama" value="<?php echo $row_select['nama']; ?>" required>
    </div>
    <div class="input-field">
    <label for="poliklinik">Poli Klinik:</label>
    <select class="form-control" name="poliklinik" required>
        <option value="Poli Umum" <?php echo ($row_select['poliklinik'] == 'Poli Umum') ? 'selected' : ''; ?>>Poli Umum</option>
        <option value="Poli Gigi" <?php echo ($row_select['poliklinik'] == 'Poli Gigi') ? 'selected' : ''; ?>>Poli Gigi</option>
        <option value="Poli Gizi" <?php echo ($row_select['poliklinik'] == 'Poli Gizi') ? 'selected' : ''; ?>>Poli Gizi</option>
        <option value="Poli Spesialis Paru" <?php echo ($row_select['poliklinik'] == 'Poli Spesialis Paru') ? 'selected' : ''; ?>>Poli Spesialis Paru</option>
        <option value="Poli Spesialis Jantung" <?php echo ($row_select['poliklinik'] == 'Poli Spesialis Jantung') ? 'selected' : ''; ?>>Poli Spesialis Jantung</option>
        <option value="Poli Rehabilitas Medik" <?php echo ($row_select['poliklinik'] == 'Poli Rehabilitas Medik') ? 'selected' : ''; ?>>Poli Rehabilitas Medik</option>
        <option value="Poli Spesialis Okupasi Kerja" <?php echo ($row_select['poliklinik'] == 'Poli Spesialis Okupasi Kerja') ? 'selected' : ''; ?>>Poli Spesialis Okupasi Kerja</option>
    </select>
    </div>
    <div class="input-field">
    <label for="nama_dok">Nama Dokter:</label>
    <input type="text" class="form-control" name="nama_dok" value="<?php echo $row_select['nama_dok']; ?>" required>
    </div>
    <div class="input-field">
    <label for="keluhan">Keluhan:</label>
    <input type="text" class="form-control" name="keluhan" value="<?php echo $row_select['keluhan']; ?>" required>
    </div>
    <div class="input-field">
    <label for="diagnosa">Diagnosa:</label>
    <input type="text" class="form-control" name="diagnosa" value="<?php echo $row_select['diagnosa']; ?>" required>
    </div>
    <div class="input-field">
    <label for="tindakan">Tindakan:</label>
    <input type="text" class="form-control" name="tindakan" value="<?php echo $row_select['tindakan']; ?>" required>
    </div>
    <div class="input-field">
    <label for="terapi_obat">Terapi Obat:</label>
    <input type="text" class="form-control" name="terapi_obat" value="<?php echo $row_select['terapi_obat']; ?>" required>
    </div>
    <div class="form-group">
    <label for="jadwal">Jadwal:</label>
    <input type="text" class="form-control" name="jadwal" value="<?php echo $row_select['jadwal']; ?>" required>
    </div>

        <!-- Isi formulir dengan data lainnya -->
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="index.php" class="btn btn-danger">Batal</a>
    </form>

    <?php
    // Tampilkan pesan kesalahan atau sukses
    if ($error != "") {
        echo "<div class='alert alert-danger' role='alert'>$error</div>";
    } elseif ($success != "") {
        echo "<div class='alert alert-success' role='alert'>$success</div>";
    }
    ?>
</div>
<?php