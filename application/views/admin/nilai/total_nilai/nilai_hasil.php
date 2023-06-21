<?php $this->load->view('template/header'); ?>
<?php $nilai = $this->m_nilai_hasil->view(); ?>
<?php if ($nilai->num_rows() == 0): ?>
<h1 class="text-center">Belum Ada Nilai Yang Ditampilkan</h1>
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
                <?php $nilai = $this->m_matriks->view_nilai($peserta['id_peserta']); ?>
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
</div>
</div>
</div>


<!-- general form elements -->
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Hasil Optimasi</h3>
        <div class="table-responsive">
            <table id="example1" class="table table-bordered  table-striped">
                <thead>
                    <tr>
                        <th class="col-xs-1">Rangking</th>
                        <th>Nama</th>
                        <th>Asal Sekolah</th>
                        <th>Nilai Hasil Optimasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($data as $nilai): ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $nilai['nama_peserta'] ?></td>
                        <td><?= $nilai['asal_sekolah'] ?></td>
                        <td><?= $nilai['hasil'] ?></td>
                    </tr>
                    <?php $no++; endforeach; ?>
                </tbody>
            </table>

            <?php endif; ?>
            <?php $this->load->view('template/footer'); ?>