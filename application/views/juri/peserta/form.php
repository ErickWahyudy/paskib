<?php $this->load->view('template/header'); ?>

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
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>
    <?php $this->load->view('template/footer'); ?>