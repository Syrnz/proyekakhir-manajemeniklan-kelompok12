    <?php
    include('../../middleware/check_login.php');
    include_once("../../../database/koneksi_db.php");
    ?>

    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta
            name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>
            Dashboard
        </title>
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
            <div
                class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-brand-500 border-t-transparent"></div>
        </div>

        <!-- ===== Preloader End ===== -->

        <!-- ===== Page Wrapper Start ===== -->
        <div class="flex h-screen overflow-hidden">
            <!-- ===== Sidebar Start ===== -->
            <?php include('../partials/sidebar.php') ?>

            <!-- ===== Sidebar End ===== -->

            <!-- ===== Content Area Start ===== -->
            <div
                class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
                <!-- Small Device Overlay Start -->
                <div
                    @click="sidebarToggle = false"
                    :class="sidebarToggle ? 'block lg:hidden' : 'hidden'"
                    class="fixed w-full h-screen z-9 bg-gray-900/50"></div>

                <!-- ===== Header Start ===== -->
                <?php include('../partials/header.php') ?>

                <!-- ===== Main Content Start ===== -->
                <main>
                    <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
                        <div class="grid grid-cols-12 gap-4 md:gap-6">
                            <div class="col-span-12 space-y-6">
                                <!-- Metric Group One -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-3 gap-4 md:gap-6">
                                    <!-- IKLAN AKTIF -->
                                    <div
                                        class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                                        <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-white/90">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
                                                <path d="M0 0h24v24H0z" fill="none" />
                                                <path fill="currentColor" d="M19 7c-1.1 0-2 .9-2 2v2c0 1.1.9 2 2 2h2v2h-4v2h4c1.1 0 2-.9 2-2v-2c0-1.1-.9-2-2-2h-2V9h4V7zM9 7v10h4c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2zm2 2h2v6h-2zM3 7c-1.1 0-2 .9-2 2v8h2v-4h2v4h2V9c0-1.1-.9-2-2-2zm0 2h2v2H3z" />
                                            </svg>
                                        </div>
                                        <?php
                                        $sql = "SELECT COUNT(*) AS jumlahIklan FROM iklan WHERE status_data = 'aktif'
                                        And status_iklan ='aktif'";
                                        $stmt = $conn->query($sql);
                                        $dataIklan = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $jumlahIklanAktif = $dataIklan['jumlahIklan'] ?? 0; 
                                        ?>
                                        <div class="mt-5 flex items-end justify-between">
                                            <div>
                                                <span class="text-sm text-gray-500 dark:text-gray-400">IKLAN AKTIF</span>
                                                <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                                                    <?= number_format($jumlahIklanAktif); ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- TOTAL ORDER -->
                                    <div
                                        class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                                        <div
                                            class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-white/90">
                                            <svg
                                                class="h-7 w-7"
                                                width="29"
                                                height="28"
                                                viewBox="0 0 29 28"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M5.625 9.33333L3 9.33333M4.75 14H3M3.875 18.6667H3M9.90222 22.3117H23.0071C23.9027 22.3117 24.6537 21.6356 24.7475 20.7449L26.129 7.62071C26.2378 6.58744 25.4276 5.6875 24.3887 5.6875H11.2838C10.3882 5.6875 9.63716 6.36364 9.5434 7.25429L8.16184 20.3785C8.05307 21.4118 8.86324 22.3117 9.90222 22.3117ZM16.4622 5.6875H19.5793L18.7043 11.508H15.5872L16.4622 5.6875Z"
                                                    stroke="currentColor"
                                                    stroke-width="1.5"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <?php
                                        $sql = "SELECT COUNT(*) AS totalOrder FROM iklan where status_data in ('selesai','aktif') ";
                                        $stmt = $conn->query($sql);
                                        $dataRiwayat = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $SemuaRiwayat = $dataRiwayat['totalOrder'] ?? 0;
                                        ?>
                                        <div class="mt-5 flex items-end justify-between">
                                            <div>
                                                <span class="text-sm text-gray-500 dark:text-gray-400">TOTAL ORDER</span>
                                                <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                                                    <?= number_format($SemuaRiwayat); ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- PELANGGAN -->
                                    <div
                                        class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 dark:bg-gray-800">
                                            <svg class="fill-gray-800 dark:fill-white/90" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M8.80443 5.60156C7.59109 5.60156 6.60749 6.58517 6.60749 7.79851C6.60749 9.01185 7.59109 9.99545 8.80443 9.99545C10.0178 9.99545 11.0014 9.01185 11.0014 7.79851C11.0014 6.58517 10.0178 5.60156 8.80443 5.60156ZM5.10749 7.79851C5.10749 5.75674 6.76267 4.10156 8.80443 4.10156C10.8462 4.10156 12.5014 5.75674 12.5014 7.79851C12.5014 9.84027 10.8462 11.4955 8.80443 11.4955C6.76267 11.4955 5.10749 9.84027 5.10749 7.79851ZM4.86252 15.3208C4.08769 16.0881 3.70377 17.0608 3.51705 17.8611C3.48384 18.0034 3.5211 18.1175 3.60712 18.2112C3.70161 18.3141 3.86659 18.3987 4.07591 18.3987H13.4249C13.6343 18.3987 13.7992 18.3141 13.8937 18.2112C13.9797 18.1175 14.017 18.0034 13.9838 17.8611C13.7971 17.0608 13.4132 16.0881 12.6383 15.3208C11.8821 14.572 10.6899 13.955 8.75042 13.955C6.81096 13.955 5.61877 14.572 4.86252 15.3208ZM3.8071 14.2549C4.87163 13.2009 6.45602 12.455 8.75042 12.455C11.0448 12.455 12.6292 13.2009 13.6937 14.2549C14.7397 15.2906 15.2207 16.5607 15.4446 17.5202C15.7658 18.8971 14.6071 19.8987 13.4249 19.8987H4.07591C2.89369 19.8987 1.73504 18.8971 2.05628 17.5202C2.28015 16.5607 2.76117 15.2906 3.8071 14.2549ZM15.3042 11.4955C14.4702 11.4955 13.7006 11.2193 13.0821 10.7533C13.3742 10.3314 13.6054 9.86419 13.7632 9.36432C14.1597 9.75463 14.7039 9.99545 15.3042 9.99545C16.5176 9.99545 17.5012 9.01185 17.5012 7.79851C17.5012 6.58517 16.5176 5.60156 15.3042 5.60156C14.7039 5.60156 14.1597 5.84239 13.7632 6.23271C13.6054 5.73284 13.3741 5.26561 13.082 4.84371C13.7006 4.37777 14.4702 4.10156 15.3042 4.10156C17.346 4.10156 19.0012 5.75674 19.0012 7.79851C19.0012 9.84027 17.346 11.4955 15.3042 11.4955ZM19.9248 19.8987H16.3901C16.7014 19.4736 16.9159 18.969 16.9827 18.3987H19.9248C20.1341 18.3987 20.2991 18.3141 20.3936 18.2112C20.4796 18.1175 20.5169 18.0034 20.4837 17.861C20.2969 17.0607 19.913 16.088 19.1382 15.3208C18.4047 14.5945 17.261 13.9921 15.4231 13.9566C15.2232 13.6945 14.9995 13.437 14.7491 13.1891C14.5144 12.9566 14.262 12.7384 13.9916 12.5362C14.3853 12.4831 14.8044 12.4549 15.2503 12.4549C17.5447 12.4549 19.1291 13.2008 20.1936 14.2549C21.2395 15.2906 21.7206 16.5607 21.9444 17.5202C22.2657 18.8971 21.107 19.8987 19.9248 19.8987Z"
                                                    fill="" />
                                            </svg>
                                        </div>
                                        <?php
                                        $sql = "SELECT COUNT(*) AS jumlahPelanggan FROM pelanggan";
                                        $stmt = $conn->query($sql);

                                        $dataPelanggan = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $SemuaPelanggan = $dataPelanggan['jumlahPelanggan'] ?? 0;
                                        ?>
                                        <div class="mt-5 flex items-end justify-between">
                                            <div>
                                                <span class="text-sm text-gray-500 dark:text-gray-400">PELANGGAN</span>
                                                <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                                                    <?= number_format($SemuaPelanggan); ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>

                                    <!--  IKLAN SELESAI -->
                                    <div
                                        class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                                        <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-white/90">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                                <path d="M0 0h24v24H0z" fill="none" />
                                                <path fill="currentColor" d="m12.2 9l-2-2H13c1.1 0 2 .9 2 2v2.8l-2-2V9zM23 9V7h-4c-1.1 0-2 .9-2 2v2c0 1.1.9 2 2 2h2v2h-2.8l2 2h.8c1.1 0 2-.9 2-2v-2c0-1.1-.9-2-2-2h-2V9zm-.9 12.5l-1.3 1.3l-6.4-6.4c-.3.3-.8.6-1.4.6H9v-6.1l-2-2V17H5v-4H3v4H1V9c0-1.1.9-2 2-2h2.1l-4-4l1.3-1.3zM5 9H3v2h2zm8 5.9l-2-2V15h2z" />
                                            </svg>

                                        </div>
                                        <?php
                                        $sql = "SELECT COUNT(*) AS iklanSelesai FROM iklan where status_data = 'selesai'";
                                        $stmt = $conn->query($sql);
                                        $dataiklanselesai = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $Semuaiklanselesai = $dataiklanselesai['iklanSelesai'] ?? 0;
                                        ?>
                                        <div class="mt-5 flex items-end justify-between">
                                            <div>
                                                <span class="text-sm text-gray-500 dark:text-gray-400">IKLAN SELESAI</span>
                                                <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                                                    <?= number_format($Semuaiklanselesai); ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- TOTAL OMSET -->
                                    <div
                                        class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                                        <div
                                            class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-white/90">
                                            <svg
                                                class="fill-current"
                                                width="25"
                                                height="24"
                                                viewBox="0 0 25 24"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    fill-rule="evenodd"
                                                    clip-rule="evenodd"
                                                    d="M13.4164 2.79175C13.4164 2.37753 13.0806 2.04175 12.6664 2.04175C12.2522 2.04175 11.9164 2.37753 11.9164 2.79175V4.39876C9.94768 4.67329 8.43237 6.36366 8.43237 8.40795C8.43237 10.0954 9.47908 11.6058 11.0591 12.1984L13.7474 13.2066C14.7419 13.5795 15.4008 14.5303 15.4008 15.5925C15.4008 16.9998 14.2599 18.1407 12.8526 18.1407H11.7957C10.7666 18.1407 9.93237 17.3064 9.93237 16.2773C9.93237 15.8631 9.59659 15.5273 9.18237 15.5273C8.76816 15.5273 8.43237 15.8631 8.43237 16.2773C8.43237 18.1348 9.9382 19.6407 11.7957 19.6407H11.9164V21.2083C11.9164 21.6225 12.2522 21.9583 12.6664 21.9583C13.0806 21.9583 13.4164 21.6225 13.4164 21.2083V19.6017C15.3853 19.3274 16.9008 17.6369 16.9008 15.5925C16.9008 13.905 15.8541 12.3946 14.2741 11.8021L11.5858 10.7939C10.5912 10.4209 9.93237 9.47013 9.93237 8.40795C9.93237 7.00063 11.0732 5.85976 12.4806 5.85976H13.5374C14.5665 5.85976 15.4008 6.69401 15.4008 7.72311C15.4008 8.13732 15.7366 8.47311 16.1508 8.47311C16.565 8.47311 16.9008 8.13732 16.9008 7.72311C16.9008 5.86558 15.395 4.35976 13.5374 4.35976H13.4164V2.79175Z"
                                                    fill="" />
                                            </svg>
                                        </div>
                                        <?php
                                        $sql = "SELECT sum(pemasukan) AS income FROM laporan_keuangan";
                                        $stmt = $conn->query($sql);
                                        $dataLaporanKeuangan = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $SemuaOmset = $dataLaporanKeuangan['income'] ?? 0;
                                        ?>
                                        <div class="mt-5 flex items-end justify-between">
                                            <div>
                                                <span class="text-sm text-gray-500 dark:text-gray-400">TOTAL PENGHASILAN</span>
                                                <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                                                    Rp. <?= number_format($SemuaOmset, 0, ',', '.'); ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- LOKASI IKLAN -->
                                    <div
                                        class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/[0.03] md:p-6">
                                        <div class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-white/90">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                                <path d="M0 0h24v24H0z" fill="none" />
                                                <g fill="none" fill-rule="evenodd">
                                                    <path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                                    <path fill="currentColor" d="M17.553 16.106a1 1 0 0 1 1.283.345l.058.102l2 4a1 1 0 0 1-.765 1.439L20 22H4a1 1 0 0 1-.945-1.328l.05-.12l2-4a1 1 0 0 1 1.836.788l-.047.107L5.618 20h12.764l-1.276-2.553a1 1 0 0 1 .447-1.341M12 2a7 7 0 0 1 7 7c0 2.382-1.289 4.317-2.623 5.69a15.7 15.7 0 0 1-2.418 2.008l-.373.246l-.332.209l-.149.09l-.257.148c-.528.3-1.168.3-1.696 0l-.257-.149l-.31-.189l-.171-.109l-.373-.246a15.7 15.7 0 0 1-2.418-2.008C6.289 13.317 5 11.382 5 9a7 7 0 0 1 7-7m0 2a5 5 0 0 0-5 5c0 1.636.89 3.095 2.057 4.296a14 14 0 0 0 2.314 1.885l.34.217q.158.097.289.174l.29-.174l.339-.217a14 14 0 0 0 2.314-1.885C16.11 12.096 17 10.636 17 9a5 5 0 0 0-5-5m0 2a3 3 0 1 1 0 6a3 3 0 0 1 0-6m0 2a1 1 0 1 0 0 2a1 1 0 0 0 0-2" />
                                                </g>
                                            </svg>

                                        </div>
                                        <?php
                                        $sql = "SELECT count(status) AS statustersedia FROM lokasi_iklan where status = 'tersedia'";
                                        $stmt = $conn->query($sql);
                                        $datalokasi = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $Semualokasi = $datalokasi['statustersedia'] ?? 0; // Jika 
                                        ?>
                                        <div class="mt-5 flex items-end justify-between">
                                            <div>
                                                <span class="text-sm text-gray-500 dark:text-gray-400">LOKASI IKLAN TERSEDIA</span>
                                                <h4 class="mt-2 text-title-sm font-bold text-gray-800 dark:text-white/90">
                                                    <?= number_format($Semualokasi) ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Metric Item End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script defer src="../src/js/bundle.js"></script>
    </body>

    </html>