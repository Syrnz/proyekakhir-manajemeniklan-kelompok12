<?php
include('../../middleware/check_login.php');
include_once('../../../database/koneksi_db.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Keuangan</title>
    <script src="https://cloudflare.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <?php
    if (isset($_GET['periode'])) {
        $periode = $_GET['periode'];
        $bulan = date('F Y', strtotime($periode . '-01'));
        $sqlLaporan = $conn->prepare("SELECT *
                                    FROM laporan_keuangan
                                    WHERE DATE_FORMAT(tanggal_masuk, '%Y-%m') = :periode
                                    ORDER BY tanggal_masuk DESC
                                ");
        $sqlLaporan->bindParam(':periode', $periode);
        $sqlLaporan->execute();
    } else {
        $bulan = 'Semua Periode';
        $sqlLaporan = $conn->prepare("SELECT *
                                    FROM laporan_keuangan
                                    ORDER BY tanggal_masuk DESC
                                ");
        $sqlLaporan->execute();
    }
    $laporanKeuangan = $sqlLaporan->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="">
        <div class="container mx-auto py-8">
            <h2 class="text-xl font-bold mb-4 text-center">LAPORAN KEUANGAN</h2>
            <h4>PT. Iklankan</h4>
            <p>Periode: <?= $bulan ?></p>
        </div>
        <hr>
        <div class="container mx-auto">
            <?php
            $totalMasuk = 0;
            ?>

            <table class="w-full border-collapse border border-gray-400">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-3 py-2">No</th>
                        <th class="border px-3 py-2">Tanggal Masuk</th>
                        <th class="border px-3 py-2 text-right">Debit (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($laporanKeuangan as $laporan) : ?>
                        <?php
                        $totalMasuk += $laporan['pemasukan'];
                        ?>
                        <tr>
                            <td class="border px-3 py-2 text-center">
                                <?= $no++ ?>
                            </td>
                            <td class="border px-3 py-2">
                                <?= date('d-m-Y', strtotime($laporan['tanggal_masuk'])) ?>
                            </td>
                            <td class="border px-3 py-2 text-right">
                                Rp <?= number_format($laporan['pemasukan'], 0, ',', '.') ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr class="font-bold bg-gray-100">
                        <td colspan="5" class="border px-3 py-2 text-right">
                            Total Pemasukan
                        </td>
                        <td class="border px-3 py-2 text-right">
                            Rp <?= number_format($totalMasuk, 0, ',', '.') ?>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>

</html>