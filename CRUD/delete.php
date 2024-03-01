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
    public function fetchDataLayananById($id) {
        $sql = "SELECT * FROM layanan WHERE no_regis='$id'";
        return $this->fetchData($sql);
    }

    public function deleteDataLayananById($id) {
        $sql_delete = "DELETE FROM layanan WHERE no_regis='$id'";
        return $this->executeQuery($sql_delete);
    }
}

$layananController = new LayananController("localhost", "root", "", "klinik");

$id = $_GET['id'];
$error = "";
$success = "";

// Ambil data yang akan dihapus untuk konfirmasi
$row_select = $layananController->fetchDataLayananById($id);

if (!$row_select) {
    $error = "Data tidak ditemukan.";
} else {
    // Tampilkan notifikasi
    echo "<div class='container-fluid'>";
    echo "<div class='col-lg-12'>";
    echo "<div class='user-stats card card-blended table-responsive'>";
    echo "<div class='container m-4'>";
    echo '<div class="container text-center">';
    echo "<h3><strong>Konfirmasi Hapus Data</strong></h3>";
    echo "<p><strong>Anda yakin ingin menghapus data dengan No Registrasi: " . $row_select['no_regis'] . "?</strong></p>";
    echo "<hr>";
    echo "<form method='post' action='delete.php?id=$id'>";
    echo "<input type='submit' class='btn btn-danger' value='Hapus' name='hapus'>";
    echo " <a href='index.php' class='btn btn-primary'>Batal</a>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
    echo "</div>";

    // Jika tombol hapus ditekan
    if (isset($_POST['hapus'])) {
        // Hapus data dari tabel layanan
        if ($layananController->deleteDataLayananById($id)) {
            $success = "Data berhasil dihapus";
            header("Location: index.php");
        } else {
            $error = "Error: " . mysqli_error($layananController->conn);
        }
    }
}

// Tutup koneksi
$layananController->closeConnection();
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

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hapus Data Layanan</title>
</head>
<body>
<div class="container mt-4">
    <?php
    // Tampilkan pesan kesalahan atau sukses
    if ($error != "") {
        echo "<div class='alert alert-danger' role='alert'>$error</div>";
    } elseif ($success != "") {
        echo "<div class='alert alert-success' role='alert'>$success</div>";
    }
?>

</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script type="text/javascript" src="js/script.js"&gt;>
</body>
</html>