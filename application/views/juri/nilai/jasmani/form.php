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
                <input type="submit" name="cari" value="Buka Peserta" class="btn btn-primary">
            </td>
        </tr>
    </form>
</table>

<?php elseif($depan == FALSE): ?>
<?php 
if($aksi == "add"):
?>
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4>
        <i class="icon fa fa-info"></i> <?= $judul ?> Tahun <?= $tahun ?>
    </h4>
</div>
<table class="table table-striped">
    <form id="edit" method="post">
        <tr>
            <th class="col-md-2">Juri</th>
            <td>
                <input type="text" name="nama" value="<?= $nama_juri ?>" class="form-control" readonly>
            </td>
        </tr>
        <tr>
            <th>Nama</th>
            <td>
                <div class="dropdown">
                    <button class="dropdown-toggle form-control" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        --Pilih Peserta--
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="max-height: 200px; overflow-y: scroll;">
                        <input type="text" id="search_peserta" class="form-control" placeholder="Ketik Untuk Cari Peserta"
                            autocomplete="off">
                        <?php
                        foreach ($pilih_peserta as $peserta):
                        ?>
                            <a class="dropdown-item form-control" href="#" data-value="<?= $peserta['id_jasmani'] ?>">
                                <?= ucfirst($peserta['nama_peserta']) ?>
                            </a>
                        <?php
                        endforeach;
                        ?>
                    </div>
                </div>
                <input type="hidden" name="id_jasmani" id="selected_peserta">
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
                <a href="<?= site_url('juri/home') ?>" class="btn btn-warning">Kembali</a> &nbsp; &nbsp;
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

//edit file
$(document).on('submit', '#edit', function(e) {
    e.preventDefault();
    var form_data = new FormData(this);

    $.ajax({
        type: "POST",
        url: "<?php echo site_url('juri/nilai/jasmani/api_edit/') ?>" + form_data.get('id_jasmani'),
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
</script>

<?php else: ?>
    <h3 class="text-center">Nilai sudah disimpan permanen, anda tidak dapat mengubah nilai lagi</h3>
<?php endif; ?>
<?php endif; ?>
<?php $this->load->view('template/footer'); ?>