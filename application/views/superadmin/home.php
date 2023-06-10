<?php $this->load->view('template/header'); ?>

<?php
  $kode_tahun = date('Y');
 ?>

<div class="container"><?= $this->session->flashdata('pesan'); ?></div>

<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
            <h3><?= $superadmin ?></h3>
            <p>Jumlah Superadmin</p>
        </div>
        <div class="icon">
            <i class="fa fa-exchange"></i>
        </div>
        <a href="#" class="small-box-footer">Informasi antrian <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
            <h3><?= $admin ?></h3>
            <p>Jumlah admin</p>
        </div>
        <div class="icon">
            <i class="fa fa-exchange"></i>
        </div>
        <a href="#" class="small-box-footer">Informasi antrian <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
            <h3><?= $juri ?></h3>
            <p>Jumlah juri</p>
        </div>
        <div class="icon">
            <i class="fa fa-exchange"></i>
        </div>
        <a href="#" class="small-box-footer">Informasi antrian <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>



<?php $this->load->view('template/footer'); ?>