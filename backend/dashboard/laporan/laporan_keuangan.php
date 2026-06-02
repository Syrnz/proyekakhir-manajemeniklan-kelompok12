<?php
include('../../middleware/check_login.php');
include_once('../../../database/koneksi_db.php');

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta
        name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>LAPORAN KEUANGAN</title>
    <link rel="icon" href="../favicon.ico">
    <link href="../src/css/style.css" rel="stylesheet">
</head>

<body
    x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
        darkMode = JSON.parse(localStorage.getItem('darkMode'));
        $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark bg-gray-900': darkMode === true}">

    <!-- ===== Preloader Start ===== -->
    <div
        x-show="loaded"
        x-init="window.addEventListener('DOMContentLoaded', () => {setTimeout(() => loaded = false, 500)})"
        class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-white dark:bg-black">
        <div class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-brand-500 border-t-transparent"></div>
    </div>
    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">

        <!-- ===== Sidebar ===== -->
        <?php include('../partials/sidebar.php') ?>

        <!-- ===== Content Area ===== -->
        <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">

            <!-- Small Device Overlay -->
            <div
                @click="sidebarToggle = false"
                :class="sidebarToggle ? 'block lg:hidden' : 'hidden'"
                class="fixed w-full h-screen z-9 bg-gray-900/50"></div>

            <!-- ===== Header ===== -->
            <?php include('../partials/header.php') ?>

            <!-- ===== Main Content ===== -->
            <main>
                <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
                    <?php
                    $sqljoin = "SELECT lk.*, dp.id_detail, dp.nominal_bayar, dp.metode_pembayaran
                                FROM laporan_keuangan AS lk
                                JOIN detail_pembayaran AS dp ON lk.id_detail = dp.id_detail";
                    $stmtJoin = $conn->prepare($sqljoin);
                    $stmtJoin->execute();
                    $laporanList = $stmtJoin->fetchAll(PDO::FETCH_ASSOC);

                    $periode = '';
                    if (isset($_POST['filterDate'])) {
                        $periode = $_POST['periode'];
                        $sqlFilter = "SELECT lk.*, dp.id_detail, dp.nominal_bayar, dp.metode_pembayaran
                                                FROM laporan_keuangan AS lk
                                                JOIN detail_pembayaran AS dp ON lk.id_detail = dp.id_detail
                                                WHERE DATE_FORMAT(lk.tanggal_masuk, '%Y-%m') = :periode";
                        $stmt = $conn->prepare($sqlFilter);
                        $stmt->bindParam(':periode', $periode);
                        $stmt->execute();
                        $laporanList = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    }

                    $sql = "SELECT sum(pemasukan) AS income FROM laporan_keuangan";
                    $stmt = $conn->query($sql);
                    $dataLaporanKeuangan = $stmt->fetch(PDO::FETCH_ASSOC);
                    $SemuaOmset = $dataLaporanKeuangan['income'] ?? 0;
                    ?>

                    <!-- Kartu Total Pemasukan -->
                    <div class="mb-6">
                        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                            <span class="text-sm text-gray-500 dark:text-gray-400">Total Pemasukan</span>
                            <h4 class="mt-2 text-2xl font-bold text-gray-800 dark:text-white/90">
                                Rp. <?= number_format($SemuaOmset, 0, ',', '.'); ?>
                            </h4>
                            <p class="mt-1 text-sm text-gray-400"><?= count($laporanList) ?> transaksi terdata</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-4 md:gap-6">
                        <div class="col-span-12 space-y-6">
                            <div class="space-y-5 sm:space-y-6">
                                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                                    <!-- Header Card -->
                                    <div class="flex items-center justify-between px-5 py-4 sm:px-6 sm:py-5">
                                        <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                                            LAPORAN KEUANGAN
                                        </h3>
                                        <div class="hidden sm:block">
                                            <form method="POST" class="flex items-center gap-2">
                                                <div class="relative">
                                                    <input type="month" id="periode" name="periode"
                                                        value="<?= htmlspecialchars($periode ?? '') ?>"
                                                        class="dark:bg-dark-900 shadow-theme-xs h-11 xl:w-[300px] rounded-lg border border-gray-200 pl-12" />
                                                </div>
                                                <button type="submit" name="filterDate"
                                                    class="rounded-lg bg-brand-500 px-4 py-2 text-white">
                                                    Filter
                                                </button>
                                                <a href="laporan_keuangan.php"
                                                    class="rounded-lg bg-gray-500 px-4 py-2 text-white">
                                                    Reset
                                                </a>
                                                <?php if ($periode): ?>
                                                    <a href="../cetak/cetak_laporan.php?periode=<?= $periode ?>" target="_blank"
                                                        class="bg-warning-500 hover:bg-warning-600 rounded-lg px-5 py-3 text-sm font-medium text-white transition-colors">
                                                        Cetak Laporan
                                                    </a>
                                                <?php else: ?>
                                                    <a href="../cetak/cetak_laporan.php" target="_blank"
                                                        class="bg-warning-500 hover:bg-warning-600 rounded-lg px-5 py-3 text-sm font-medium text-white transition-colors">
                                                        Cetak Laporan
                                                    </a>
                                                <?php endif; ?>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Table -->
                                    <div class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6">
                                        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                                            <div class="max-w-full overflow-x-auto">
                                                <table class="min-w-full">
                                                    <thead>
                                                        <tr class="border-b border-gray-100 dark:border-gray-800">
                                                            <th class="px-5 py-3 sm:px-6 text-left">
                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">No</p>
                                                            </th>
                                                            <th class="px-5 py-3 sm:px-6 text-left">
                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Pemasukan</p>
                                                            </th>
                                                            <th class="px-5 py-3 sm:px-6 text-left">
                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Pembayaran Melalui</p>
                                                            </th>
                                                            <th class="px-5 py-3 sm:px-6 text-left">
                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Tanggal Masuk</p>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                                        <?php if (empty($laporanList)) : ?>
                                                            <tr>
                                                                <td colspan="7" class="px-5 pt-12 pb-12 text-center text-sm text-gray-400 dark:text-gray-500">
                                                                    Belum ada data laporan keuangan.
                                                                </td>
                                                            </tr>
                                                        <?php else : ?>
                                                            <?php foreach ($laporanList as $index => $laporan) : ?>
                                                                <tr>

                                                                    <!-- No -->
                                                                    <td class="px-5 py-4 sm:px-6">
                                                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                                            <?= $index + 1 ?>
                                                                        </p>
                                                                    </td>

                                                                    <!-- uang masuk -->
                                                                    <td class="px-5 py-4 sm:px-6">
                                                                        <p class="text-gray-800 text-theme-sm dark:text-white/90 font-mono font-medium">
                                                                            Rp <?= number_format($laporan['pemasukan'] ?? 0, 0, ',', '.') ?>
                                                                        </p>
                                                                    </td>

                                                                    <!-- pembayaraan melalui -->
                                                                    <td class="px-5 py-4 sm:px-6">
                                                                        <p class="text-gray-800 text-theme-sm dark:text-white/90 font-medium">
                                                                            <?= htmlspecialchars($laporan['metode_pembayaran'] ?? '-') ?>
                                                                        </p>
                                                                    </td>

                                                                    <!-- tanggal masuk -->
                                                                    <td class="px-5 py-4 sm:px-6">
                                                                        <p class="text-gray-800 text-theme-sm dark:text-white/90 font-medium">
                                                                            <?= htmlspecialchars($laporan['tanggal_masuk'] ?? '-') ?>
                                                                        </p>
                                                                    </td>

                                                                </tr>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!-- ===== Page Wrapper End ===== -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="../src/js/bundle.js"></script>



</body>

</html>