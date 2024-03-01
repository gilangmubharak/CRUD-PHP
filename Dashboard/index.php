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

    public function fetchData($table) {
        $sql = "SELECT * FROM $table";
        $result = mysqli_query($this->conn, $sql);

        if (!$result) {
            die("Error: " . mysqli_error($this->conn));
        }

        return $result;
    }
}

class KlinikMerdekaDashboard extends DatabaseConnection {
    public function displayDashboard($table) {
        $result = $this->fetchData($table);
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>DashBoard</title>
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
            <link rel="stylesheet" type="text/css" href="css/icon.css">
            <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        </head>
        <body class="bg-grey">
		<div class="side-bar card" style="max-width: 230px; flex-direction: column; border-radius: 10px;">
    	<div class="site-name-wrapper">
        <br>
        <figure>
        <img src="hospital.png" alt="Klinik Merdeka">
        <figcaption style="color: blue;"><h5><strong>Klinik Merdeka</strong></h5></figcaption>
        </figure>
    		</div>
    			<div class="side-menu">
        			<ul>
            			<li>
							<a href="" style="border-top: 1px solid purple; border-bottom: 1px solid purple; display: block; padding: 10px;">
    							<span class="icon icon-home fn-blue btn-lg"></span>
    							HOME
							</a>
                        </li>
                        <li>
                            <a href="" style="border-top: 1px solid purple; border-bottom: 1px solid purple; display: block; padding: 10px;">
                                <span class="icon icon-dashboard fn-blue btn-lg"></span>
                                BOARD
                            </a>
                        </li>
                        <li>
                            <a href="" style="border-top: 1px solid purple; border-bottom: 1px solid purple; display: block; padding: 10px;">
                                <span class="icon icon-download fn-blue btn-lg"></span>
                                INBOX
                            </a>
                        </li>
                        <li>
                            <a href="" style="border-top: 1px solid purple; border-bottom: 1px solid purple; display: block; padding: 10px;">
                                <span class="icon icon-users fn-blue btn-lg"></span>
                                USERS
                            </a>
                        </li>
                        <li>
                            <a href="" style="border-top: 1px solid purple; border-bottom: 1px solid purple; display: block; padding: 10px;">
                                <span class="icon icon-user fn-blue btn-lg"></span>
                                PROFILE
                            </a>
                        </li>
						<li>
                            <a href="" style="border-top: 1px solid purple; border-bottom: 1px solid purple; display: block; padding: 10px;">
                                <span class="icon icon-setting fn-blue btn-lg"></span>
                                SETTING
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-wrapper">
		<div class="header container-fluid">
			<div class="row">
				<div class="col-xs-12 col-lg-4 xs-mg-tp-10">
					<span class="icon icon-user user-avatar"></span>
					<span class="pd-lt-10 d-block left">
						<span class="user-name">Admin Klinik Merdeka</span>
						<span class="location">Sukabumi</span>
					</span>
				</div>
			</div>
		</div>
                <div class="container-fluid">
                    <div class="row">		
                    </div>
                </div>
                <div class="col-lg-11">
                    <div class="user-stats card card-blended table-responsive">
                        <div class="container-fluid">
                            <h4><strong>Sistem Informasi Layanan Rawat Jalan Klinik Merdeka</strong></h4>	
                        </div>
                        <div class="stats-body">
                            <a href="create.php" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah Data</a>
                            <table class="table table-bordered table-striped" id="table">
                                <thead>
                                    <tr>
                                        <th>No Registrasi</th>
                                        <th>Tanggal Registrasi</th>
                                        <th>No Rekam Medis</th>
                                        <th>Nama Pasien</th>
                                        <th>Poli Klinik</th>
                                        <th>Nama Dokter</th>
                                        <th>Keluhan</th>
                                        <th>Diagnosa</th>
                                        <th>Tindakan</th>
                                        <th>Terapi Obat</th>
                                        <th>Jadwal Kontrol</th> 
                                        <th>Operasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['no_regis'] . "</td>";
                                        echo "<td>" . $row['tg_regis'] . "</td>";
                                        echo "<td>" . $row['no_rm'] . "</td>";
                                        echo "<td>" . $row['nama'] . "</td>";
                                        echo "<td>" . $row['poliklinik'] . "</td>";
                                        echo "<td>" . $row['nama_dok'] . "</td>";
                                        echo "<td>" . $row['keluhan'] . "</td>";
                                        echo "<td>" . $row['diagnosa'] . "</td>";
                                        echo "<td>" . $row['tindakan'] . "</td>";
                                        echo "<td>" . $row['terapi_obat'] . "</td>";
                                        echo "<td>" . $row['jadwal'] . "</td>";
                                        echo "<td><div class='btn text-center' role='group'>";
                                        echo "<a href='edit.php?id=" . $row['no_regis'] . "' class='btn btn-success'><i class='fa fa-edit'></i> Edit</a>";
                                        echo "<a href='delete.php?id=" . $row['no_regis'] . "' class='btn btn-danger'><i class='fa fa-trash'></i> Hapus</a>";
                                        echo "</div></td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script>
        new DataTable('#table', {
    		responsive: true
			});
    </script>
    </html>
    <?php
    }
}

$dashboard = new KlinikMerdekaDashboard("localhost", "root", "", "klinik");
$dashboard->displayDashboard("layanan");
?>