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
                <th colspan="5" style="text-align: center;"><?= $judul ?></th>
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
            <?php 
                    $no=1; 
                    $peserta_sorted = array(); // Array untuk menyimpan peserta dan nilai total
                    foreach($nama_peserta as $peserta): 
                        $nilai = $this->m_matriks->view_nilai($peserta['id_peserta']);
                        $total = 0;

                        foreach ($nilai->result_array() as $nilai) {
                            $total += ($nilai['hasil']);
                        }

                        $peserta_sorted[] = array(
                            'id_peserta' => $peserta['id_peserta'],
                            'nama_peserta' => $peserta['nama_peserta'],
                            'asal_sekolah' => $peserta['asal_sekolah'],
                            'tinggi_bb' => $peserta['tinggi_bb'],
                            'berat_bb' => $peserta['berat_bb'],
                            'hasil' => $total
                        );
                        // Urutkan peserta berdasarkan total_nilai secara menurun
                        usort($peserta_sorted, function($a, $b) {
                            return $b['hasil'] <=> $a['hasil'];
                        });
                    ?>
            <?php endforeach; ?>
            <tr>
                <?php foreach ($peserta_sorted as $peserta): ?>
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

                <td>
                    
                    <?php
                    $nilai = $this->m_matriks->view_nilai($peserta['id_peserta']);
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
        <h3 class="box-title">Hasil Normalisasi dan Perangkingan <?= $judul ?></h3>
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th rowspan="2" style="vertical-align: middle;">No</th>
                        <th rowspan="2" style="vertical-align: middle;">Nama Peserta</th>
                        <th rowspan="2" style="vertical-align: middle;">Asal Sekolah</th>
                        <th colspan="5" style="text-align: center;"><?= $judul ?></th>
                        <th rowspan="2" style="vertical-align: middle;">Hasil Normalisasi</th>
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
                    arsort($results);

                    
                    foreach ($results as $key => $normalisasi): 
                        $peserta = $nama_peserta[$key];
                ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $peserta['nama_peserta'] ?></td>
                        <td><?= $peserta['asal_sekolah'] ?></td>
                        <?php foreach ($matrix[$key] as $nilai_kriteria): ?>
                        <td><?= $nilai_kriteria ?></td>
                        <?php endforeach; ?>
                        <td><?= $matrix[$key][$normalisasi] ?></td>
                        <td>
                            <?php $normalisasi = number_format($normalisasi, 2, '.', ''); ?>
                            <?= $normalisasi ?>
                        </td>
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
</div>
<?php endif; ?>

<?php $this->load->view('template/footer'); ?>