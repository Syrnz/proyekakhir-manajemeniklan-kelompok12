<?php
include('../../middleware/check_login.php');
include_once('../../../database/koneksi_db.php');

// Query laporan keuangan: semua pembayaran yang sudah lunas
$sql = "SELECT 
            pb.id_pembayaran,
            pb.kode_invoice,
            pb.total_tagihan,
            pb.status_pembayaran,
            pb.created_at AS tanggal_invoice,
            pl.nama_pelanggan,
            pl.kode_pelanggan,
            l.nama_lokasi,
            l.alamat,
            i.judul_iklan,
            i.durasi_hari,
            i.tanggal_mulai,
            i.tanggal_selesai,
            dp.metode_pembayaran,
            dp.nominal_bayar,
            dp.tanggal_dibuat_tagihan
        FROM pembayaran AS pb
        JOIN iklan AS i         ON pb.id_iklan     = i.id_iklan
        JOIN pelanggan AS pl    ON i.id_pelanggan  = pl.id_pelanggan
        JOIN lokasi_iklan AS l  ON i.id_lokasi     = l.id_lokasi
        LEFT JOIN detail_pembayaran AS dp ON pb.id_pembayaran = dp.id_pembayaran
        WHERE pb.status_pembayaran = 'lunas'
        ORDER BY pb.created_at DESC";

$stmt = $conn->query($sql);
$iklanList = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Hitung total pemasukan
$totalPemasukan = array_sum(array_column($iklanList, 'total_tagihan'));
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



                    <!-- Kartu Total Pemasukan -->
                    <div class="mb-6">
                        <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                            <span class="text-sm text-gray-500 dark:text-gray-400">Total Pemasukan (Lunas)</span>
                            <h4 class="mt-2 text-2xl font-bold text-gray-800 dark:text-white/90">
                                Rp <?= number_format($totalPemasukan, 0, ',', '.') ?>
                            </h4>
                            <p class="mt-1 text-sm text-gray-400"><?= count($iklanList) ?> transaksi lunas</p>
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
                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Kode Invoice</p>
                                                            </th>
                                                            <th class="px-5 py-3 sm:px-6 text-left">
                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Pelanggan</p>
                                                            </th>
                                                            <th class="px-5 py-3 sm:px-6 text-left">
                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Lokasi Iklan</p>
                                                            </th>
                                                            <th class="px-5 py-3 sm:px-6 text-left">
                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Metode Bayar</p>
                                                            </th>
                                                            <th class="px-5 py-3 sm:px-6 text-left">
                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Pemasukan</p>
                                                            </th>
                                                            <th class="px-5 py-3 sm:px-6 text-left">
                                                                <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">Tanggal Lunas</p>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                                        <?php if (empty($iklanList)) : ?>
                                                            <tr>
                                                                <td colspan="7" class="px-5 pt-12 pb-12 text-center text-sm text-gray-400 dark:text-gray-500">
                                                                    Belum ada data laporan keuangan.
                                                                </td>
                                                            </tr>
                                                        <?php else : ?>
                                                            <?php foreach ($iklanList as $index => $iklan) : ?>
                                                                <tr>

                                                                    <!-- No -->
                                                                    <td class="px-5 py-4 sm:px-6">
                                                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                                            <?= $index + 1 ?>
                                                                        </p>
                                                                    </td>

                                                                    <!-- Kode Invoice -->
                                                                    <td class="px-5 py-4 sm:px-6">
                                                                        <p class="text-gray-800 text-theme-sm dark:text-white/90 font-mono font-medium">
                                                                            <?= htmlspecialchars($iklan['kode_invoice'] ?? '-') ?>
                                                                        </p>
                                                                    </td>

                                                                    <!-- Pelanggan -->
                                                                    <td class="px-5 py-4 sm:px-6">
                                                                        <p class="text-gray-800 text-theme-sm dark:text-white/90 font-medium">
                                                                            <?= htmlspecialchars($iklan['nama_pelanggan'] ?? '-') ?>
                                                                        </p>
                                                                        <p class="text-gray-400 text-xs">
                                                                            <?= htmlspecialchars($iklan['kode_pelanggan'] ?? '-') ?>
                                                                        </p>
                                                                    </td>

                                                                    <!-- Lokasi Iklan -->
                                                                    <td class="px-5 py-4 sm:px-6">
                                                                        <p class="text-gray-800 text-theme-sm dark:text-white/90 font-medium">
                                                                            <?= htmlspecialchars($iklan['nama_lokasi'] ?? '-') ?>
                                                                        </p>
                                                                        <p class="text-gray-400 text-xs max-w-[160px] truncate" title="<?= htmlspecialchars($iklan['alamat'] ?? '') ?>">
                                                                            <?= htmlspecialchars($iklan['alamat'] ?? '-') ?>
                                                                        </p>
                                                                    </td>

                                                                    <!-- Metode Bayar -->
                                                                    <td class="px-5 py-4 sm:px-6">
                                                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400 capitalize">
                                                                            <?= htmlspecialchars($iklan['metode_pembayaran'] ?? '-') ?>
                                                                        </p>
                                                                    </td>

                                                                    <!-- Pemasukan -->
                                                                    <td class="px-5 py-4 sm:px-6">
                                                                        <p class="text-green-600 dark:text-green-400 font-semibold text-theme-sm">
                                                                            Rp <?= number_format($iklan['total_tagihan'] ?? 0, 0, ',', '.') ?>
                                                                        </p>
                                                                    </td>

                                                                    <!-- Tanggal Lunas -->
                                                                    <td class="px-5 py-4 sm:px-6">
                                                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                                                            <?= $iklan['tanggal_dibuat_tagihan']
                                                                                ? date('d M Y', strtotime($iklan['tanggal_dibuat_tagihan']))
                                                                                : date('d M Y', strtotime($iklan['tanggal_invoice'])) ?>
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