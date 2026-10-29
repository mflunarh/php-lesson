<?php
// 1. Array multidimensi mata kuliah
$matkul = [
    ["nama" => "Pemrograman Web", "sks" => 3, "nilai" => 88],
    ["nama" => "Basis Data",      "sks" => 3, "nilai" => 76],
    ["nama" => "Algoritma",       "sks" => 4, "nilai" => 62],
    ["nama" => "Jaringan Komputer", "sks" => 3, "nilai" => 45],
    ["nama" => "Statistika",      "sks" => 2, "nilai" => 55],
];

require_once __DIR__ . '/src/functions.php';

$totalSks = 0;
$totalMutu = 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Latihan Individu - Nilai Mata Kuliah</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { border-collapse: collapse; width: 100%; max-width: 800px; }
        th, td { border: 1px solid #333; padding: 8px 12px; text-align: center; }
        th { background: #eee; }
        td.kiri { text-align: left; }
    </style>
</head>
<body>
    <h2>Daftar Nilai Mata Kuliah</h2>
    <table>
        <tr>
            <th>No</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Nilai Angka</th>
            <th>Nilai Huruf</th>
            <th>Status</th>
        </tr>
        <?php foreach ($matkul as $i => $mk):
            // 3. Hitung huruf, bobot, dan status
            $hasil = hitungBobot($mk["nilai"]);
            $status = ($hasil["bobot"] >= 2.0) ? "LULUS" : "MENGULANG";

            $totalSks += $mk["sks"];
            $totalMutu += $hasil["bobot"] * $mk["sks"];

            // 4. Warna merah untuk baris MENGULANG
            $style = ($status === "MENGULANG") ? "background:#ffcccc; color:red;" : "";
        ?>
        <tr style="<?= $style ?>">
            <td><?= $i + 1 ?></td>
            <td class="kiri"><?= $mk["nama"] ?></td>
            <td><?= $mk["sks"] ?></td>
            <td><?= $mk["nilai"] ?></td>
            <td><?= $hasil["huruf"] ?></td>
            <td><?= $status ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php
    // 5. Hitung IPS
    $ips = $totalSks > 0 ? $totalMutu / $totalSks : 0;

    // 6. Batas maksimal SKS semester depan
    $maksSks = ($ips >= 3.00) ? 24 : 20;
    ?>

    <h3>Ringkasan IPS</h3>
    <p>Total SKS: <strong><?= $totalSks ?></strong></p>
    <p>Total Mutu (bobot x SKS): <strong><?= $totalMutu ?></strong></p>
    <p>IPS: <strong><?= number_format($ips, 2) ?></strong></p>
    <p>Batas maksimal SKS semester depan: <strong><?= $maksSks ?> SKS</strong></p>
</body>
</html>