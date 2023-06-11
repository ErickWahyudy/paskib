<?php $this->load->view('template/header'); ?>

<div class="table-responsive">
    <a href="javascript:void(0)" onclick="hapusnilai()" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus
        Semua Nilai</a> <br>
        <?php $nilai = $this->m_nilai_hasil->view_nilaihasil(); ?>
        <?php if ($nilai->num_rows() == 0): ?>
        <h1 class="text-center">Belum Ada Nilai Yang Diinputkan</h1>
        <?php else: ?>
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th rowspan="2" style="vertical-align: middle;">No</th>
                <th rowspan="2" style="vertical-align: middle;">Nama Peserta</th>
                <th rowspan="2" style="vertical-align: middle;">Asal Sekolah</th>
                <th colspan="5" style="text-align: center;"><?= $judul ?></th>
                <th rowspan="2" style="vertical-align: middle;">Total Nilai </th>
            </tr>
            <tr>
                <?php foreach($view_kriteria as $kriteria): ?>
                <th colspan="1" style="text-align: center;">
                    <?= $kriteria['kriteria'] ?>
                </th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php 
                    $no=1; 
                    $peserta_sorted = array(); // Array untuk menyimpan peserta dan nilai total
                    foreach($nama_peserta as $peserta): 
                        $nilai = $this->m_nilai_hasil->view_nilai($peserta['id_peserta']);
                        $total = 0;

                        foreach ($nilai->result_array() as $nilai) {
                            $total += ($nilai['hasil']);
                        }

                        $peserta_sorted[] = array(
                            'id_peserta' => $peserta['id_peserta'],
                            'nama_peserta' => $peserta['nama_peserta'],
                            'asal_sekolah' => $peserta['asal_sekolah'],
                            'tinggi_bb' => $peserta['tinggi_bb'],
                            'berat_bb' => $peserta['berat_bb'],
                            'hasil' => $total
                        );
                        // Urutkan peserta berdasarkan total_nilai secara menurun
                        usort($peserta_sorted, function($a, $b) {
                            return $b['hasil'] <=> $a['hasil'];
                        });
                    ?>
            <?php endforeach; ?>
            <tr>
                <?php foreach ($peserta_sorted as $peserta): ?>
                <td><?= $no ?></td>
                <td><?= $peserta['nama_peserta'] ?></td>
                <td><?= $peserta['asal_sekolah'] ?></td>
                <td><?= $peserta['tinggi_bb'] ?> cm </td>
                <td><?= $peserta['berat_bb'] ?> kg </td>
                <?php $nilai = $this->m_nilai_hasil->view_nilai($peserta['id_peserta']); ?>
                <?php foreach($nilai->result_array() as $nilai): ?>
                <td>
                    <?= $nilai['hasil'] ?>
                </td>
                <?php endforeach; ?>

                <td>
                    
                    <?php
                    $nilai = $this->m_nilai_hasil->view_nilai($peserta['id_peserta']);
                    $total = 0;
                    foreach ($nilai->result_array() as $nilai) {
                        $total += ($nilai['hasil']);
                    }
                    ?>
                    <?= $total ?>
                </td>

            </tr>

            <?php $no++;  endforeach; ?>
            </tr>
        </tbody>
    </table>
</div>
</div>
</div>


<!-- general form elements -->
<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Hasil Normalisasi dan Perangkingan <?= $judul ?></h3>
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th rowspan="2" style="vertical-align: middle;">Ranking</th>
                        <th rowspan="2" style="vertical-align: middle;">Nama Peserta</th>
                        <th rowspan="2" style="vertical-align: middle;">Asal Sekolah</th>
                        <th colspan="5" style="text-align: center;"><?= $judul ?></th>
                        <th rowspan="2" style="vertical-align: middle;">Total Nilai</th>
                    </tr>
                    <tr>
                        <?php foreach($criteria as $kriteria): ?>
                        <th colspan="1" style="text-align: center;">
                            <?= $kriteria ?>
                        </th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    // Mengurutkan array berdasarkan nilai $results secara descending
                    arsort($results);

                    
                    foreach ($results as $key => $value): 
                        $peserta = $nama_peserta[$key];
                ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $peserta['nama_peserta'] ?></td>
                        <td><?= $peserta['asal_sekolah'] ?></td>
                        <?php foreach ($matrix[$key] as $nilai_kriteria): ?>
                        <td><?= $nilai_kriteria ?></td>
                        <?php endforeach; ?>
                        <td><?= $value ?></td>
                    </tr>
                    <?php 
                    $no++; 
                    endforeach; 
                ?>
                </tbody>
            </table>
            <div>
                <h5>Nilai kriteria:</h5>
                <ul>
                    <li>1 = Cukup</li>
                    <li>2 = Baik</li>
                    <li>3 = Sangat Baik</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>




<script>
//ajax hapus pengeluaran
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
                url: "<?php echo site_url('superadmin/nilai/total_nilai/api_empty_table/') ?>",
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
<?php $this->load->view('template/footer'); ?>