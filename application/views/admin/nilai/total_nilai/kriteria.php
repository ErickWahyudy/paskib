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
                <input type="submit" name="cari" value="Buka Nilai" class="btn btn-primary">
            </td>
        </tr>
    </form>
</table>

<?php elseif($depan == FALSE): ?>
<div class="table-responsive">
    <?php $nilai = $this->m_matriks->view_nilaihasil($tahun); ?>
    <?php if ($nilai->num_rows() == 0): ?>
    <h1 class="text-center">Belum Ada Nilai Yang Diinputkan</h1>
    <?php else: ?>
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4>
            <i class="icon fa fa-info"></i> <?= $judul ?> Tahun <?= $tahun ?>
        </h4>
    </div>
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th rowspan="2" style="vertical-align: middle;">No</th>
                <th rowspan="2" style="vertical-align: middle;">Nama Peserta</th>
                <th rowspan="2" style="vertical-align: middle;">Asal Sekolah</th>
                <th colspan="5" style="text-align: center;"><?= $judul2 ?></th>
                <th rowspan="2" style="vertical-align: middle;">Total Nilai </th>
            </tr>
            <tr>
                <?php foreach($view_kriteria as $kriteria): ?>
                <th colspan="1" style="text-align: center;">
                    <?= $kriteria['kriteria'] ?>
                </th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php  $no=1; foreach ($nama_peserta as $peserta): ?>
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

                <td>

                    <?php
                    $nilai = $this->m_matriks->view_nilai($peserta['id_peserta'], $tahun);
                    $total = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        $total += ($nilai['hasil']);
                    }
                    ?>
                    <?= $total ?>
                </td>

            </tr>

            <?php $no++;  endforeach; ?>
            </tr>
        </tbody>
    </table>
</div>
</div>
</div>


<!-- general form elements -->
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Hasil <?= $judul ?></h3>
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th rowspan="2" style="vertical-align: middle;">No</th>
                        <th rowspan="2" style="vertical-align: middle;">Nama Peserta</th>
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

                        foreach ($results as $key => $normalisasi): 
                            $peserta = $nama_peserta[$key];
                            $normalisasi_values = $normalizedMatrix[$key];
                        ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $peserta['nama_peserta'] ?></td>
                        <td><?= $peserta['asal_sekolah'] ?></td>
                        <?php foreach ($matrix[$key] as $nilai_kriteria): ?>
                        <td><?= $nilai_kriteria ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <?php 
                        $no++; 
                        endforeach; 
                    ?>

                </tbody>
            </table>
            <div>
                <h5>Nilai kriteria:</h5>
                <ul>
                    <li>1 = Cukup</li>
                    <li>2 = Baik</li>
                    <li>3 = Sangat Baik</li>
                </ul>
            </div>
        </div>
    </div>

    <?php endif; ?>
    <?php endif; ?>
    <?php $this->load->view('template/footer'); ?>