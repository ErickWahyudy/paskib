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
                <?php $no=1;  foreach ($nama_peserta as $peserta): ?>
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
                <!-- total nilai -->
                <?php $total_nilai = $this->m_matriks->view_nilai($peserta['id_peserta'], $tahun); ?>
                <?php
                    $total = 0;
                    foreach($total_nilai->result_array() as $total_nilai):
                        $total += $total_nilai['hasil'];
                    endforeach;
                ?>
                <td>
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
        <h3 class="box-title">Hasil Normalisasi & Optimasi</h3>
        <div class="table-responsive">
            <table id="" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th rowspan="2" style="vertical-align: middle;">No</th>
                        <th rowspan="2" style="vertical-align: middle;">Nama Peserta</th>
                        <th rowspan="2" style="vertical-align: middle;">Asal Sekolah</th>
                        <th colspan="5" style="text-align: center;">Hasil Normalisasi</th>
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
                    <form id="add" method="post">
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
                                <input type="hidden" name="id_peserta[]" value="<?= $peserta['id_peserta'] ?>">
                                <input type="hidden" name="hasil[]" value="<?= $normalisasi ?>">
                                <input type="hidden" name="tahun[]" value="<?= $tahun ?>">
                            </td>
                        </tr>
                    <?php 
                        $no++; 
                        endforeach; 
                    ?>
                    <tr>
                    <td colspan="9" style="text-align: center;">
                        <?php $nilai = $this->m_nilai_hasil->view($tahun); ?>
                            <?php if ($nilai->num_rows() == 0): ?>
                                <button type="submit" class="btn btn-primary btn-md">Simpan Nilai</button>
                            <?php else: ?>
                                <span class="btn btn-success btn-md">Hasil Nilai Sudah Disimpan Permanen</span>
                            <?php endif; ?>
                    </td>
                </tr>
                </form>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

<script>
//add data
$(document).ready(function() {
    $('#add').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= site_url('admin/nilai/nilai_hasil/api_add') ?>",
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
                    window.location.href = "<?= site_url('admin/nilai/nilai_hasil') ?>";
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
                url: "<?php echo site_url('admin/nilai/matriks/api_empty_table/') ?>",
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