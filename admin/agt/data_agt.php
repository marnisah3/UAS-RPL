<section class="content-header" style="text-align: center;">
    <h1>Data Anggota</h1>
    <ol class="breadcrumb">
        <li>
            <a href="index.php">
                <i class="fa fa-home"></i>
                <b>Si Perpustakaan</b>
            </a>
        </li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <a href="?page=MyApp/add_agt" title="Tambah Data" class="btn btn-primary">
                <i class="glyphicon glyphicon-plus"></i> Tambah Data
            </a>
            <a href="?page=MyApp/print_allagt" title="Print Semua" class="btn btn-success">
                <i class="glyphicon glyphicon-print"></i> Print
            </a>
        </div>
        
        <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>ID Anggota</th>
                            <th>Nama</th>
                            <th class="text-center">JK</th>
                            <th class="text-center">Semester</th> <th>No HP</th>
                            <th class="text-center">Kelola</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql = $koneksi->query("SELECT * FROM tb_anggota");
                        while ($data = $sql->fetch_assoc()) :
                        ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= $data['id_anggota']; ?></td>
                            <td><?= $data['nama']; ?></td>
                            <td class="text-center"><?= $data['jekel']; ?></td>
                            <td class="text-center"><?= $data['kelas']; ?></td> <td><?= $data['no_hp']; ?></td>
                            <td class="text-center">
                                <a href="?page=MyApp/edit_agt&kode=<?= $data['id_anggota']; ?>" 
                                   title="Ubah Data" class="btn btn-success btn-sm">
                                    <i class="glyphicon glyphicon-edit"></i>
                                </a>

                                <a href="?page=MyApp/del_agt&kode=<?= $data['id_anggota']; ?>" 
                                   onclick="return confirm('Yakin Hapus Data Ini?')" 
                                   title="Hapus" class="btn btn-danger btn-sm">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>

                                <a href="?page=MyApp/print_agt&kode=<?= $data['id_anggota']; ?>" 
                                   title="Print Kartu" target="_blank" class="btn btn-primary btn-sm">
                                    <i class="fa fa-print"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>