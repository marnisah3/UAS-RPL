<?php
// Logika Kode Otomatis (Contoh: B001)
$carikode = mysqli_query($koneksi, "SELECT id_buku FROM tb_buku ORDER BY id_buku DESC");
$datakode = mysqli_fetch_array($carikode);
$format = "B001"; // Default jika tabel masih kosong

if ($datakode) {
    $kode = $datakode['id_buku'];
    $urut = substr($kode, 1, 3);
    $tambah = (int) $urut + 1;

    if (strlen($tambah) == 1) {
        $format = "B" . "00" . $tambah;
    } else if (strlen($tambah) == 2) {
        $format = "B" . "0" . $tambah;
    } else {
        $format = "B" . $tambah;
    }
}
?>

<section class="content-header">
    <h1>Master Data <small>Data Buku</small></h1>
    <ol class="breadcrumb">
        <li>
            <a href="index.php">
                <i class="fa fa-home"></i> <b>Si Perpustakaan</b>
            </a>
        </li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-book"></i> Tambah Buku</h3>
                </div>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label>ID Buku</label>
                            <input type="text" name="id_buku" class="form-control" value="<?= $format; ?>" readonly />
                        </div>

                        <div class="form-group">
                            <label>Judul Buku</label>
                            <input type="text" name="judul_buku" class="form-control" placeholder="Masukkan Judul Buku" required>
                        </div>

                        <div class="form-group">
                            <label>Pengarang</label>
                            <input type="text" name="pengarang" class="form-control" placeholder="Nama Pengarang" required>
                        </div>

                        <div class="form-group">
                            <label>Penerbit</label>
                            <input type="text" name="penerbit" class="form-control" placeholder="Nama Penerbit" required>
                        </div>

                        <div class="form-group">
                            <label>Tahun Terbit</label>
                            <input type="number" name="th_terbit" class="form-control" placeholder="Contoh: 2024" required>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" name="Simpan" class="btn btn-info">
                            <i class="fa fa-save"></i> Simpan Data
                        </button>
                        <a href="?page=MyApp/data_buku" class="btn btn-warning">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
if (isset($_POST['Simpan'])) {
    // Menangkap data POST
    $id_buku    = $_POST['id_buku'];
    $judul      = $_POST['judul_buku'];
    $pengarang  = $_POST['pengarang'];
    $penerbit   = $_POST['penerbit'];
    $th_terbit  = $_POST['th_terbit'];

    $sql_simpan = "INSERT INTO tb_buku (id_buku, judul_buku, pengarang, penerbit, th_terbit) VALUES (
        '$id_buku', 
        '$judul', 
        '$pengarang', 
        '$penerbit', 
        '$th_terbit')";

    $query_simpan = mysqli_query($koneksi, $sql_simpan);
    mysqli_close($koneksi);

    if ($query_simpan) {
        echo "<script>
        Swal.fire({title: 'Tambah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=MyApp/data_buku';
            }
        })</script>";
    } else {
        echo "<script>
        Swal.fire({title: 'Tambah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=MyApp/add_buku';
            }
        })</script>";
    }
}
?>