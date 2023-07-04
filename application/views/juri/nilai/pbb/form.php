<?php $this->load->view('template/header'); ?>

<?php 
if($aksi == "add"):
$tahun = date('Y');
$nilai = $this->m_matriks->view_nilaihasil($tahun); 
 if ($nilai->num_rows() == 0): 
 ?>

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
                    <button class=" dropdown-toggle form-control" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        --Pilih Peserta--
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <input type="text" id="search_peserta" class="form-control" placeholder="Cari Peserta"
                            autocomplete="off">
                        <?php foreach ($pilih_peserta as $peserta): ?>
                        <a class="dropdown-item form-control" href="#"
                            data-value="<?= $peserta['id_pbb'] ?>"><?= ucfirst($peserta['nama_peserta']) ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <input type="hidden" name="id_pbb" id="selected_peserta">
            </td>
        </tr>
        <tr>
            <th>Nilai <?= $nama_nilai1 ?></th>
            <td>
                <input type="number" name="nilai_sk" class="form-control" required="" autocomplete="off">
            </td>
        </tr>
        <tr>
            <th>Nilai <?= $nama_nilai2 ?></th>
            <td>
                <input type="number" name="nilai_gb" class="form-control" required="" autocomplete="off">
            </td>
        </tr>
        <tr>
            <th>Nilai <?= $nama_nilai3 ?></th>
            <td>
                <input type="number" name="nilai_gd" class="form-control" required="" autocomplete="off">
            </td>
        </tr>
        <tr>
            <th>Nilai <?= $nama_nilai4 ?></th>
            <td>
                <input type="number" name="nilai_ab" class="form-control" required="" autocomplete="off">
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
        url: "<?php echo site_url('juri/nilai/pbb/api_edit/') ?>" + form_data.get('id_pbb'),
        dataType: "json",
        data: form_data,
        processData: false,
        contentType: false,
        //memanggil swall ketika berhasil
        success: function(data) {
            $('#edit' + form_data.get('id_pbb'));
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