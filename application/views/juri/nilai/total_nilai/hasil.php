<?php $this->load->view('template/header'); ?>
<?php if($depan == TRUE): 
      $kode_tahun = date("Y");      
?>
<table class="table table-striped">
    <form action="" method="POST">           
        <tr>
            <th>Tahun</th>
            <td>
                <input type="number" name="tahun" class="form-control" value="<?= $kode_tahun ?>" placeholder="tahun"
                    required="">
            </td>
        </tr>
        <tr>
            <th></th>
            <td>
                <input type="submit" name="cari" value="Buka Peserta" class="btn btn-primary">
            </td>
        </tr>
    </form>
</table>

<?php elseif($depan == FALSE): ?>
    <?php $nilai = $this->m_nilai_hasil->view($tahun); ?>
        <?php if ($nilai->num_rows() == 0): ?>
        <h1 class="text-center">Proses Perhitungan Nilai Belum Selesai</h1>
        <?php else: ?>
            <div class="table-responsive">
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th class="col-xs-1" rowspan="2" style="vertical-align: middle;">Rangking</th>
                <th rowspan="2" style="vertical-align: middle;">Nama</th>
                <th rowspan="2" style="vertical-align: middle;">Asal Sekolah</th>
                <th colspan="5" style="text-align: center;"><?= $judul ?></th>
            </tr>
            <tr>
                <?php foreach($criteria as $kriteria): ?>
                <th colspan="1" style="text-align: center;">
                    <?= $kriteria ?>
                </th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
                    <?php 
                        $no = 1;
                        // Mengurutkan array berdasarkan nilai $results secara descending
                        arsort($results);

                        foreach ($results as $key => $normalisasi): 
                            $peserta = $nama_peserta[$key];
                            $normalisasi_values = $normalizedMatrix[$key];
                    ?>
                        <tr>
                                <td><?= $no ?></td>
                                <td><?= $peserta['nama_peserta'] ?></td>
                                <td><?= $peserta['asal_sekolah'] ?></td>
                                <td><?= $peserta['tinggi_bb'] ?> cm </td>
                                <td><?= $peserta['berat_bb'] ?> kg </td>
                                <?php $nilai = $this->m_matriks->view_nilai($peserta['id_peserta'], $tahun); ?>
                                <?php foreach($nilai->result_array() as $nilai): ?>
                                <td>
                                    <?= $nilai['hasil'] ?>
                                </td>
                                <?php endforeach; ?>                
                        </tr>
                    <?php 
                        $no++; 
                        endforeach; 
                    ?>
        </tbody>
    </table>
    <?php endif; ?>
    <?php endif; ?>
    <?php $this->load->view('template/footer'); ?>
