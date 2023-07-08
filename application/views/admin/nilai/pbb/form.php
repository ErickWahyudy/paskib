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

<table class="table">
    <form id="add" method="post">
        <tr>
            <th class="col-sm-1 control-label">Juri</th>
            <td class="col-sm-10">
                <select name="id_pengguna" class="form-control" required="">
                    <option value="">--Pilih Juri--</option>
                    <?php foreach($pilih_juri as $juri): ?>
                        <!-- Jika id_pengguna sudah ada di tabel pbb, maka tidak ditampilkan -->
                        <?php $juri_pbb = $this->db->get_where('tb_pbb', ['id_pengguna' => $juri['id_pengguna'], 'tahun' => $tahun])->row_array(); ?>
                        <?php if(!empty($juri_pbb)) continue; ?>
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
                <th>Tahun Angkatan</th>
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
                    <input type="number" name="tahun" value="<?= $peserta['tahun'] ?>" readonly style="border: none; background-color: transparent;">
                </td>
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
            url: "<?= site_url('admin/nilai/pbb/api_add') ?>",
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
<?php else: ?>
    <h3 class="text-center">Nilai sudah disimpan permanen, anda tidak dapat menambahkan peserta lagi</h3>
<?php endif; ?>

<?php endif; ?>
<?php $this->load->view('template/footer'); ?>