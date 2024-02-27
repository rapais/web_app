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
            width: 1000px;
        }
        .table-responsive {
            overflow-x: auto;
        }

        .costum-table {
            width: auto;
        }

        .header {
            background: rgb(5,90,113);
            background: linear-gradient(90deg, rgba(5,90,113,1) 11%, rgba(1,143,167,1) 76%, rgba(0,162,186,1) 100%);
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
    </style>

</head>

<body>
<?php include 'header.php'; ?>
    <div class="container-fluid">

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
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2">NO</th>
                        <th rowspan="2">JENIS</th>
                        <th colspan="4">DATA PESERTA</th>
                        <th rowspan="2">JUDUL PEMBELAJARAN</th>
                        <th rowspan="2">PIC PELATIHAN</th>
                        <th rowspan="2">BATCH</th>
                        <th rowspan="2">TANGGAL MULAI</th>
                        <th rowspan="2">TANGGAL SELESAI</th>
                        <th colspan="4">RERATA HASIL EVALUASI LEVEL 1</th>
                        <th rowspan="2">SARAN/KRITIK</th>
                        <th rowspan="2">ACTION PLAN</th>
                        <th rowspan="2">PROGRESS ACTION PLAN</th>
                        <th rowspan="2">PROSENTASE PROGRESS</th>
                        <th rowspan="2">EVIDENCE TINDAK LANJUT</th>
                        <th rowspan="2">STATUS</th>
                        <th rowspan="2">EDIT</th>
                    </tr>
                    <tr>
                        <th colspan="1">NID</th>
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
                        <td><?php echo $urut++ ?></td>
                        <td><?php echo $jenis ?></td>
                        <td><?php echo $NID ?></td>
                        <td><?php echo $name ?></td>
                        <td><?php echo $jabatan ?></td>
                        <td><?php echo $unit ?></td>
                        <td><?php echo $judul_pembelajaran ?></td>
                        <td><?php echo $pic ?></td>
                        <td><?php echo $batch ?></td>
                        <td><?php echo $t_Mulai ?></td>
                        <td><?php echo $t_Selesai ?></td>
                        <td><?php echo $instruktur ?></td>
                        <td><?php echo $materi ?></td>
                        <td><?php echo $peserta ?></td>
                        <td><?php echo $penyelenggara ?></td>
                        <td><?php echo $saran ?></td>
                        <td><?php echo $action ?></td>
                        <td><?php echo $progress ?></td>
                        <td><?php echo $per_pro ?></td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#evidenceModal<?php echo $id ?>">
                                <i class="fas fa-eye"></i>
                            </button>
                        </td>

                        <td><?php echo $status ?></td>
                        
                        <td>
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
