<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-history"></i> Data Riwayat Pengembalian</h3>
        </div>
        
        <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead class="bg-primary">
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th width="35%">Judul Buku</th>
                            <th width="35%">Peminjam</th>
                            <th width="25%" class="text-center">Tanggal Kembali</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = "SELECT b.judul_buku, a.id_anggota, a.nama, s.tgl_kembali 
                                  FROM tb_sirkulasi s 
                                  INNER JOIN tb_buku b ON s.id_buku = b.id_buku 
                                  INNER JOIN tb_anggota a ON s.id_anggota = a.id_anggota 
                                  WHERE s.status = 'KEM' 
                                  ORDER BY s.tgl_kembali DESC";
                        
                        $sql = $koneksi->query($query);

                        while ($data = $sql->fetch_assoc()):
                            $tgl = $data['tgl_kembali'];
                            $tgl_format = ($tgl == null || $tgl == '0000-00-00') ? "-" : date("d F Y", strtotime($tgl));
                        ?>
                        <tr>
                            <td class="text-center"><b><?= $no++; ?></b></td>
                            <td><?= $data['judul_buku']; ?></td>
                            <td>
                                <strong><?= $data['id_anggota']; ?></strong><br>
                                <small class="text-muted"><?= $data['nama']; ?></small>
                            </td>
                            <td class="text-center">
                                <span class="label label-info" style="font-size: 0.9em;">
                                    <i class="fa fa-calendar-check-o"></i> <?= $tgl_format; ?>
                                </span>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>