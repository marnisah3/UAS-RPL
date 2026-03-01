<section class="content-header">
    <h1 style="text-align:center;">Laporan Sirkulasi</h1>
    <ol class="breadcrumb">
        <li>
            <a href="index.php">
                <i class="fa fa-home"></i> <b>Si Perpustakaan</b>
            </a>
        </li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <a href="?page=MyApp/print_laporan" title="Print" class="btn btn-success">
                <i class="glyphicon glyphicon-print"></i> Cetak Laporan
            </a>
        </div>

        <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead class="bg-primary">
                        <tr>
                            <th class="text-center">No</th>
                            <th>ID SKL</th>
                            <th>Buku</th>
                            <th>Peminjam</th>
                            <th class="text-center">Tgl Pinjam</th>
                            <th class="text-center">Jatuh Tempo</th>
                            <th class="text-center">Tgl Dikembalikan</th>
                            <th class="text-right">Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Menghitung denda berdasarkan tgl_dikembalikan, bukan NOW()
                        $sql = mysqli_query($koneksi, "SELECT 
                            s.id_sk, b.judul_buku, a.nama, s.tgl_pinjam, s.tgl_kembali, s.tgl_kembali,
                            IF(DATEDIFF(s.tgl_kembali, s.tgl_kembali) <= 0, 0, DATEDIFF(s.tgl_kembali, s.tgl_kembali)) AS telat
                            FROM tb_sirkulasi s
                            JOIN tb_anggota a ON a.id_anggota = s.id_anggota 
                            JOIN tb_buku b ON b.id_buku = s.id_buku 
                            WHERE s.status = 'KEM'
                            ORDER BY s.tgl_kembali DESC");

                        $no = 0;
                        $total_denda = 0;
                        $tarif_denda = 1000;

                        while ($data = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
                            $no++;
                            $denda_item = $data['telat'] * $tarif_denda;
                            $total_denda += $denda_item;
                        ?>
                            <tr>
                                <td class="text-center"><?= $no; ?></td>
                                <td><?= $data['id_sk']; ?></td>
                                <td><?= $data['judul_buku']; ?></td>
                                <td><?= $data['nama']; ?></td>
                                <td class="text-center"><?= date('d/M/Y', strtotime($data['tgl_pinjam'])); ?></td>
                                <td class="text-center"><?= date('d/M/Y', strtotime($data['tgl_kembali'])); ?></td>
                                <td class="text-center"><?= date('d/M/Y', strtotime($data['tgl_kembali'])); ?></td>
                                <td class="text-right">Rp <?= number_format($denda_item, 0, ',', '.'); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr class="bg-gray">
                            <th colspan="7" class="text-right">TOTAL KESELURUHAN DENDA :</th>
                            <th class="text-right">Rp <?= number_format($total_denda, 0, ',', '.'); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>