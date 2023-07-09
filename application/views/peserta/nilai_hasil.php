<?php $this->load->view('peserta/header'); ?>
<?php
$tahun = $this->session->userdata('tahun');
?>
    <?php $nilai = $this->m_nilai_hasil->view($tahun); ?>
        <?php if ($nilai->num_rows() == 0): ?>
        <h1 class="text-center">Proses Perhitungan Nilai Belum Selesai</h1>
        <?php else: ?>
            <div class="table-responsive">
    <table id="" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th class="col-xs-1" rowspan="2" style="vertical-align: middle;">Rangking</th>
                <th rowspan="2" style="vertical-align: middle;">Nama</th>
                <th rowspan="2" style="vertical-align: middle;">Asal Sekolah</th>
                <th colspan="5" style="text-align: center;"><?= $judul ?></th>
                <th rowspan="2" style="vertical-align: middle;">Hasil</th>
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
        <!-- nomor 1-2 lulus, 3-akhir tidak lulus -->
        <?php if ($no >= 1 && $no <= $batas_lulus): ?>
            <!-- memberi background warna biru user yang login -->
            <?php if ($this->session->userdata('id_peserta') == $peserta['id_peserta']): ?>
                <td class="bg-blue"><?= $no ?></td>
                <td class="bg-blue"><?= $peserta['nama_peserta'] ?></td>
                <td class="bg-blue"><?= $peserta['asal_sekolah'] ?></td>
                <td class="bg-blue"><?= $peserta['tinggi_bb'] ?> cm </td>
                <td class="bg-blue"><?= $peserta['berat_bb'] ?> kg </td>
                    <?php $nilai = $this->m_matriks->view_nilai($peserta['id_peserta'], $tahun); ?>
                    <?php foreach($nilai->result_array() as $nilai): ?>
                <td class="bg-blue">
                    <?= $nilai['hasil'] ?>
                </td>
                    <?php endforeach; ?>
                <td class="bg-blue">
                    Lulus
                </td>
        <?php else: ?>
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
                        Lulus
                    </td>
                        <?php endif; ?>
        <?php else: ?>
                        <!-- memberi background warna biru user yang login -->
                        <?php if ($this->session->userdata('id_peserta') == $peserta['id_peserta']): ?>
                <td class="bg-blue"><?= $no ?></td>
                <td class="bg-blue"><?= $peserta['nama_peserta'] ?></td>
                <td class="bg-blue"><?= $peserta['asal_sekolah'] ?></td>
                <td class="bg-blue"><?= $peserta['tinggi_bb'] ?> cm </td>
                <td class="bg-blue"><?= $peserta['berat_bb'] ?> kg </td>
                    <?php $nilai = $this->m_matriks->view_nilai($peserta['id_peserta'], $tahun); ?>
                    <?php foreach($nilai->result_array() as $nilai): ?>
                <td class="bg-blue">
                    <?= $nilai['hasil'] ?>
                </td>
                    <?php endforeach; ?>
                <td class="bg-blue">
                    Tidak Lulus
                </td>
        <?php else: ?>
                    <td class="bg-red"><?= $no ?></td>
                    <td class="bg-red"><?= $peserta['nama_peserta'] ?></td>
                    <td class="bg-red"><?= $peserta['asal_sekolah'] ?></td>
                    <td class="bg-red"><?= $peserta['tinggi_bb'] ?> cm </td>
                    <td class="bg-red"><?= $peserta['berat_bb'] ?> kg </td>
                    <?php $nilai = $this->m_matriks->view_nilai($peserta['id_peserta'], $tahun); ?>
                        <?php foreach($nilai->result_array() as $nilai): ?>
                    <td class="bg-red">
                        <?= $nilai['hasil'] ?>
                     </td>
                        <?php endforeach; ?>
                    <td class="bg-red">
                        Tidak Lulus
                    </td>
                        <?php endif; ?>
        <?php endif; ?>
        
        
    </tr>
<?php 
    $no++; 
    endforeach; 
?>

        </tbody>
    </table>
    <?php endif; ?>
    <?php $this->load->view('template/footer'); ?>
