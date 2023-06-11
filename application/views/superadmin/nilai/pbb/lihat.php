<?php $this->load->view('template/header'); ?>

<?php 
if($aksi == "lihat"):
?>
<div class="table-responsive">
    <table id="" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th rowspan="3" style="vertical-align: middle;">No</th>
                <th rowspan="3" style="vertical-align: middle;">Nama Peserta</th>
                <th rowspan="3" style="vertical-align: middle;">Asal Sekolah</th>
                <th rowspan="3" style="vertical-align: middle;">Tinggi Badan</th>
                <th rowspan="3" style="vertical-align: middle;">Berat Badan</th>
                <th colspan="12" style="text-align: center;"><?= $judul ?></th>
                <th rowspan="3" style="vertical-align: middle;">Rata-Rata Nilai <?= $nama_nilai1 ?></th>
                <th rowspan="3" style="vertical-align: middle;">Rata-Rata Nilai <?= $nama_nilai2 ?></th>
                <th rowspan="3" style="vertical-align: middle;">Rata-Rata Nilai <?= $nama_nilai3 ?></th>
                <th rowspan="3" style="vertical-align: middle;">Rata-Rata Nilai <?= $nama_nilai4 ?></th>
                <th rowspan="3" style="vertical-align: middle;">Total Nilai</th>
                <th rowspan="3" style="vertical-align: middle;">Kriteria</th>
            </tr>
            <tr>
                <?php $no=1; foreach($view_juri as $juri): ?>
                <th colspan="4" style="text-align: center;">
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
                <?php $nilai = $this->m_pbb->view_nilai($peserta['id_peserta']); ?>
                <?php foreach($nilai->result_array() as $nilai): ?>
                <?php if ($nilai['id_pbb'] == $peserta['id_peserta'] && $nilai['id_pbb'] == NULL): ?>
                <td colspan="4" style="text-align: center;">Belum dinilai</td>
                <?php else: ?>
                <td><?= $nilai['nilai_sk'] ?></td>
                <td><?= $nilai['nilai_gb'] ?></td>
                <td><?= $nilai['nilai_gd'] ?></td>
                <td><?= $nilai['nilai_ab'] ?></td>
                <?php endif; ?>
                <?php endforeach; ?>

                <!-- rata-rata nilai -->
                <td>
                    <?php
                    $nilai = $this->m_pbb->view_nilai($peserta['id_peserta']);
                    $total1 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        $total1 += $nilai['nilai_sk'];
                    }
                        $total1 = $total1 / $juri = $this->m_pbb->view_juri()->num_rows();
                        $total1 = number_format($total1, 2);
                    ?>
                    <?= $total1 ?>
                </td>
                <td>
                    <?php
                    $nilai = $this->m_pbb->view_nilai($peserta['id_peserta']);
                    $total2 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        $total2 += $nilai['nilai_gb'];
                    }
                        $total2 = $total2 / $juri = $this->m_pbb->view_juri()->num_rows();
                        $total2 = number_format($total2, 2);
                    ?>
                    <?= $total2 ?>
                </td>
                <td>
                    <?php
                    $nilai = $this->m_pbb->view_nilai($peserta['id_peserta']);
                    $total3 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        $total3 += $nilai['nilai_gd'];
                    }
                        $total3 = $total3 / $juri = $this->m_pbb->view_juri()->num_rows();
                        $total3 = number_format($total3, 2);
                    ?>
                    <?= $total3 ?>
                </td>
                <td>
                    <?php
                    $nilai = $this->m_pbb->view_nilai($peserta['id_peserta']);
                    $total4 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        $total4 += $nilai['nilai_ab'];
                    }
                        $total4 = $total4 / $juri = $this->m_pbb->view_juri()->num_rows();
                        $total4 = number_format($total4, 2);
                    ?>
                    <?= $total4 ?>
                </td>

                <form id="add" method="post">
                    <td>
                        <?php
                        $total = 0;
                        $total = $total1 + $total2 + $total3;
                        $total = $total / 3;
                        $total = number_format($total, 2);
                    ?>
                        <?= $total ?>
                    </td>
                    <td>
                        <?= $kriteria = $this->m_kriteria->NilaiKriteriaPBB($total) ?>
                        <input type="hidden" name="id_peserta[]" value="<?= $nilai['id_peserta'] ?>">
                        <input type="hidden" name="hasil[]" value="<?= $total ?>">
                        <input type="hidden" name="nilai_kriteria[]" value="<?= $kriteria ?>">
                    </td>

                    <?php $no++;  endforeach; ?>
            </tr>
            <tr>
                <td colspan="22" style="text-align: center;">
                    <button type="submit" class="btn btn-primary btn-md">Simpan Nilai</button>
                </td>
            </tr>
            </form>
        </tbody>
    </table>
</div>
<?php
    endif;
    ?>

<script>
//add data
$(document).ready(function() {
    $('#add').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= site_url('superadmin/nilai/total_nilai/api_add_pbb') ?>",
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data) {
                $('#add')[0].reset();
                swal({
                    title: "Berhasil",
                    text: "Data berhasil ditambahkan",
                    type: "success",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE",
                }).then(function() {
                    location.reload();
                });
            }
        });
    });
});
</script>

<?php $this->load->view('template/footer'); ?>