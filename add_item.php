<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "web_app";

// Create a connection
$conn = mysqli_connect($host, $username, $password, $database);

$error = "";
$sukses = "";

if (isset($_POST['add'])) {
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
        $sql_add = "INSERT INTO master_table (Nama, Jenis, NID, Jabatan, Unit, Judul_pembelajaran, PIC_pelatihan, Batch, T_Mulai, T_Selesai, Instruktur, Materi, Peserta, Penyelenggara, Saran, Action, Progress, Per_pro, Evidence, Status) VALUES ('$name', '$jenis', '$NID', '$jabatan', '$unit', '$judul_pembelajaran', '$pic', '$batch', '$t_Mulai', '$t_Selesai', '$instruktur', '$materi', '$peserta', '$penyelenggara', '$saran', '$action', '$progress', '$per_pro', '$evidence', '$status')";
        $result_add = mysqli_query($conn, $sql_add);

        if ($result_add) {
            $sukses = "Data berhasil ditambahkan";
            header("Location: index.php"); // Redirect to index.php after successful update
            exit();
        } else {
            $error = "Data gagal ditambahkan";
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
    <title>Add Data</title>
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

            <h1 class="card-header">Add Data</h1>
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
                        <option value="Post Evaluasi">Post Evaluasi</option>
                        <option value="Direct Complain">Direct Complain</option>
                    </select>
                </div>
                
            <div class="mb-3">
                <label for="NID" class="form-label">NID</label>
                
                    <input type="text" class="form-control" id="NID" name="NID">
                
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="nama">
            </div>
            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan" name="Jabatan">
            </div>
            <div class="mb-3">
                <label for="unit" class="form-label">Unit</label>
                    <input type="text" class="form-control" id="unit" name="Unit">
            </div>
            <div class="mb-3">
                <label for="judul_pembelajaran" class="form-label">Judul Pembelajaran</label>
                    <input type="text" class="form-control" id="judul_pembelajaran" name="Judul_pembelajaran">
            </div>
            <div class="mb-3">
                <label for="pic" class="form-label">PIC Pelatihan</label>
                    <input type="text" class="form-control" id="pic" name="PIC_pelatihan">
                </div>
            
            <div class="mb-3">
                <label for="batch" class="form-label">Batch</label>
                    <input type="text" class="form-control" id="batch" name="batch">
            </div>
            <div class="mb-3">
                <label for="t_Mulai" class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="t_Mulai" name="t_Mulai">
            </div>
            <div class="mb-3">
                <label for="t_Selesai" class="form-label">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="t_Selesai" name="t_Selesai">
            </div>
            <div class="mb-3">
                <label for="instruktur" class="form-label">Instruktur</label>
                    <input type="text" class="form-control" id="instruktur" name="instruktur">
            </div>
            <div class="mb-3">
                <label for="materi" class="form-label">Materi</label>
                    <input type="text" class="form-control" id="materi" name="materi">
            </div>
            <div class="mb-3">
                <label for="peserta" class="form-label">Peserta</label>
                    <input type="text" class="form-control" id="peserta" name="peserta">
            </div>
            <div class="mb-3">
                <label for="penyelenggara" class="form-label">Penyelenggara</label>
                    <input type="text" class="form-control" id="penyelenggara" name="penyelenggara">
            </div>
            <div class="mb-3">
                <label for="saran" class="form-label">Saran/Kritik</label>
                    <input type="text" class="form-control" id="saran" name="saran">
            </div>
            <div class="mb-3">
                <label for="action" class="form-label">Action Plan</label>
                    <input type="text" class="form-control" id="action" name="action">
            </div>
            <div class="mb-3">
                <label for="progress" class="form-label">Progress Action Plan</label>
                    <input type="text" class="form-control" id="progress" name="progress">
            </div>
            <div class="mb-3">
                <label for="per_pro" class="form-label">Prosentase Progress</label>
                    <input type="text" class="form-control" id="per_pro" name="per_pro">
            </div>
            <div class="mb-3">
                <label for="evidence" class="form-label">Evidence Tindak Lanjut</label>
                <input type="file" class="form-control" id="evidence" name="evidence[]" multiple accept="image/*,.pdf,.doc,.docx">
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                    <div class="input-group">
                        <select class="form-control" id="status" name="status">
                            <option value="Open">Open</option>
                            <option value="Close">Close</option>
                        </select>
                </div>
            </div>
            <div class="col-12">
                    <input type="submit" name="add" value="Add" class="btn btn-primary" />
            </div>
        </form>
    </div>
</body>

</html>
