<?php $this->load->view('template/header'); ?>

<?php 
if($aksi == "lihat"):
    $nilai = $this->m_parade->view(); 
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
                <?php $nilai = $this->m_parade->view_nilai($peserta['id_peserta']); ?>
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
                    $nilai = $this->m_parade->view_nilai($peserta['id_peserta']);
                    $total1 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        if ($nilai['nilai_wjh'] == 0) {
                            $total1 += 0;
                        } else {
                            $total1 += $nilai['nilai_wjh'];
                        }
                    }
                        $total1 = $total1 / $juri = $this->m_parade->view_juri()->num_rows();
                        $total1 = number_format($total1, 0);
                    ?>
                    <?= $total1 ?>
                </td>
                <td>
                    <?php
                    $nilai = $this->m_parade->view_nilai($peserta['id_peserta']);
                    $total2 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        if ($nilai['nilai_bdn'] == 0) {
                            $total2 += 0;
                        } else {
                            $total2 += $nilai['nilai_bdn'];
                        }
                    }
                        $total2 = $total2 / $juri = $this->m_parade->view_juri()->num_rows();
                        $total2 = number_format($total2, 0);
                    ?>
                    <?= $total2 ?>
                </td>
                <td>
                    <?php
                    $nilai = $this->m_parade->view_nilai($peserta['id_peserta']);
                    $total3 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        if ($nilai['nilai_bp'] == 0) {
                            $total3 += 0;
                        } else {
                            $total3 += $nilai['nilai_bp'];
                        }
                    }
                        $total3 = $total3 / $juri = $this->m_parade->view_juri()->num_rows();
                        $total3 = number_format($total3, 0);
                    ?>
                    <?= $total3 ?>
                </td>
                <td>
                    <?php
                    $nilai = $this->m_parade->view_nilai($peserta['id_peserta']);
                    $total4 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        if ($nilai['nilai_tgn'] == 0) {
                            $total4 += 0;
                        } else {
                            $total4 += $nilai['nilai_tgn'];
                        }
                    }
                        $total4 = $total4 / $juri = $this->m_parade->view_juri()->num_rows();
                        $total4 = number_format($total4, 0);
                    ?>
                    <?= $total4 ?>
                </td>
                <td>
                    <?php
                    $nilai = $this->m_parade->view_nilai($peserta['id_peserta']);
                    $total5 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        if ($nilai['nilai_kk'] == 0) {
                            $total5 += 0;
                        } else {
                            $total5 += $nilai['nilai_kk'];
                        }
                    }
                        $total5 = $total5 / $juri = $this->m_parade->view_juri()->num_rows();
                        $total5 = number_format($total5, 0);
                    ?>
                    <?= $total5 ?>
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
                        <?= $kriteria = $this->m_kriteria->NilaiKriteriaParade($total) ?>
                        <input type="hidden" name="id_peserta[]" value="<?= $nilai['id_peserta'] ?>">
                        <input type="hidden" name="hasil[]" value="<?= $total ?>">
                        <input type="hidden" name="nilai_kriteria[]" value="<?= $kriteria ?>">
                    </td>
                    <?php $no++;  endforeach; ?>
            </tr>
            <tr>
                <td colspan="26" style="text-align: center;">
                    <button type="submit" class="btn btn-primary btn-md">Simpan Nilai</button>
                </td>
            </tr>
            </form>
        </tbody>
    </table>
</div>
<?php endif; ?>
<?php
    endif;
    ?>

<script>
//add data
$(document).ready(function() {
    $('#add').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= site_url('superadmin/nilai/matriks/api_add_parade') ?>",
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
                url: "<?php echo site_url('superadmin/nilai/parade/api_empty_table/') ?>",
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

<?php $this->load->view('template/footer'); ?>