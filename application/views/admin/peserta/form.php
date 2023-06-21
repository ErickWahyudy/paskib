<?php $this->load->view('template/header'); ?>

<a href="" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahPeserta"><i class="fa fa-plus"></i>
    Tambah</a>
<br /><br /><br />
<?= $this->session->flashdata('pesan') ?>
<div class="table-responsive">
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tgl Lahir</th>
                <th>Usia</th>
                <th>Asal Sekolah</th>
                <th>Tinggi Badan</th>
                <th>Berat Badan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data as $peserta): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $peserta['nama_peserta'] ?></td>
                <td><?= tgl_indo($peserta['tgl_lahir']) ?></td>
                <td><?= hitung_usia($peserta['tgl_lahir']) ?> Tahun</td>
                <td><?= $peserta['asal_sekolah'] ?></td>
                <td><?= $peserta['tinggi_bb'] ?> cm</td>
                <td><?= $peserta['berat_bb'] ?> kg</td>

                <td>
                    <a href="" class="btn btn-warning" data-toggle="modal"
                        data-target="#edit<?= $peserta['id_peserta'] ?>"><i class="fa fa-edit"></i></a> &nbsp;
                </td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>

    <!-- Modal tambah data peserta-->
    <div class="modal fade" id="modalTambahPeserta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-purple">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Tambah <?= $judul ?></h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <form id="add" method="post">
                            <tr>
                                <th>Nama</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama_peserta" class="form-control" placeholder="nama"
                                        autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Tgl Lahir</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="tgl_lahir" id="tanggal-lahir" class="form-control"
                                        value="<?= date('Y-m-d') ?>" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Usia</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" id="umur" class="form-control" placeholder="umur"
                                        autocomplete="off" required="" readonly>
                                </td>
                            </tr>
                            <tr>
                                <th>Asal Sekolah</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="asal_sekolah" class="form-control"
                                        placeholder="asal sekolah" autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Tinggi Badan
                                    <small>(cm)</small>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="tinggi_bb" class="form-control"
                                        placeholder="tinggi badan" autocomplete="off" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Berat Badan
                                    <small>(kg)</small>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="berat_bb" class="form-control" placeholder="berat badan"
                                        autocomplete="off" required="">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                    &nbsp;&nbsp;
                                    <input type="submit" name="kirim" value="Submit" class="btn btn-success">
                                </td>
                            </tr>

                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <script>
    //mengambil data umur dari hasil inputan tgl lahir
    const tanggalLahirInput = document.getElementById("tanggal-lahir");
    const umurInput = document.getElementById("umur");

    tanggalLahirInput.addEventListener("change", function() {
        const tanggalLahir = new Date(this.value);
        const sekarang = new Date();
        const selisihTahun = sekarang.getFullYear() - tanggalLahir.getFullYear();

        umurInput.value = selisihTahun;
    });
    </script>

    <!-- Modal edit data peserta-->
    <?php foreach($data as $peserta): ?>
    <div class="modal fade" id="edit<?= $peserta['id_peserta'] ?>" tabindex="-1" role="dialog"
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
                                <th>ID peserta</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="id_peserta" value="<?= $peserta['id_peserta'] ?>"
                                        class="form-control" readonly>
                                </td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama_peserta" value="<?= $peserta['nama_peserta'] ?>"
                                        class="form-control" required="" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <th>Tgl Lahir</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="tgl_lahir" value="<?= $peserta['tgl_lahir'] ?>"
                                        class="form-control" required="" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <th>Asal Sekolah</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="asal_sekolah" value="<?= $peserta['asal_sekolah'] ?>"
                                        class="form-control" required="" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <th>Tinggi Badan
                                    <small>cm</small>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="tinggi_bb" value="<?= $peserta['tinggi_bb'] ?>"
                                        class="form-control" required="" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <th>Berat Badan
                                    <small>kg</small>
                                </th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="berat_bb" value="<?= $peserta['berat_bb'] ?>"
                                        class="form-control" required="" autocomplete="off">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                    &nbsp;&nbsp;
                                    <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                                    &nbsp;&nbsp;
                                    <a href="javascript:void(0)" onclick="hapuspeserta('<?= $peserta['id_peserta'] ?>')"
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
    //add data
    $(document).ready(function() {
        $('#add').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('admin/peserta/api_add') ?>",
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(data) {
                    $('#modalTambahPeserta');
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

    //edit data
    $(document).on('submit', '#edit', function(e) {
        e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/peserta/api_edit/') ?>" + form_data.get('id_peserta'),
            dataType: "json",
            data: form_data,
            processData: false,
            contentType: false,
            //memanggil swall ketika berhasil
            success: function(data) {
                $('#edit' + form_data.get('id_peserta'));
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


    //ajax hapus peserta
    function hapuspeserta(id_peserta) {
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
                    url: "<?php echo site_url('admin/peserta/api_hapus/') ?>" + id_peserta,
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

function hitung_usia($tanggal_lahir){
    list($year,$month,$day) = explode("-",$tanggal_lahir);
    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($month_diff < 0) {
        $year_diff--;
    } elseif (($month_diff==0) && ($day_diff < 0)) {
        $year_diff--;
    }
    return $year_diff;
}

//format hanya menampilkan tanggal bulan dan tahun
function tgl_indo($tanggal){
    $tgl = substr($tanggal, 8, 2);
      $bln = array (
          1 =>   'Januari',
          2 =>   'Februari',
          3 =>   'Maret',
          4 =>   'April',
          5 =>   'Mei',
          6 =>   'Juni',
          7 =>   'Juli',
          8 =>   'Agustus',
          9 =>   'September',
          10 =>   'Oktober',
          11 =>   'November',
          12 =>   'Desember'
      );
      $bulan = $bln[(int)substr($tanggal, 5, 2)];
      $tahun = substr($tanggal, 0, 4);
      return $tgl.' '.$bulan.' '.$tahun;
  }
  
?>