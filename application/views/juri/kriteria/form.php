<?php $this->load->view('template/header'); ?>

<?= $this->session->flashdata('pesan') ?>
<div class="table-responsive">
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kriteria</th>
                <th>Nilai Minimal</th>
                <th>Nilai Maksimal</th>
                <th>Bobot</th>
                <th>Nama Sub Kriteria 1</th>
                <th>Nama Sub Kriteria 2</th>
                <th>Nama Sub Kriteria 3</th>
                <th>Nama Sub Kriteria 4</th>
                <th>Nama Sub Kriteria 5</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data as $kriteria): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $kriteria['kriteria'] ?></td>
                <td><?= $kriteria['min_nilai'] ?></td>
                <td><?= $kriteria['max_nilai'] ?></td>
                <td><?= $kriteria['bobot'] ?> %</td>
                <td><?= $kriteria['nama_nilai1'] ?></td>
                <td><?= $kriteria['nama_nilai2'] ?></td>
                <td><?= $kriteria['nama_nilai3'] ?></td>
                <td><?= $kriteria['nama_nilai4'] ?></td>
                <td><?= $kriteria['nama_nilai5'] ?></td>
                <td>
                    <a href="" class="btn btn-warning" data-toggle="modal"
                        data-target="#edit<?= $kriteria['id_kriteria'] ?>"><i class="fa fa-edit"></i> Edit</a>
                </td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>


    <!-- Modal edit data kriteria-->
    <?php foreach($data as $kriteria): ?>
    <div class="modal fade" id="edit<?= $kriteria['id_kriteria'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
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
                            <tr>
                                <th>ID Kriteria</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="id_kriteria" value="<?= $kriteria['id_kriteria'] ?>"
                                        class="form-control" readonly>
                                </td>
                            </tr>
                            <tr>
                                <th>Nama Kriteria</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="kriteria" value="<?= $kriteria['kriteria'] ?>"
                                        class="form-control" autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th> Minimal nilai</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="min_nilai" value="<?= $kriteria['min_nilai'] ?>"
                                        class="form-control" autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th> Maksimal nilai</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="max_nilai" value="<?= $kriteria['max_nilai'] ?>"
                                        class="form-control" autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Bobot Nilai %
                                    <small>(Bobot nilai hanya diisi dengan angka)</small>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="bobot" value="<?= $kriteria['bobot'] ?>"
                                        class="form-control" autocomplete="off" required="" min="1" max="100">
                                </td>
                            </tr>
                            <tr>
                                <th> Nama Sub Kriteria 1</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama_nilai1" value="<?= $kriteria['nama_nilai1'] ?>"
                                        class="form-control" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <th> Nama Sub Kriteria 2</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama_nilai2" value="<?= $kriteria['nama_nilai2'] ?>"
                                        class="form-control" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <th> Nama Sub Kriteria 3</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama_nilai3" value="<?= $kriteria['nama_nilai3'] ?>"
                                        class="form-control" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <th> Nama Sub Kriteria 4</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama_nilai4" value="<?= $kriteria['nama_nilai4'] ?>"
                                        class="form-control" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <th> Nama Sub Kriteria 5</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama_nilai5" value="<?= $kriteria['nama_nilai5'] ?>"
                                        class="form-control" autocomplete="off">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                    &nbsp;&nbsp;
                                    <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                                    &nbsp;&nbsp;
                                    <a href="javascript:void(0)"
                                        onclick="hapuskriteria('<?= $kriteria['id_kriteria'] ?>')"
                                        class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>

                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <!-- End Modal -->


    <script>
    //edit file
    $(document).on('submit', '#edit', function(e) {
        e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('superadmin/kriteria/api_edit/') ?>" + form_data.get(
                'id_kriteria'),
            dataType: "json",
            data: form_data,
            processData: false,
            contentType: false,
            //memanggil swall ketika berhasil
            success: function(data) {
                $('#edit' + form_data.get('id_kriteria'));
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

    //ganti password
    $(document).on('submit', '#gantipassword', function(e) {
        e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('superadmin/kriteria/api_password/') ?>" + form_data.get(
                'id_kriteria'),
            dataType: "json",
            data: form_data,
            processData: false,
            contentType: false,
            //memanggil swall ketika berhasil
            success: function(data) {
                $('#gantipassword' + form_data.get('id_kriteria'));
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

    //ajax hapus kriteria
    function hapuskriteria(id_kriteria) {
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
                    url: "<?php echo site_url('superadmin/kriteria/api_hapus/') ?>" + id_kriteria,
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

    <?php 

function rupiah($angka){
  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;
}
?>