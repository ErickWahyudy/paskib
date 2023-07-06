<?php $this->load->view('template/header'); ?>

<?php if($this->session->userdata('level') == "1"){ ?>
<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-primary">
        <div class="inner">
            <h4>Lihat Nilai Jasmani</h4><br>
        </div>
        <a href="<?= base_url('superadmin/nilai/jasmani/lihat') ?>">
        <div class="icon">
            <i class="fa fa-odnoklassniki"></i>
        </div>
        </a>
        <a href="<?= base_url('superadmin/nilai/jasmani/lihat') ?>" class="small-box-footer">Lihat Nilai <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-primary">
        <div class="inner">
            <h4>Lihat Nilai PBB</h4><br>
        </div>
        <a href="<?= base_url('superadmin/nilai/pbb/lihat') ?>">
        <div class="icon">
            <i class="fa fa-child"></i>
        </div>
        </a>
        <a href="<?= base_url('superadmin/nilai/pbb/lihat') ?>" class="small-box-footer">Lihat Nilai <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-primary">
        <div class="inner">
            <h4>Lihat Nilai Parade</h4><br>
        </div>
        <a href="<?= base_url('superadmin/nilai/parade/lihat') ?>">
        <div class="icon">
            <i class="fa fa-gg"></i>
        </div>
        </a>
        <a href="<?= base_url('superadmin/nilai/parade/lihat') ?>" class="small-box-footer">Lihat Nilai <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>


<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h4>Matriks</h4><br>
        </div>
        <a href="<?= base_url('superadmin/nilai/matriks/kriteria') ?>">
        <div class="icon">
            <i class="fa fa-object-ungroup"></i>
        </div>
        </a>
        <a href="<?= base_url('superadmin/nilai/matriks/kriteria') ?>" class="small-box-footer">Lihat Nilai <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h4>Normalisasi & Optimasi</h4><br>
        </div>
        <a href="<?= base_url('superadmin/nilai/matriks/matriks') ?>">
        <div class="icon">
            <i class="fa fa-calculator"></i>
        </div>
        </a>
        <a href="<?= base_url('superadmin/nilai/matriks/matriks') ?>" class="small-box-footer">Lihat Nilai <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h4>Hasil Perhitungan</h4><br>
        </div>
        <a href="<?= base_url('superadmin/nilai/nilai_hasil') ?>">
        <div class="icon">
            <i class="fa fa-bar-chart"></i>
        </div>
        </a>
        <a href="<?= base_url('superadmin/nilai/nilai_hasil') ?>" class="small-box-footer">Lihat Nilai <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
            <h4>Edit Nilai Jasmani</h4><br>
        </div>
        <a href="<?= base_url('superadmin/nilai/jasmani/edit') ?>">
        <div class="icon">
            <i class="fa fa-odnoklassniki"></i>
        </div>
        </a>
        <a href="<?= base_url('superadmin/nilai/jasmani/edit') ?>" class="small-box-footer">Edit Nilai <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
            <h4>Edit Nilai PBB</h4><br>
        </div>
        <a href="<?= base_url('superadmin/nilai/pbb/edit') ?>">
        <div class="icon">
            <i class="fa fa-child"></i>
        </div>
        </a>
        <a href="<?= base_url('superadmin/nilai/pbb/edit') ?>" class="small-box-footer">Edit Nilai <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
            <h4>Edit Nilai Parade</h4><br>
        </div>
        <a href="<?= base_url('superadmin/nilai/parade/edit') ?>">
        <div class="icon">
            <i class="fa fa-gg"></i>
        </div>
        </a>
        <a href="<?= base_url('superadmin/nilai/parade/edit') ?>" class="small-box-footer">Edit Nilai <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<?php }elseif($this->session->userdata('level') == "2"){ ?>
    <div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-primary">
        <div class="inner">
            <h4>Lihat Nilai Jasmani</h4><br>
        </div>
        <a href="<?= base_url('admin/nilai/jasmani/lihat') ?>">
        <div class="icon">
            <i class="fa fa-odnoklassniki"></i>
        </div>
        </a>
        <a href="<?= base_url('admin/nilai/jasmani/lihat') ?>" class="small-box-footer">Lihat Nilai <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-primary">
        <div class="inner">
            <h4>Lihat Nilai PBB</h4><br>
        </div>
        <a href="<?= base_url('admin/nilai/pbb/lihat') ?>">
        <div class="icon">
            <i class="fa fa-child"></i>
        </div>
        </a>
        <a href="<?= base_url('admin/nilai/pbb/lihat') ?>" class="small-box-footer">Lihat Nilai <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-primary">
        <div class="inner">
            <h4>Lihat Nilai Parade</h4><br>
        </div>
        <a href="<?= base_url('admin/nilai/parade/lihat') ?>">
        <div class="icon">
            <i class="fa fa-gg"></i>
        </div>
        </a>
        <a href="<?= base_url('admin/nilai/parade/lihat') ?>" class="small-box-footer">Lihat Nilai <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>


<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h4>Matriks</h4><br>
        </div>
        <a href="<?= base_url('admin/nilai/matriks/kriteria') ?>">
        <div class="icon">
            <i class="fa fa-object-ungroup"></i>
        </div>
        </a>
        <a href="<?= base_url('admin/nilai/matriks/kriteria') ?>" class="small-box-footer">Lihat Nilai <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h4>Normalisasi & Optimasi</h4><br>
        </div>
        <a href="<?= base_url('admin/nilai/matriks/matriks') ?>">
        <div class="icon">
            <i class="fa fa-calculator"></i>
        </div>
        </a>
        <a href="<?= base_url('admin/nilai/matriks/matriks') ?>" class="small-box-footer">Lihat Nilai <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h4>Hasil Perhitungan</h4><br>
        </div>
        <a href="<?= base_url('admin/nilai/nilai_hasil') ?>">
        <div class="icon">
            <i class="fa fa-bar-chart"></i>
        </div>
        </a>
        <a href="<?= base_url('admin/nilai/nilai_hasil') ?>" class="small-box-footer">Lihat Nilai <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
            <h4>Penilaian Jasmani</h4><br>
        </div>
        <a href="<?= base_url('admin/nilai/jasmani/input') ?>">
        <div class="icon">
            <i class="fa fa-odnoklassniki"></i>
        </div>
        </a>
        <a href="<?= base_url('admin/nilai/jasmani/input') ?>" class="small-box-footer">Buka Penilaian <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
            <h4>Penilaian PBB</h4><br>
        </div>
        <a href="<?= base_url('admin/nilai/pbb/input') ?>">
        <div class="icon">
            <i class="fa fa-child"></i>
        </div>
        </a>
        <a href="<?= base_url('admin/nilai/pbb/input') ?>" class="small-box-footer">Buka Penilaian <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
            <h4>Penilaian Parade</h4><br>
        </div>
        <a href="<?= base_url('admin/nilai/parade/input') ?>">
        <div class="icon">
            <i class="fa fa-gg"></i>
        </div>
        </a>
        <a href="<?= base_url('admin/nilai/parade/input') ?>" class="small-box-footer">Buka Penilaian <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<?php }elseif($this->session->userdata('level') == "3"){ ?>

    <div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-primary">
        <div class="inner">
            <h4>Lihat Nilai Jasmani</h4><br>
        </div>
        <a href="<?= base_url('juri/nilai/jasmani/lihat') ?>">
        <div class="icon">
            <i class="fa fa-odnoklassniki"></i>
        </div>
        </a>
        <a href="<?= base_url('juri/nilai/jasmani/lihat') ?>" class="small-box-footer">Lihat Nilai <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-primary">
        <div class="inner">
            <h4>Lihat Nilai PBB</h4><br>
        </div>
        <a href="<?= base_url('juri/nilai/pbb/lihat') ?>">
        <div class="icon">
            <i class="fa fa-child"></i>
        </div>
        </a>
        <a href="<?= base_url('juri/nilai/pbb/lihat') ?>" class="small-box-footer">Lihat Nilai <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-primary">
        <div class="inner">
            <h4>Lihat Nilai Parade</h4><br>
        </div>
        <a href="<?= base_url('juri/nilai/parade/lihat') ?>">
        <div class="icon">
            <i class="fa fa-gg"></i>
        </div>
        </a>
        <a href="<?= base_url('juri/nilai/parade/lihat') ?>" class="small-box-footer">Lihat Nilai <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
            <h4>Input Nilai Jasmani</h4><br>
        </div>
        <a href="<?= base_url('juri/nilai/jasmani/input') ?>">
        <div class="icon">
            <i class="fa fa-odnoklassniki"></i>
        </div>
        </a>
        <a href="<?= base_url('juri/nilai/jasmani/input') ?>" class="small-box-footer">input Nilai <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
            <h4>Input Nilai PBB</h4><br>
        </div>
        <a href="<?= base_url('juri/nilai/pbb/input') ?>">
        <div class="icon">
            <i class="fa fa-child"></i>
        </div>
        </a>
        <a href="<?= base_url('juri/nilai/pbb/input') ?>" class="small-box-footer">input Nilai <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-yellow">
        <div class="inner">
            <h4>Input Nilai Parade</h4><br>
        </div>
        <a href="<?= base_url('juri/nilai/parade/input') ?>">
        <div class="icon">
            <i class="fa fa-gg"></i>
        </div>
        </a>
        <a href="<?= base_url('juri/nilai/parade/input') ?>" class="small-box-footer">input Nilai <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <h4>Hasil Penilaian</h4><br>
        </div>
        <a href="<?= base_url('juri/nilai/nilai_hasil') ?>">
        <div class="icon">
            <i class="fa fa-bar-chart"></i>
        </div>
        </a>
        <a href="<?= base_url('juri/nilai/nilai_hasil') ?>" class="small-box-footer">Lihat Nilai <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<?php } ?>

<?php $this->load->view('template/footer'); ?>