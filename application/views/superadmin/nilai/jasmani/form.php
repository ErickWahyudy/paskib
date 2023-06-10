<?php $this->load->view('template/header'); ?>

<?php 
if($aksi == "add"):
?>

<table class="table table-striped">
    <form id="add" method="post">
        <tr>
            <th class="col-md-2">Juri</th>
            <td>
                <select name="id_pengguna" class="form-control" required="">
                    <option value="">--Pilih Juri--</option>
                    <?php foreach($pilih_juri as $juri): ?>
                    <option value="<?= $juri['id_pengguna'] ?>">
                        <?= ucfirst( $juri['nama']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </td>
        </tr>
        <tr>
            <th>Nama</th>
            <td>
                <div class="dropdown">
                    <button class=" dropdown-toggle form-control" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        --Pilih Peserta--
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <input type="text" id="search_peserta" class="form-control" placeholder="Cari Peserta"
                            autocomplete="off">
                        <?php foreach ($pilih_peserta as $peserta): ?>
                        <a class="dropdown-item form-control" href="#"
                            data-value="<?= $peserta['id_peserta'] ?>"><?= ucfirst($peserta['nama_peserta']) ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <input type="hidden" name="id_peserta" id="selected_peserta">
            </td>
        </tr>
        <tr>
            <th>Nilai <?= $nama_nilai1 ?></th>
            <td>
                <input type="number" name="nilai_lari" class="form-control" required="" autocomplete="off">
            </td>
        </tr>
        <tr>
            <th>Nilai <?= $nama_nilai2 ?></th>
            <td>
                <input type="number" name="nilai_pushUp" class="form-control" required="" autocomplete="off">
            </td>
        </tr>
        <tr>
            <th>Nilai <?= $nama_nilai3 ?></th>
            <td>
                <input type="number" name="nilai_sitUp" class="form-control" required="" autocomplete="off">
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <a href="<?= site_url('superadmin/home') ?>" class="btn btn-warning">Kembali</a> &nbsp; &nbsp;
                <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
        </tr>

    </form>
</table>

<script>
// Mendapatkan elemen dropdown dan input pencarian
var dropdownButton = document.getElementById('dropdownMenuButton');
var searchInput = document.getElementById('search_peserta');
var dropdownItems = document.getElementsByClassName('dropdown-item');
var selectedPeserta = document.getElementById('selected_peserta');

// Menambahkan event listener saat dropdown di klik
dropdownButton.addEventListener('click', function() {
    searchInput.value = ''; // Mengosongkan input pencarian saat dropdown di klik
    searchInput.focus(); // Fokuskan ke input pencarian
    filterDropdownOptions(''); // Menampilkan semua opsi saat dropdown di klik
});

// Menambahkan event listener untuk input pencarian
searchInput.addEventListener('input', function(event) {
    var searchValue = event.target.value.toLowerCase();
    filterDropdownOptions(searchValue);
});

// Menambahkan event listener saat opsi dropdown di klik
for (var i = 0; i < dropdownItems.length; i++) {
    var dropdownItem = dropdownItems[i];
    dropdownItem.addEventListener('click', function(event) {
        var selectedValue = event.target.getAttribute('data-value');
        var selectedText = event.target.innerText;

        dropdownButton.innerText = selectedText; // Mengganti teks dropdown dengan opsi yang dipilih
        selectedPeserta.value = selectedValue; // Menyimpan nilai opsi yang dipilih pada input tersembunyi
    });
}

// Fungsi untuk memfilter opsi dropdown berdasarkan nilai pencarian
function filterDropdownOptions(searchValue) {
    for (var i = 0; i < dropdownItems.length; i++) {
        var dropdownItem = dropdownItems[i];
        var optionText = dropdownItem.innerText.toLowerCase();

        if (optionText.indexOf(searchValue) !== -1) {
            dropdownItem.style.display = 'block'; // Tampilkan opsi
        } else {
            dropdownItem.style.display = 'none'; // Sembunyikan opsi
        }
    }
}

//add data
$(document).ready(function() {
    $('#add').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= site_url('superadmin/nilai/jasmani/api_add') ?>",
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
<div class="table-responsive">
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th rowspan="3" style="vertical-align: middle;">No</th>
                <th rowspan="3" style="vertical-align: middle;">Nama Peserta</th>
                <th rowspan="3" style="vertical-align: middle;">Asal Sekolah</th>
                <th rowspan="3" style="vertical-align: middle;">Tinggi Badan</th>
                <th rowspan="3" style="vertical-align: middle;">Berat Badan</th>
                <th colspan="9" style="text-align: center;"><?= $judul ?></th>
                <th rowspan="3" style="vertical-align: middle;">Total Nilai <?= $nama_nilai1 ?></th>
                <th rowspan="3" style="vertical-align: middle;">Total Nilai <?= $nama_nilai2 ?></th>
                <th rowspan="3" style="vertical-align: middle;">Total Nilai <?= $nama_nilai3 ?></th>
            </tr>
            <tr>
                <?php $no=1; foreach($view_juri as $juri): ?>
                <th colspan="3" style="text-align: center;">
                    Penilai <?= $no ?> /
                    <?= $juri['nama'] ?> &nbsp; &nbsp;
                </th>
                <?php $no++; endforeach; ?>
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
                <td>
                    <?= $no ?>
                </td>
                <td><?= $peserta['nama_peserta'] ?></td>
                <td><?= $peserta['asal_sekolah'] ?></td>
                <td><?= $peserta['tinggi_bb'] ?> cm </td>
                <td><?= $peserta['berat_bb'] ?> kg </td>
                <?php $nilai = $this->m_jasmani->view_nilai($peserta['id_peserta']); ?>
                <?php foreach($nilai->result_array() as $nilai): ?>
                <?php if ($nilai['id_jasmani'] == $peserta['id_peserta'] && $nilai['id_jasmani'] == NULL): ?>
                <td colspan="4" style="text-align: center;">Belum dinilai</td>
                <?php else: ?>
                <td><?= $nilai['nilai_lari'] ?></td>
                <td><?= $nilai['nilai_pushUp'] ?></td>
                <td>
                    <?= $nilai['nilai_sitUp'] ?>
                    <a href="" class="btn btn-warning btn-xs" data-toggle="modal"
                        data-target="#edit<?= $nilai['id_jasmani'] ?>"><i class="fa fa-edit"></i></a>
                </td>
                <?php endif; ?>
                <?php endforeach; ?>

                <!-- Total Nilai -->
                <td>
                    <?php
                    $nilai = $this->m_jasmani->view_nilai($peserta['id_peserta']);
                    $total1 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        $total1 += $nilai['nilai_lari'];
                    }
                    ?>
                    <?= $total1 ?>
                </td>
                <td>
                    <?php
                    $nilai = $this->m_jasmani->view_nilai($peserta['id_peserta']);
                    $total2 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        $total2 += $nilai['nilai_pushUp'];
                    }
                    ?>
                    <?= $total2 ?>
                </td>
                <td>
                    <?php
                    $nilai = $this->m_jasmani->view_nilai($peserta['id_peserta']);
                    $total3 = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        $total3 += $nilai['nilai_sitUp'];
                    }
                    ?>
                    <?= $total3 ?>
                </td>
                <?php $no++;  endforeach; ?>
            </tr>
        </tbody>
    </table>
</div>

<!-- Modal edit data dokter-->
<?php foreach($view_juri as $nilai): ?>
<?php foreach($nama_peserta as $peserta): ?>
<?php $nilai = $this->m_jasmani->view_nilai($peserta['id_peserta']); ?>
<?php foreach($nilai->result_array() as $nilai): ?>
<div class="modal fade" id="edit<?= $nilai['id_jasmani'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        <input type="hidden" name="id_jasmani" value="<?= $nilai['id_jasmani'] ?>">
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
                                <input type="number" name="nilai_lari" value="<?= $nilai['nilai_lari'] ?>"
                                    class="form-control" required autocomplete="off">
                            </td>
                        </tr>
                        <tr>
                            <th>Nilai <?= $nama_nilai2 ?></th>
                        </tr>
                        <tr>
                            <td>
                                <input type="number" name="nilai_pushUp" value="<?= $nilai['nilai_pushUp'] ?>"
                                    class="form-control" required autocomplete="off">
                            </td>
                        </tr>
                        <tr>
                            <th>Nilai <?= $nama_nilai3 ?></th>
                        </tr>
                        <tr>
                            <td>
                                <input type="number" name="nilai_sitUp" value="<?= $nilai['nilai_sitUp'] ?>"
                                    class="form-control" required autocomplete="off">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="submit" name="kirim" value="Simpan" class="btn btn-success"> &nbsp;&nbsp;
                                <a href="javascript:void(0)" onclick="hapusnilai('<?= $nilai['id_jasmani'] ?>')"
                                    class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                    </form>
                </table>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
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
        url: "<?php echo site_url('superadmin/nilai/jasmani/api_edit/') ?>" + form_data.get(
            'id_jasmani'),
        dataType: "json",
        data: form_data,
        processData: false,
        contentType: false,
        //memanggil swall ketika berhasil
        success: function(data) {
            $('#edit' + form_data.get('id_jasmani'));
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
function hapusnilai(id_jasmani) {
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
                url: "<?php echo site_url('superadmin/nilai/jasmani/api_hapus/') ?>" + id_jasmani,
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