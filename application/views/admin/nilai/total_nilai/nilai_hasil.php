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
<?php $nilai = $this->m_nilai_hasil->view($tahun); ?>
<?php if ($nilai->num_rows() == 0): ?>
<h1 class="text-center">Belum Ada Nilai Yang Ditampilkan</h1>
<?php else: ?>
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4>
        <i class="icon fa fa-info"></i> <?= $judul ?> Tahun <?= $tahun ?>
    </h4>
</div>
<?= $this->session->flashdata('pesan') ?>
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
                <?php $nilai = $this->m_matriks->view_nilai($peserta['id_peserta'], $tahun); ?>
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
                            url: "<?php echo site_url('admin/nilai/nilai_hasil/api_empty_table/') ?>",
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
            <?php endif; ?>
            <?php $this->load->view('template/footer'); ?>