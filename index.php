<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "web_app";

// Create a connection
$conn = mysqli_connect($host, $username, $password, $database);

$name = "";
$orderan = "";
$jumlah = "";
$error = "";
$sukses = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id = $_GET['id'];
    $sql1 = "DELETE FROM master_table WHERE Id = '$id'";
    $q1 = mysqli_query($conn, $sql1);
    if ($q1) {
        $sukses = "Berhasil hapus data";
    } else {
        $error = "Gagal melakukan delete data";
    }
}

if ($op == 'edit') {
    $id = $_GET['id'];
    $sql1 = "SELECT * FROM master_table WHERE Id = '$id'";
    $q1 = mysqli_query($conn, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $name = $r1['Nama'];
    $orderan = $r1['Jenis'];
    $jumlah = $r1['NID'];

    if (empty($name)) {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $name = $_POST['nama'];
    $orderan = $_POST['orderan'];
    $jumlah = $_POST['jumlah'];

    if ($name && $orderan && $jumlah) {
        if ($op == 'edit') {
            $sql1 = "UPDATE master_table SET Nama = '$name', Jenis = '$orderan', NID = '$jumlah' WHERE Id = '$id'";
            $q1 = mysqli_query($conn, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error = "Data gagal diupdate";
            }
        } else {
            $sql1 = "INSERT INTO master_table (Nama, Jenis, NID) VALUES ('$name', '$orderan', '$jumlah')";
            $q1 = mysqli_query($conn, $sql1);
            if ($q1) {
                $sukses = "Berhasil memasukkan data baru";
            } else {
                $error = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}

// Initialize sorting variables
$sort = "DESC";
$sort_label = "Terkecil";

if (isset($_POST['sort_desc'])) {
    $sort = "DESC";
    $sort_label = "Terkecil";
} elseif (isset($_POST['sort_asc'])) {
    $sort = "ASC";
    $sort_label = "Tertinggi";
}

// Build the SQL query for sorting
if (isset($_POST['filter_post'])) {
    $sql2 = "SELECT * FROM master_table WHERE Jenis = 'Post Evaluasi' ORDER BY NID $sort";
} elseif (isset($_POST['filter_complain'])) {
    $sql2 = "SELECT * FROM master_table WHERE Jenis = 'Direct Complain' ORDER BY NID $sort";
} else {
    $sql2 = "SELECT * FROM master_table ORDER BY NID $sort";
}

if (isset($_POST['filter_all'])) {
    $sql2 = "SELECT * FROM master_table ORDER BY NID $sort";
} elseif (isset($_POST['filter_post'])) {
    $sql2 = "SELECT * FROM master_table WHERE Jenis = 'Post Evaluasi' ORDER BY NID $sort";
} elseif (isset($_POST['filter_complain'])) {
    $sql2 = "SELECT * FROM master_table WHERE Jenis = 'Direct Complain' ORDER BY NID $sort";
} else {
    $sql2 = "SELECT * FROM master_table ORDER BY NID $sort";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="assets\css\style.css">

    <style>
        .mx-auto {
            width: 100%;
            max-width: none;
            margin: 0;
        }

        .costum-table {
            width: 2500px;
            table-layout: fixed;
        }

        .header {
            background: rgb(5, 90, 113);
            background: linear-gradient(90deg, rgba(5, 90, 113, 1) 11%, rgba(1, 143, 167, 1) 76%, rgba(0, 162, 186, 1) 100%);
        }

        .add-table-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            font-size: 24px;
            padding: 10px 20px;
            border-radius: 50%;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .add-table-btn:hover {
            background-color: #0056b3;
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
            margin-top: 20px; /* Adjust margin-top */
        }

        .table-container table {
            font-size: 15px;
        }

        .table-container th,
        .table-container td {
            font-size: 15px;
            text-align: center; /* Align all content inside table cells to the center */
            padding: 10px; /* Add padding to table cells */
        }

        .table-container th {
            background-color: #00AFF0;
        }

        .table-container tr:hover {
            background-color: #f2f2f2;
        }

        .table-title {
            text-align: center;
            font-size: 24px; /* Adjust font size for the title */
            margin-bottom: 20px; /* Adjust margin-bottom */
            margin-top: 20px; /* Add margin-top */
        }
    </style>

</head>

<body>
    <?php include 'header.php'; ?>

    &nbsp;
    &nbsp;

    <div class="table-title">Monitoring Evaluasi Kepuasan Pelanggan</div> 
    <div class="container-fluid table-container">

        &nbsp;

        <div class="text-left">
            <form method="post" action="">
                <input type="submit" name="filter_post" value=" Post Evaluation ">
                <input type="submit" name="filter_complain" value=" Direct Complain ">
                <input type="submit" name="filter_all" value=" All ">
            </form>
        </div>


        &nbsp;

        <!-- untuk mengeluarkan data -->
        <div>
            <table class="table table-bordered costum-table">
                <thead class="text-center">
                    <tr>
                        <th rowspan="2" style="width: 40px; text-align: center">NO</th>
                        <th rowspan="2" style="width: 200px; text-align: center">JENIS</th>
                        <th colspan="4" style="width: 700px; text-align: center">DATA PESERTA</th>
                        <th rowspan="2" style="width: 350px; text-align: center">JUDUL PEMBELAJARAN</th>
                        <th rowspan="2" style="width: 250px; text-align: center">PIC PELATIHAN</th>
                        <th rowspan="2" style="width: 150px; text-align: center">BATCH</th>
                        <th rowspan="2" style="width: 100px; text-align: center">TANGGAL MULAI</th>
                        <th rowspan="2" style="width: 100px; text-align: center">TANGGAL SELESAI</th>
                        <th colspan="4" style="width: 600px; text-align: center">RERATA HASIL EVALUASI LEVEL 1</th>
                        <th rowspan="2" style="width: 450px; text-align: center">SARAN/KRITIK</th>
                        <th rowspan="2" style="width: 450px; text-align: center">ACTION PLAN</th>
                        <th rowspan="2" style="width: 450px; text-align: center">PROGRESS ACTION PLAN</th>
                        <th rowspan="2" style="width: 200px; text-align: center">PROSENTASE PROGRESS</th>
                        <th rowspan="2" style="width: 100px; text-align: center">EVIDENCE TINDAK LANJUT</th>
                        <th rowspan="2" style="width: 170px; text-align: center">STATUS</th>
                        <th rowspan="2" style="width: 100px; text-align: center">EDIT</th>
                    </tr>
                    <tr>
                        <th colspan="1" style="width: 150px">NID</th>
                        <th colspan="1">NAMA</th>
                        <th colspan="1">JABATAN</th>
                        <th colspan="1">UNIT</th>
                        <th rowspan="1">INSTRUKTUR</th>
                        <th rowspan="1">MATERI</th>
                        <th rowspan="1">PESERTA</th>
                        <th rowspan="1">PENYELENGGARA</th>
                    </tr>
                    <tr>
                        <!-- Leave this row empty to indicate the headers' division -->
                    </tr>
                </thead>
                <tbody>
                <?php
                $q2 = mysqli_query($conn, $sql2);
                $urut = 1;
                while ($r2 = mysqli_fetch_array($q2)) {
                    $id = $r2['Id'];
                    $NID = $r2['NID'];
                    $name = $r2['Nama'];
                    $jenis = $r2['Jenis'];
                    $jabatan = $r2['Jabatan'];
                    $pic = $r2['PIC_pelatihan'];
                    $unit = $r2['Unit'];
                    $judul_pembelajaran = $r2['Judul_pembelajaran'];
                    $batch = $r2['Batch'];
                    $t_Mulai = $r2['T_Mulai'];
                    $t_Selesai = $r2['T_Selesai'];
                    $instruktur = $r2['Instruktur'];
                    $materi = $r2['Materi'];
                    $peserta = $r2['Peserta'];
                    $penyelenggara = $r2['Penyelenggara'];
                    $saran = $r2['Saran'];
                    $action = $r2['Action'];
                    $progress = $r2['Progress'];
                    $per_pro = $r2['Per_pro'];
                    $evidence = $r2['Evidence'];
                    $status = $r2['Status'];
                ?>
                    <tr>
                        <td style="width: 5%;"><?php echo $urut++ ?></td>
                        <td style="width: 1000px"><?php echo $jenis ?></td>
                        <td style="width: 5%;"><?php echo $NID ?></td>
                        <td><?php echo $name ?></td>
                        <td style="width: 5%;"><?php echo $jabatan ?></td>
                        <td style="width: 5%;"><?php echo $unit ?></td>
                        <td style="width: 5%;"><?php echo $judul_pembelajaran ?></td>
                        <td style="width: 5%;"><?php echo $pic ?></td>
                        <td style="width: 5%;"><?php echo $batch ?></td>
                        <td style="width: 5%;"><?php echo $t_Mulai ?></td>
                        <td style="width: 5%;"><?php echo $t_Selesai ?></td>
                        <td style="width: 5%;"><?php echo $instruktur ?></td>
                        <td style="width: 5%;"><?php echo $materi ?></td>
                        <td style="width: 5%;"><?php echo $peserta ?></td>
                        <td style="width: 5%;"><?php echo $penyelenggara ?></td>
                        <td style="width: 5%;"><?php echo $saran ?></td>
                        <td style="width: 5%;"><?php echo $action ?></td>
                        <td style="width: 5%;"><?php echo $progress ?></td>
                        <td style="width: 5%;"><?php echo $per_pro ?></td>
                        <td style="width: 5%;">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#evidenceModal<?php echo $id ?>">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>

                        <td style="width: 5%;"><?php echo $status ?></td>
                        
                        <td style="width: 5%;">
                            <a href="edit.php?id=<?php echo $id ?>" class="btn btn-warning edit-button">
                                <i class="fas fa-pen"></i>
                            </a>
                        </td>


                    </tr>
                <?php
                }
                ?>

                </tbody>
            </table>
        </div>

        &nbsp;

        <div class="text-center">
            <button onclick="window.location.href = 'add_item.php';" class="add-table-btn">+</button>
        </div>

    </div>

    <!-- Modal -->
<div class="modal fade" id="evidenceModal<?php echo $id ?>" tabindex="-1" aria-labelledby="evidenceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="evidenceModalLabel">Evidence Files</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul>
                    <?php
                    // Split the evidence string into an array
                    $evidence_files = explode(',', $evidence);
                    foreach ($evidence_files as $file) {
                        echo "<li>$file</li>";
                    }
                    ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets\js\script.js"></script>

</body>

</html>
