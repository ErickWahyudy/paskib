<!DOCTYPE html>
<html>
<head>
    <title>Hasil Perhitungan Nilai Paskibraka</title>
</head>
<body>
    <h1>Hasil Perhitungan Nilai Paskibraka</h1>
    <table>
        <tr>
            <th>No</th>
            <th>Nama Peserta</th>
            <th>Asal Sekolah</th>
            <?php foreach ($criteria as $c): ?>
                <th><?php echo $c; ?></th>
            <?php endforeach; ?>
            <th>Hasil Normalisasi</th>
        </tr>
        <?php for ($i = 0; $i < count($peserta); $i++): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= $peserta[$i]['nama_peserta'] ?></td>
                <td><?= $peserta[$i]['asal_sekolah'] ?></td>
                <?php foreach ($matrix[$i] as $nilai_kriteria): ?>
                    <td><?= $nilai_kriteria ?></td>
                <?php endforeach; ?>
                <td><?= $results[$i] ?></td>
            </tr>
        <?php endfor; ?>
    </table>
</body>
</html>
