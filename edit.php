<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "web_app";

// Create a connection
$conn = mysqli_connect($host, $username, $password, $database);

$error = "";
$sukses = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM master_table WHERE Id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['update'])) {
    $name = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $NID = $_POST['NID'];
    $jabatan = $_POST['Jabatan'];
    $unit = $_POST['Unit'];
    $judul_pembelajaran = $_POST['Judul_pembelajaran'];
    $pic = $_POST['PIC_pelatihan'];
    $batch = $_POST['batch'];
    $t_Mulai = $_POST['t_Mulai'];
    $t_Selesai = $_POST['t_Selesai'];
    $instruktur = $_POST['instruktur'];
    $materi = $_POST['materi'];
    $peserta = $_POST['peserta'];
    $penyelenggara = $_POST['penyelenggara'];
    $saran = $_POST['saran'];
    $action = $_POST['action'];
    $progress = $_POST['progress'];
    $per_pro = $_POST['per_pro'];
    $evidence = $_POST['evidence'];
    $status = $_POST['status'];

    if ($name && $jenis && $NID && $jabatan && $unit && $judul_pembelajaran && $pic && $batch && $t_Mulai && $t_Selesai && $instruktur && $materi && $peserta && $penyelenggara && $saran && $action && $progress && $per_pro && $evidence && $status) {
        $sql_update = "UPDATE master_table SET Nama = '$name', Jenis = '$jenis', NID = '$NID', Jabatan = '$jabatan', Unit = '$unit', Judul_pembelajaran = '$judul_pembelajaran', PIC_pelatihan = '$pic', Batch = '$batch', T_Mulai = '$t_Mulai', T_Selesai = '$t_Selesai', Instruktur = '$instruktur', Materi = '$materi', Peserta = '$peserta', Penyelenggara = '$penyelenggara', Saran = '$saran', Action = '$action', Progress = '$progress', Per_pro = '$per_pro', Evidence = '$evidence', Status = '$status' WHERE Id = '$id'";
        $result_update = mysqli_query($conn, $sql_update);

        if ($result_update) {
            $sukses = "Data berhasil diupdate";
            header("Location: index.php"); // Redirect to index.php after successful update
            exit(); // Ensure that no other output is sent before redirection
        } else {
            $error = "Data gagal diupdate";
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">


    <style>
        .header {
            background: rgb(5,90,113);
            background: linear-gradient(90deg, rgba(5,90,113,1) 11%, rgba(1,143,167,1) 76%, rgba(0,162,186,1) 100%);
        }

        .header-content {
            top: 50%;
            left: calc(12.5%); /* Adjust the value as needed */
            display: flex;
            align-items: center;
        }

        .logo {
            height: 100%; /* Make the logo fill the height of the header */
            width: auto;
            margin-right: auto; /* Push the logo to the middle */
            margin-left: 200px; /* Push the logo to the middle */
        }

        .container-card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btn,
        .delete-btn {
            margin-top: 1rem;
            padding: 0.5rem 1.5rem;
            cursor: pointer;
            border-radius: 0.3rem;
            text-transform: capitalize;
        }

        .back-btn {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .card-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
    </style>

    <script>
        document.getElementById('evidence').addEventListener('change', function() {
            // Check the number of files selected
            if (this.files.length > 3) {
                alert('Maximum 3 files allowed');
                this.value = ''; // Clear the selected files
            }
        });
    </script>

</head>

<body>
<?php include 'header.php'; ?>
    <div class="container">
        <div class="container-card">
        <a href="index.php" class="back-btn btn btn-secondary"><i class="fas fa-arrow-left"></i></a>

            <h1 class="card-header">Edit Data</h1>
            <?php if ($error) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <?php if ($sukses) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $sukses; ?>
                </div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis</label>
                    <select class="form-select" id="jenis" name="jenis">
                        <option value="Post Evaluasi" <?php if ($row['Jenis'] === 'Post Evaluasi') echo 'selected'; ?>>Post Evaluasi</option>
                        <option value="Direct Complain" <?php if ($row['Jenis'] === 'Direct Complain') echo 'selected'; ?>>Direct Complain</option>
                    </select>
                </div>
                
            <div class="mb-3">
                <label for="NID" class="form-label">NID</label>
                
                    <input type="text" class="form-control" id="NID" name="NID" value="<?php echo $row['NID']; ?>">
                
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="nama" value="<?php echo $row['Nama']; ?>">
            </div>
            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan" name="Jabatan" value="<?php echo $row['Jabatan']; ?>">
            </div>
            <div class="mb-3">
                <label for="unit" class="form-label">Unit</label>
                    <input type="text" class="form-control" id="unit" name="Unit" value="<?php echo $row['Unit']; ?>">
            </div>
            <div class="mb-3">
                <label for="judul_pembelajaran" class="form-label">Judul Pembelajaran</label>
                    <input type="text" class="form-control" id="judul_pembelajaran" name="Judul_pembelajaran" value="<?php echo $row['Judul_pembelajaran']; ?>">
            </div>
            <div class="mb-3">
                <label for="pic" class="form-label">PIC Pelatihan</label>
                    <input type="text" class="form-control" id="pic" name="PIC_pelatihan" value="<?php echo $row['PIC_pelatihan']; ?>">
                </div>
            
            <div class="mb-3">
                <label for="batch" class="form-label">Batch</label>
                    <input type="text" class="form-control" id="batch" name="batch" value="<?php echo $row['Batch']; ?>">
            </div>
            <div class="mb-3">
                <label for="t_Mulai" class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="t_Mulai" name="t_Mulai" value="<?php echo $row['T_Mulai']; ?>">
            </div>
            <div class="mb-3">
                <label for="t_Selesai" class="form-label">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="t_Selesai" name="t_Selesai" value="<?php echo $row['T_Selesai']; ?>">
            </div>
            <div class="mb-3">
                <label for="instruktur" class="form-label">Instruktur</label>
                    <input type="text" class="form-control" id="instruktur" name="instruktur" value="<?php echo $row['Instruktur']; ?>">
            </div>
            <div class="mb-3">
                <label for="materi" class="form-label">Materi</label>
                    <input type="text" class="form-control" id="materi" name="materi" value="<?php echo $row['Materi']; ?>">
            </div>
            <div class="mb-3">
                <label for="peserta" class="form-label">Peserta</label>
                    <input type="text" class="form-control" id="peserta" name="peserta" value="<?php echo $row['Peserta']; ?>">
            </div>
            <div class="mb-3">
                <label for="penyelenggara" class="form-label">Penyelenggara</label>
                    <input type="text" class="form-control" id="penyelenggara" name="penyelenggara" value="<?php echo $row['Penyelenggara']; ?>">
            </div>
            <div class="mb-3">
                <label for="saran" class="form-label">Saran/Kritik</label>
                    <input type="text" class="form-control" id="saran" name="saran" value="<?php echo $row['Saran']; ?>">
            </div>
            <div class="mb-3">
                <label for="action" class="form-label">Action Plan</label>
                    <input type="text" class="form-control" id="action" name="action" value="<?php echo $row['Action']; ?>">
            </div>
            <div class="mb-3">
                <label for="progress" class="form-label">Progress Action Plan</label>
                    <input type="text" class="form-control" id="progress" name="progress" value="<?php echo $row['Progress']; ?>">
            </div>
            <div class="mb-3">
                <label for="per_pro" class="form-label">Prosentase Progress</label>
                    <input type="text" class="form-control" id="per_pro" name="per_pro" value="<?php echo $row['Per_pro']; ?>">
            </div>
            <div class="mb-3">
                <label for="evidence" class="form-label">Evidence Tindak Lanjut</label>
                <input type="file" class="form-control" id="evidence" name="evidence[]" multiple accept="image/*,.pdf,.doc,.docx">
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                    <div class="input-group">
                        <select class="form-control" id="status" name="status">
                            <option value="Open" <?php if ($row['Status'] === 'Open') echo 'selected'; ?>>Open</option>
                            <option value="Close" <?php if ($row['Status'] === 'Close') echo 'selected'; ?>>Close</option>
                        </select>
                </div>
            </div>
            <div class="col-12">
                    <input type="submit" name="update" value="Update" class="btn btn-primary" />
                    <a href="delete.php?id=<?php echo $id; ?>" class="btn btn-danger">Delete</a>
            </div>
        </form>
    </div>
</body>

</html>
