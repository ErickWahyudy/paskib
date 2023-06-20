<?php $this->load->view('peserta/header'); ?>
    <?php $nilai = $this->m_nilai_hasil->view(); ?>
        <?php if ($nilai->num_rows() == 0): ?>
        <h1 class="text-center">Belum Ada Nilai Yang Ditampilkan</h1>
        <?php else: ?>
<?= $this->session->flashdata('pesan') ?>
<div class="table-responsive">
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th class="col-xs-1">Rangking</th>
                <th>Nama</th>
                <th>Usia</th>
                <th>Asal Sekolah</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data as $nilai): ?>
            <tr>
                <!-- memberi background color pada user yang login -->
                <?php if ($this->session->userdata('id_peserta') == $nilai['id_peserta']): ?>
                    <td class="bg-primary"><?= $no ?></td>
                    <td class="bg-primary"><?= $nilai['nama_peserta'] ?></td>
                    <td class="bg-primary"><?= hitung_usia($nilai['tgl_lahir']) ?> Tahun</td>
                    <td class="bg-primary"><?= $nilai['asal_sekolah'] ?></td>
                <?php else: ?>
                <td><?= $no ?></td>
                <td><?= $nilai['nama_peserta'] ?></td>
                <td><?= hitung_usia($nilai['tgl_lahir']) ?> Tahun</td>
                <td><?= $nilai['asal_sekolah'] ?></td>
                <?php endif; ?>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
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