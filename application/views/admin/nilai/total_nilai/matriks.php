<?php $this->load->view('template/header'); ?>

<div class="table-responsive">
        <?php $nilai = $this->m_matriks->view_nilaihasil(); ?>
        <?php if ($nilai->num_rows() == 0): ?>
        <h1 class="text-center">Belum Ada Nilai Yang Diinputkan</h1>
        <?php else: ?>
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th rowspan="2" style="vertical-align: middle;">No</th>
                <th rowspan="2" style="vertical-align: middle;">Nama Peserta</th>
                <th rowspan="2" style="vertical-align: middle;">Asal Sekolah</th>
                <th colspan="5" style="text-align: center;"><?= $judul2 ?></th>
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
                <?php $no=1;  foreach ($nama_peserta as $peserta): ?>
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
        <h3 class="box-title">Hasil Normalisasi & Optimasi <?= $judul ?></h3>
        <div class="table-responsive">
            <table id="" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th rowspan="2" style="vertical-align: middle;">No</th>
                        <th rowspan="2" style="vertical-align: middle;">Nama Peserta</th>
                        <th rowspan="2" style="vertical-align: middle;">Asal Sekolah</th>
                        <th colspan="5" style="text-align: center;"><?= $judul ?> Hasil Normalisasi</th>
                        <th rowspan="2" style="vertical-align: middle;">Hasil Optimasi</th>
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
                        // arsort($results);

                        foreach ($results as $key => $normalisasi): 
                            $peserta = $nama_peserta[$key];
                            $normalisasi_values = $normalizedMatrix[$key];
                    ?>
                         <tr>
                            <td><?= $no ?></td>
                            <td><?= $peserta['nama_peserta'] ?></td>
                            <td><?= $peserta['asal_sekolah'] ?></td>
                                <?php foreach ($normalisasi_values as $normalized_value): 
                                    //membulatkan nilai ke atas
                                    $normalized_value = ceil($normalized_value * 100000) / 100000;
                                ?>
                                <td><?= $normalized_value ?></td>
                                <?php endforeach; ?>
                            <td>
                                <?php $normalisasi = number_format($normalisasi, 5, '.', ''); ?>
                                <?= $normalisasi ?>
                            </td>
                        </tr>
                    <?php 
                        $no++; 
                        endforeach; 
                    ?>

                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

<?php $this->load->view('template/footer'); ?>