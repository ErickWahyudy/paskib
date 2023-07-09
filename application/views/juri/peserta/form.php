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
                <th>No</th>
                <th>Nama</th>
                <th>Asal Sekolah</th>
                <th>Tinggi Badan</th>
                <th>Berat Badan</th>
                <th>Tahun Angkatan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data as $peserta): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $peserta['nama_peserta'] ?></td>
                <td><?= $peserta['asal_sekolah'] ?></td>
                <td><?= $peserta['tinggi_bb'] ?> cm</td>
                <td><?= $peserta['berat_bb'] ?> kg</td>
                <td><?= $peserta['tahun'] ?></td>

            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>
</div>

    <?php endif; ?>
    <?php $this->load->view('template/footer'); ?>