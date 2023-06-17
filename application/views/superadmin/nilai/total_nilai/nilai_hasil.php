<?php $this->load->view('template/header'); ?>
    <?php $nilai = $this->m_nilai_hasil->view(); ?>
        <?php if ($nilai->num_rows() == 0): ?>
        <h1 class="text-center">Belum Ada Nilai Yang Ditampilkan</h1>
        <?php else: ?>
<a href="javascript:void(0)" onclick="hapusnilai()" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus
        Semua Nilai</a> <br>
<?= $this->session->flashdata('pesan') ?>
<div class="table-responsive">
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th class="col-xs-1">Rangking</th>
                <th>Nama</th>
                <th>Tgl Lahir</th>
                <th>Usia</th>
                <th>Asal Sekolah</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data as $nilai): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $nilai['nama_peserta'] ?></td>
                <td><?= tgl_indo($nilai['tgl_lahir']) ?></td>
                <td><?= hitung_usia($nilai['tgl_lahir']) ?> Tahun</td>
                <td><?= $nilai['asal_sekolah'] ?></td>
                <td><?= $nilai['hasil'] ?></td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>

    <script>
    //ajax hapus
function hapusnilai() {
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
                url: "<?php echo site_url('superadmin/nilai/nilai_hasil/api_empty_table/') ?>",
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