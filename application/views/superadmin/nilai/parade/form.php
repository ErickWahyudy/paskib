<?php $this->load->view('template/header'); ?>

<?php 
if($aksi == "add"):
?>

<table class="table">
    <form id="add" method="post">
        <tr>
            <th class="col-sm-1 control-label">Juri</th>
            <td class="col-sm-10">
                <select name="id_pengguna" class="form-control" required="">
                    <option value="">--Pilih Juri--</option>
                    <?php foreach($pilih_juri as $juri): ?>
                    <option value="<?= $juri['id_pengguna'] ?>">
                        <?= ucfirst($juri['nama']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
</table>

<div class="table-responsive">
    <table id="" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Asal Sekolah</th>
                <th>
                    Aksi
                    <input type="button" value="Centang Semua" id="checkAllButton" onclick="toggleCheckboxes()" class="btn btn-primary btn-xs">
                </th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; foreach($pilih_peserta as $peserta): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $peserta['nama_peserta'] ?></td>
                <td><?= $peserta['asal_sekolah'] ?></td>
                <td>
                    <input type="checkbox" name="id_peserta[]" value="<?= $peserta['id_peserta'] ?>">
                </td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>
    <input type="submit" name="kirim" value="Simpan peserta" class="btn btn-success">
    </form>
</div>

<script>
    function toggleCheckboxes() {
        var checkboxes = document.getElementsByName('id_peserta[]');
        var checkAllButton = document.getElementById('checkAllButton');
        
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = !checkboxes[i].checked;
        }
        
        if (checkAllButton.innerHTML === 'Centang Semua') {
            checkAllButton.innerHTML = 'Batal Checklist Semua';
        } else {
            checkAllButton.innerHTML = 'Centang Semua';
        }
    }
    
//add data
$(document).ready(function() {
    $('#add').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= site_url('superadmin/nilai/parade/api_add') ?>",
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

<?php 
elseif($aksi == "edit"):
?>
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
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4>
        <i class="icon fa fa-info"></i> <?= $judul ?> Tahun <?= $tahun ?>
    </h4>
</div>
<div class="table-responsive">
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th rowspan="3" style="vertical-align: middle;">No</th>
                <th rowspan="3" style="vertical-align: middle;">Nama Peserta</th>
                <th rowspan="3" style="vertical-align: middle;">Asal Sekolah</th>
                <th rowspan="3" style="vertical-align: middle;">Tinggi Badan</th>
                <th rowspan="3" style="vertical-align: middle;">Berat Badan</th>
                <th colspan="15" style="text-align: center;"><?= $judul ?></th>
                <!-- <th rowspan="3" style="vertical-align: middle;">Total Nilai <?= $nama_nilai1 ?></th>
                <th rowspan="3" style="vertical-align: middle;">Total Nilai <?= $nama_nilai2 ?></th>
                <th rowspan="3" style="vertical-align: middle;">Total Nilai <?= $nama_nilai3 ?></th>
                <th rowspan="3" style="vertical-align: middle;">Total Nilai <?= $nama_nilai4 ?></th>
                <th rowspan="3" style="vertical-align: middle;">Total Nilai <?= $nama_nilai5 ?></th> -->
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
                <td>
                    <?= $no ?>
                </td>
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
                <td>
                    <?= $nilai['nilai_kk'] ?>
                    <a href="" class="btn btn-warning btn-xs" data-toggle="modal"
                        data-target="#edit<?= $nilai['id_parade'] ?>"><i class="fa fa-edit"></i></a>
                </td>
                <?php endif; ?>
                <?php endforeach; ?>

                <!-- Total Nilai -->
                <!-- <td>
                    <?php
                    $nilai = $this->m_parade->view_nilai($peserta['id_peserta'], $tahun);
                    $total1 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        $total1 += $nilai['nilai_wjh'];
                    }
                    ?>
                    <?= $total1 ?>
                </td>
                <td>
                    <?php
                    $nilai = $this->m_parade->view_nilai($peserta['id_peserta'], $tahun);
                    $total2 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        $total2 += $nilai['nilai_bdn'];
                    }
                    ?>
                    <?= $total2 ?>
                </td>
                <td>
                    <?php
                    $nilai = $this->m_parade->view_nilai($peserta['id_peserta'], $tahun);
                    $total3 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        $total3 += $nilai['nilai_bp'];
                    }
                    ?>
                    <?= $total3 ?>
                </td>
                <td>
                    <?php
                    $nilai = $this->m_parade->view_nilai($peserta['id_peserta'], $tahun);
                    $total4 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        $total4 += $nilai['nilai_tgn'];
                    }
                    ?>
                    <?= $total4 ?>
                </td>
                <td>
                    <?php
                    $nilai = $this->m_parade->view_nilai($peserta['id_peserta'], $tahun);
                    $total5 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        $total5 += $nilai['nilai_kk'];
                    }
                    ?>
                    <?= $total5 ?>
                </td> -->
                <?php $no++;  endforeach; ?>
            </tr>
        </tbody>
    </table>
</div>

<!-- Modal edit data dokter-->
<?php foreach($view_juri as $nilai): ?>
<?php foreach($nama_peserta as $peserta): ?>
<?php $nilai = $this->m_parade->view_nilai($peserta['id_peserta'], $tahun); ?>
<?php foreach($nilai->result_array() as $nilai): ?>
<div class="modal fade" id="edit<?= $nilai['id_parade'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-purple">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit <?= $judul ?></h4>
            </div>
            <div class="modal-body table-responsive">
                <table class="table table-bordered table-striped">
                    <form id="edit" method="post">
                        <input type="hidden" name="id_parade" value="<?= $nilai['id_parade'] ?>">
                        <tr>
                            <th>Nama Juri</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="id_pengguna" value="<?= $nilai['nama'] ?>" class="form-control"
                                    readonly>

                            </td>
                        </tr>
                        <tr>
                            <th>Nama Peserta</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="id_peserta" value="<?= $nilai['nama_peserta'] ?>"
                                    class="form-control" readonly>
                            </td>
                        </tr>
                        <tr>
                            <th>Nilai <?= $nama_nilai1 ?></th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="nilai_wjh" value="<?= $nilai['nilai_wjh'] ?>"
                                    class="form-control" required autocomplete="off">
                            </td>
                        </tr>
                        <tr>
                            <th>Nilai <?= $nama_nilai2 ?></th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="nilai_bdn" value="<?= $nilai['nilai_bdn'] ?>"
                                    class="form-control" required autocomplete="off">
                            </td>
                        </tr>
                        <tr>
                            <th>Nilai <?= $nama_nilai3 ?></th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="nilai_bp" value="<?= $nilai['nilai_bp'] ?>"
                                    class="form-control" required autocomplete="off">
                            </td>
                        </tr>
                        <tr>
                            <th>Nilai <?= $nama_nilai4 ?></th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="nilai_tgn" value="<?= $nilai['nilai_tgn'] ?>"
                                    class="form-control" required autocomplete="off">
                            </td>
                        </tr>
                        <tr>
                            <th>Nilai <?= $nama_nilai5 ?></th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="nilai_kk" value="<?= $nilai['nilai_kk'] ?>"
                                    class="form-control" required autocomplete="off">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="submit" name="kirim" value="Simpan" class="btn btn-success"> &nbsp;&nbsp;
                                <a href="javascript:void(0)" onclick="hapusnilai('<?= $nilai['id_parade'] ?>')"
                                    class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                    </form>
                </table>
                <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php endforeach; ?>
<?php endforeach; ?>
<!-- End Modal -->

<script>
//edit file
$(document).on('submit', '#edit', function(e) {
    e.preventDefault();
    var form_data = new FormData(this);

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('superadmin/nilai/parade/api_edit/') ?>" + form_data.get('id_parade'),
        dataType: "json",
        data: form_data,
        processData: false,
        contentType: false,
        //memanggil swall ketika berhasil
        success: function(data) {
            $('#edit' + form_data.get('id_parade'));
            swal({
                title: "Berhasil",
                text: "Data Berhasil Diubah",
                type: "success",
                showConfirmButton: true,
                confirmButtonText: "OKEE",
            }).then(function() {
                location.reload();
            });
        },
        //memanggil swall ketika gagal
        error: function(data) {
            swal({
                title: "Gagal",
                text: "Data Gagal Diubah",
                type: "error",
                showConfirmButton: true,
                confirmButtonText: "OKEE",
            }).then(function() {
                location.reload();
            });
        }
    });
});

//ajax hapus pengeluaran
function hapusnilai(id_parade) {
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
                url: "<?php echo site_url('superadmin/nilai/parade/api_hapus/') ?>" + id_parade,
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