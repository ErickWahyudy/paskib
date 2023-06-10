<!DOCTYPE html>
<html>
<head>
    <title>Hasil Perhitungan Nilai Paskibraka</title>
</head>
<body>
    <h1>Hasil Perhitungan Nilai Paskibraka</h1>
    <table>
        <tr>
            <th>Alternatif</th>
            <th>Nilai</th>
        </tr>
        <?php foreach ($result as $alternative) : ?>
            <tr>
                <td><?php echo $alternative['nama']; ?></td>
                <td><?php echo $alternative['nilai']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
