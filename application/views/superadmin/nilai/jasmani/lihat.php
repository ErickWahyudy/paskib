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

$nilai = $this->m_jasmani->view($tahun); 
if ($nilai->num_rows() == 0): 
?>
<h1 class="text-center">Belum Ada Nilai Yang Diinputkan</h1>

<?php else: ?>
<a href="javascript:void(0)" onclick="hapusnilai()" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus
    Semua Nilai</a>
<div class="table-responsive">
    <table id="" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th rowspan="3" style="vertical-align: middle;">No</th>
                <th rowspan="3" style="vertical-align: middle;">Nama Peserta</th>
                <th rowspan="3" style="vertical-align: middle;">Asal Sekolah</th>
                <th rowspan="3" style="vertical-align: middle;">Tinggi Badan</th>
                <th rowspan="3" style="vertical-align: middle;">Berat Badan</th>
                <th colspan="3" style="text-align: center;"><?= $judul ?></th>
                <th rowspan="3" style="vertical-align: middle;">Rata-rata Nilai <?= $nama_nilai1 ?></th>
                <th rowspan="3" style="vertical-align: middle;">Rata-rata Nilai <?= $nama_nilai2 ?></th>
                <th rowspan="3" style="vertical-align: middle;">Rata-rata Nilai <?= $nama_nilai3 ?></th>
                <th rowspan="3" style="vertical-align: middle;">Total Nilai </th>
                <th rowspan="3" style="vertical-align: middle;">Kriteria </th>
            </tr>
            <tr>
                <th colspan="3" style="text-align: center;">
                    Penilai 1
                </th>
            </tr>
            <tr>
                <?php foreach($view_juri as $juri): ?>
                <th><?= $nama_nilai1 ?></th>
                <th><?= $nama_nilai2 ?></th>
                <th><?= $nama_nilai3 ?></th>
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
                <?php $nilai = $this->m_jasmani->view_nilai($peserta['id_peserta'], $tahun); ?>
                <?php foreach($nilai->result_array() as $nilai): ?>
                <?php if ($nilai['id_jasmani'] == $peserta['id_peserta'] && $nilai['id_jasmani'] == NULL): ?>
                <td colspan="4" style="text-align: center;">Belum dinilai</td>
                <?php else: ?>
                <td><?= $nilai['nilai_lari'] ?></td>
                <td><?= $nilai['nilai_pushUp'] ?></td>
                <td><?= $nilai['nilai_sitUp'] ?></td>
                <?php endif; ?>
                <?php endforeach; ?>

                <!-- rata-rata nilai -->
                <td>
                    <?php
                    $nilai = $this->m_jasmani->view_nilai($peserta['id_peserta'], $tahun);
                    $total1 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        if ($nilai['nilai_lari'] == NULL) {
                            $nilai['nilai_lari'] = 0;
                        } else {
                            $total1 += $nilai['nilai_lari'];
                        }
                    }
                        $total1 = $total1;
                        $total1 = number_format($total1, 2);
                    ?>
                    <?= $total1 ?>
                </td>
                <td>
                    <?php
                    $nilai = $this->m_jasmani->view_nilai($peserta['id_peserta'], $tahun);
                    $total2 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        if ($nilai['nilai_pushUp'] == NULL) {
                            $nilai['nilai_pushUp'] = 0;
                        } else {
                            $total2 += $nilai['nilai_pushUp'];
                        }
                    }
                        $total2 = $total2;
                        $total2 = number_format($total2, 2);
                    ?>
                    <?= $total2 ?>
                </td>
                <td>
                    <?php
                    $nilai = $this->m_jasmani->view_nilai($peserta['id_peserta'], $tahun);
                    $total3 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        if ($nilai['nilai_sitUp'] == NULL) {
                            $nilai['nilai_sitUp'] = 0;
                        } else {
                            $total3 += $nilai['nilai_sitUp'];
                        }
                    }
                        $total3 = $total3;
                        $total3 = number_format($total3, 2);
                    ?>
                    <?= $total3 ?>
                </td>

                <form id="add" method="post">
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
                        <?php 
                            $kriteria = $this->m_kriteria->NilaiKriteriaJasmani($total);
                        ?>
                        <?= $kriteria ?>                        
                    
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

<script>
//ajax hapus
function hapusnilai() {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Data Akan Dihapus",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Tidak, Batalkan!",
        closeOnConfirm: false,
        closeOnCancel: true // Set this to true to close the dialog when the cancel button is clicked
    }).then(function(result) {
        if (result.value) { // Only delete the data if the user clicked on the confirm button
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('superadmin/nilai/jasmani/api_empty_table/') ?>",
                dataType: "json",
            }).done(function() {
                swal({
                    title: "Berhasil",
                    text: "Data Berhasil Dihapus",
                    type: "success",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE"
                }).then(function() {
                    location.reload();
                });
            }).fail(function() {
                swal({
                    title: "Gagal",
                    text: "Data Gagal Dihapus",
                    type: "error",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE"
                }).then(function() {
                    location.reload();
                });
            });
        } else { // If the user clicked on the cancel button, show a message indicating that the deletion was cancelled
            swal("Batal hapus", "Data Tidak Jadi Dihapus", "error");
        }
    });
}
</script>

<?php endif; ?>
<?php $this->load->view('template/footer'); ?>