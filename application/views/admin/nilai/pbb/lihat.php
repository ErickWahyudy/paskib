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
    $nilai = $this->m_pbb->view($tahun); 
    if ($nilai->num_rows() == 0): 
    ?>
    <h1 class="text-center">Belum Ada Nilai Yang Diinputkan</h1>
    
    <?php else: ?>
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
                <?php $nilai = $this->m_pbb->view_nilai($peserta['id_peserta'], $tahun); ?>
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
                    $nilai = $this->m_pbb->view_nilai($peserta['id_peserta'], $tahun);
                    $total1 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        if ($nilai['nilai_sk'] == NULL) {
                            $nilai['nilai_sk'] = 0;
                        } else {
                            $total1 += $nilai['nilai_sk'];
                        }
                    }
                        $total1 = $total1 / $juri = $this->m_pbb->view_juri()->num_rows();
                        $total1 = number_format($total1, 2);
                    ?>
                    <?= $total1 ?>
                </td>
                <td>
                    <?php
                    $nilai = $this->m_pbb->view_nilai($peserta['id_peserta'], $tahun);
                    $total2 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        if ($nilai['nilai_gb'] == NULL) {
                            $nilai['nilai_gb'] = 0;
                        } else {
                            $total2 += $nilai['nilai_gb'];
                        }                    }
                        $total2 = $total2 / $juri = $this->m_pbb->view_juri()->num_rows();
                        $total2 = number_format($total2, 2);
                    ?>
                    <?= $total2 ?>
                </td>
                <td>
                    <?php
                    $nilai = $this->m_pbb->view_nilai($peserta['id_peserta'], $tahun);
                    $total3 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        if ($nilai['nilai_gd'] == NULL) {
                            $nilai['nilai_gd'] = 0;
                        } else {
                            $total3 += $nilai['nilai_gd'];
                        }
                    }
                        $total3 = $total3 / $juri = $this->m_pbb->view_juri()->num_rows();
                        $total3 = number_format($total3, 2);
                    ?>
                    <?= $total3 ?>
                </td>
                <td>
                    <?php
                    $nilai = $this->m_pbb->view_nilai($peserta['id_peserta'], $tahun);
                    $total4 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        if ($nilai['nilai_ab'] == NULL) {
                            $nilai['nilai_ab'] = 0;
                        } else {
                            $total4 += $nilai['nilai_ab'];
                        }
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
                        $total = $total1 + $total2 + $total3 + $total4;
                        $total = $total / 4;
                        $total = number_format($total, 0);
                    ?>
                        <?= $total ?>
                    </td>
                    <td>
                        <?= $kriteria = $this->m_kriteria->NilaiKriteriaPBB($total) ?>
                        <input type="hidden" name="id_peserta[]" value="<?= $peserta['id_peserta'] ?>">
                        <input type="hidden" name="hasil[]" value="<?= $total ?>">
                        <input type="hidden" name="nilai_kriteria[]" value="<?= $kriteria ?>">
                        <input type="hidden" name="tahun[]" value="<?= $tahun ?>">
                    </td>

                    <?php $no++;  endforeach; ?>
            </tr>
            <tr>
                <!-- Jika id_kriteria sudah ada di tabel matriks, maka tidak ditampilkan -->
                <?php $matriks = $this->db->get_where('tb_matriks', ['id_kriteria' => 'K004RHwS3n'])->row_array(); ?>
                <?php if(empty($matriks)): ?>
                <td colspan="22" style="text-align: center;">
                    <button type="submit" class="btn btn-primary btn-md">Simpan Nilai</button>
                </td>
                <?php else: ?>
                <td colspan="22" style="text-align: center;">
                    <p class="btn btn-success btn-md">Nilai Sudah Disimpan</p>
                </td>
                <?php endif; ?>
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
            url: "<?= site_url('admin/nilai/matriks/api_add_pbb') ?>",
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
                url: "<?php echo site_url('admin/nilai/pbb/api_empty_table/') ?>",
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