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
<?php 
if($aksi == "lihat"):
    $nilai = $this->m_parade->view($tahun); 
    if ($nilai->num_rows() == 0): 
    ?>
    <h1 class="text-center">Belum Ada Nilai Yang Diinputkan</h1>
    
    <?php else: ?>  
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4>
        <i class="icon fa fa-info"></i> <?= $judul ?> Tahun <?= $tahun ?>
    </h4>
</div>  
<div class="table-responsive">
    <table id="" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th rowspan="3" style="vertical-align: middle;">No</th>
                <th rowspan="3" style="vertical-align: middle;">Nama Peserta</th>
                <th rowspan="3" style="vertical-align: middle;">Asal Sekolah</th>
                <th rowspan="3" style="vertical-align: middle;">Tinggi Badan</th>
                <th rowspan="3" style="vertical-align: middle;">Berat Badan</th>
                <th colspan="15" style="text-align: center;"><?= $judul ?></th>
                <th rowspan="3" style="vertical-align: middle;">Rata-Rata Nilai <?= $nama_nilai1 ?></th>
                <th rowspan="3" style="vertical-align: middle;">Rata-Rata Nilai <?= $nama_nilai2 ?></th>
                <th rowspan="3" style="vertical-align: middle;">Rata-Rata Nilai <?= $nama_nilai3 ?></th>
                <th rowspan="3" style="vertical-align: middle;">Rata-Rata Nilai <?= $nama_nilai4 ?></th>
                <th rowspan="3" style="vertical-align: middle;">Rata-Rata Nilai <?= $nama_nilai5 ?></th>
                <th rowspan="3" style="vertical-align: middle;">Total Nilai</th>
                <th rowspan="3" style="vertical-align: middle;">Kriteria</th>
            </tr>
            <tr>
                <?php $no=1; foreach($view_juri as $juri): ?>
                <th colspan="5" style="text-align: center;">
                    Penilai <?= $no ?> /
                    <?= $juri['nama'] ?>
                </th>
                <?php $no++; endforeach; ?>
            </tr>
            <tr>
                <?php foreach($view_juri as $juri): ?>
                <th><?= $nama_nilai1 ?></th>
                <th><?= $nama_nilai2 ?></th>
                <th><?= $nama_nilai3 ?></th>
                <th><?= $nama_nilai4 ?></th>
                <th><?= $nama_nilai5 ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($nama_peserta as $peserta): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $peserta['nama_peserta'] ?></td>
                <td><?= $peserta['asal_sekolah'] ?></td>
                <td><?= $peserta['tinggi_bb'] ?> cm </td>
                <td><?= $peserta['berat_bb'] ?> kg </td>
                <?php $nilai = $this->m_parade->view_nilai($peserta['id_peserta'], $tahun); ?>
                <?php foreach($nilai->result_array() as $nilai): ?>
                <?php if ($nilai['id_parade'] == $peserta['id_peserta'] && $nilai['id_parade'] == NULL): ?>
                <td colspan="4" style="text-align: center;">Belum dinilai</td>
                <?php else: ?>
                <td><?= $nilai['nilai_wjh'] ?></td>
                <td><?= $nilai['nilai_bdn'] ?></td>
                <td><?= $nilai['nilai_bp'] ?></td>
                <td><?= $nilai['nilai_tgn'] ?></td>
                <td><?= $nilai['nilai_kk'] ?></td>
                <?php endif; ?>
                <?php endforeach; ?>

                <!-- rata-rata nilai -->
                <td>
                    <?php
                    $nilai = $this->m_parade->view_nilai($peserta['id_peserta'], $tahun);
                    $total1 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        if ($nilai['nilai_wjh'] == 0) {
                            $total1 += 0;
                        } else {
                            $total1 += $nilai['nilai_wjh'];
                        }
                    }
                        $total1 = $total1 / $juri = $this->m_parade->view_juri()->num_rows();
                        $total1 = number_format($total1, 2);
                    ?>
                    <?= $total1 ?>
                </td>
                <td>
                    <?php
                    $nilai = $this->m_parade->view_nilai($peserta['id_peserta'], $tahun);
                    $total2 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        if ($nilai['nilai_bdn'] == 0) {
                            $total2 += 0;
                        } else {
                            $total2 += $nilai['nilai_bdn'];
                        }
                    }
                        $total2 = $total2 / $juri = $this->m_parade->view_juri()->num_rows();
                        $total2 = number_format($total2, 2);
                    ?>
                    <?= $total2 ?>
                </td>
                <td>
                    <?php
                    $nilai = $this->m_parade->view_nilai($peserta['id_peserta'], $tahun);
                    $total3 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        if ($nilai['nilai_bp'] == 0) {
                            $total3 += 0;
                        } else {
                            $total3 += $nilai['nilai_bp'];
                        }
                    }
                        $total3 = $total3 / $juri = $this->m_parade->view_juri()->num_rows();
                        $total3 = number_format($total3, 2);
                    ?>
                    <?= $total3 ?>
                </td>
                <td>
                    <?php
                    $nilai = $this->m_parade->view_nilai($peserta['id_peserta'], $tahun);
                    $total4 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        if ($nilai['nilai_tgn'] == 0) {
                            $total4 += 0;
                        } else {
                            $total4 += $nilai['nilai_tgn'];
                        }
                    }
                        $total4 = $total4 / $juri = $this->m_parade->view_juri()->num_rows();
                        $total4 = number_format($total4, 2);
                    ?>
                    <?= $total4 ?>
                </td>
                <td>
                    <?php
                    $nilai = $this->m_parade->view_nilai($peserta['id_peserta'], $tahun);
                    $total5 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        if ($nilai['nilai_kk'] == 0) {
                            $total5 += 0;
                        } else {
                            $total5 += $nilai['nilai_kk'];
                        }
                    }
                        $total5 = $total5 / $juri = $this->m_parade->view_juri()->num_rows();
                        $total5 = number_format($total5, 2);
                    ?>
                    <?= $total5 ?>
                </td>

                    <td>
                        <?php
                        $total = 0;
                        $total = $total1 + $total2 + $total3;
                        $total = $total / 3;
                        $total = number_format($total, 0);
                    ?>
                        <?= $total ?>
                    </td>
                    <td>
                        <?= $kriteria = $this->m_kriteria->NilaiKriteriaParade($total) ?>
                    </td>
                    <?php $no++;  endforeach; ?>
            </tr>
        </tbody>
    </table>
</div>
<?php endif; ?>
<?php
    endif;
    ?>

<?php endif; ?>
<?php $this->load->view('template/footer'); ?>