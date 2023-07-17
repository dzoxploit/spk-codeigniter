<?php $this->load->view('components/head'); ?>

<body>
    <?php
    $url = $_SERVER['REQUEST_URI']; // Mendapatkan URL saat ini
    $segments = explode('/', rtrim($url, '/')); // Memecah URL menjadi segmen-segmen

    $nilai = end($segments); // Mengambil nilai dari segmen terakhir

    $halaman = "";

    if ($nilai == 1) {
        $halaman = "Harga Sewa Kos Perbulan";
    } elseif ($nilai == 2) {
        $halaman = "Jarak dari Amikom";
    } elseif ($nilai == 3) {
        $halaman = "Luas Kamar";
    } elseif ($nilai == 4) {
        $halaman = "Keamanan";
    }

    $jumlah = count($result);

    $dataIndeksRandom = array(
        1 => 0.00,
        2 => 0.00,
        3 => 0.58,
        4 => 0.90,
        5 => 1.12,
        6 => 1.24,
        7 => 1.32,
        8 => 1.41,
        9 => 1.45,
        10 => 1.49,
        11 => 1.51,
        12 => 1.48,
        13 => 1.56,
        14 => 1.57,
        15 => 1.59,
    );

    $nilaiIndeksRandom = 0.00;

    foreach ($dataIndeksRandom as $data => $value) {
        if ($data == $jumlah) {
            $nilaiIndeksRandom = $value;
        }
    }

    ?>
    <script type="text/javascript">
        $(document).ready(function() {

            // Cek apakah data result dari controller kosong atau tidak lalu jalankan function hitung
            <?php if (!empty($result)) { ?>
                hitung();
            <?php }; ?>

            //Elemen formSubkriteria untuk menyimpan data ke database
            $("#formSubkriteria").submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();

                console.log('Mengirim permintaan AJAX...');
                console.log('Data yang dikirim:', formData);

                $.ajax({
                    type: 'post',
                    dataType: 'json',
                    url: "<?= site_url('update-subkriteria'); ?>",
                    data: formData,
                    error: function(xhr, status, error) {
                        console.log('Terjadi kesalahan pada permintaan AJAX:');
                        console.log('Status:', status);
                        console.log('Error:', error);
                        console.log('Response:', xhr.responseText);
                        console.log('Response Code:', xhr.status);
                        console.log('Response Text:', xhr.statusText);
                        $("#formSubkriteria select").removeAttr("disabled");
                        $("#formSubkriteria button").removeAttr("disabled");
                    },
                    beforeSend: function() {
                        $("#formSubkriteria select").attr('disabled', 'disabled');
                        $("#formSubkriteria button").attr('disabled', 'disabled');
                    },
                    success: function(x) {
                        $("#formSubkriteria select").removeAttr("disabled");
                        $("#formSubkriteria button").removeAttr("disabled");
                    },
                });
            });

            // Jika elemen setiap inputnumber berubah jalankan function hitung
            $(".inputnumber").each(function() {
                $(this).change(function() {
                    hitung();
                });
            });
        });

        function showNotification(type, message, color) {
            $("#notification").html('<div class="container-fluid"><div class="row"><div class="col-12"><div class="alert alert-' + type + ' bg-' + color + ' border-0 text-white">' + message + '</div></div></div></div>');
            $("#notification").show('fadeIn');
            if ($("#notification").is(":visible")) {
                setTimeout(function() {
                    $("#notification").hide('fadeOut');
                }, 3000);
            }
        }

        function showSubkriteriaMatrix() {
            $("#matriksSubkriteria").toggle('fade');
        }

        function hitung() {
            $(".inputnumber").each(function() {
                var dataTarget = $(this).attr('data-target');
                var dataKolom = $(this).attr('data-kolom');
                var jumlah = $(this).val();
                var rumus = 1 / parseFloat(jumlah);
                var fx = rumus.toFixed(2);
                $("#" + dataTarget).val(fx);

                total();
                matriksNilaiKriteria();
                matriksLambdaMaks();
                hasilPenghitungan();
            });
        }

        function total() {
            for (var i = 0; i <= <?= $jumlah; ?>; i++) {
                var sum = 0;
                $(".kolom" + i).each(function() {
                    sum += parseFloat($(this).val());
                });
                var fx = sum;
                $("#totalBaris" + i).val(fx);
            }
        }

        function matriksNilaiKriteria() {
            for (var i = 0; i < <?= $jumlah; ?>; i++) {
                var jml = 0;
                for (var x = 0; x < <?= $jumlah; ?>; x++) {
                    var vtarget = $("#" + i + "_" + x).val();
                    var vkolom = $("#totalBaris" + x).val();
                    var rumus = parseFloat(vtarget) / parseFloat(vkolom);
                    var fx = rumus;
                    jml += parseFloat(rumus);
                    $("#matriksNilai" + i + "_" + x).val(fx);
                }
                var jumlahmnk = jml.toFixed(2);
                var prio = parseFloat(jml) / parseFloat(<?= $jumlah; ?>);
                var totprio = prio.toFixed(2);
                $("#jml-b" + i).val(jumlahmnk);
                $("#pri-b" + i).val(totprio);
                $("#sendNilaiPrioritasBaris-" + i).val(totprio);
            }
        }

        function matriksLambdaMaks() {
            var lambdaMaks = 0;
            for (i = 0; i < <?= $jumlah; ?>; i++) {
                var nilaiPrioritas = $("#pri-b" + i).val();
                var nilaiJumlah = $("#totalBaris" + i).val();
                var hitung = parseFloat(nilaiPrioritas) * parseFloat(nilaiJumlah);
                var hasil = hitung.toFixed(2)
                lambdaMaks += parseFloat(hasil);
                $("#nilaiPrioritas" + i).val(nilaiPrioritas);
                $("#nilaiJumlah" + i).val(nilaiJumlah);
                $("#hasil" + i).val(hasil);
            }

            $("#lambda").val(lambdaMaks.toFixed(2));
        }

        function hasilPenghitungan() {
            var lambdaMaks = $("#lambda").val();

            var hitungCI = (lambdaMaks - <?= $jumlah; ?>) / (<?= $jumlah; ?> - 1);

            var hitungCR = hitungCI / <?= $nilaiIndeksRandom; ?>

            $("#nilaiLambdaMaks").val(lambdaMaks);
            $("#nilaiCI").val(hitungCI);
            $("#nilaiCR").val(hitungCR);
            $("#sendNilaiCR").val(hitungCR);
        }
    </script>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php $this->load->view('components/navbar'); ?>

        <?php $this->load->view('components/sidebar'); ?>

        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                                <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                                <li class="breadcrumb-item">Perhitungan</li>
                                <li class="breadcrumb-item"><a href="<?= site_url('perbandingan/subkriteria') ?>" class="link">Perbandingan Subkriteria</a></li>
                                <li class="breadcrumb-item" aria-current="page"><?= $halaman; ?></li>
                            </ol>
                        </nav>
                        <h1 class="mb-0 fw-bold">Perbandingan Subkriteria <?= $halaman; ?></h1>
                    </div>
                </div>
            </div>
            <div id="notification"></div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <form action="<?= base_url("") ?>#" class="form-horizontal" method="post" id="formSubkriteria">
                            <?php foreach ($result as $row_index => $subkriteria) { ?>
                                <input type="hidden" id="sendNilaiPrioritasBaris-<?php echo $row_index; ?>" name="sendNilaiPrioritasBaris-<?php echo $row_index; ?>" value="0" readonly>
                            <?php } ?>
                            <input type="hidden" id="sendNilaiCR" name="sendNilaiCR" value="0" class="form-control">
                            <input type="hidden" id="sendIdKriteria" name="sendIdKriteria" value="<?= $nilai; ?>" class="form-control">
                            <div class="card overflow-hidden text-center">
                                <div class="card-body bg-light">
                                    <h2 class="text-center fw-bold">Matriks Perbandingan Subkriteria</h2>
                                </div>
                                <div class="table-responsive">
                                    <table class="table customize-table table-bordered mb-0 v-middle text-nowrap">
                                        <thead>
                                            <tr class="bg-light">
                                                <th></th>
                                                <?php foreach ($result as $row => $subkriteria) { ?>
                                                    <th class="fw-bold"><?php echo $subkriteria->subkriteria; ?></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($result as $row_index => $subkriteria) { ?>
                                                <tr>
                                                    <th scope="row" class="bg-light fw-bold"><?php echo $subkriteria->subkriteria; ?></th>
                                                    <?php foreach ($result as  $col_index => $col_name) { ?>
                                                        <?php if ($col_index == $row_index) { ?>
                                                            <td>
                                                                <input type="text" id="<?php echo $row_index; ?>_<?php echo $col_index; ?>" value="1" class="form-control kolom<?= $col_index; ?>" title="Kolom <?= $col_index; ?>" readonly>
                                                            </td>
                                                        <?php } elseif ($col_index < $row_index) { ?>
                                                            <td>
                                                                <input type="text" name="<?php echo $row_index; ?>_<?php echo $col_index; ?>" id="<?php echo $row_index; ?>_<?php echo $col_index; ?>" value="0" class="form-control kolom<?= $col_index; ?>" title="Kolom <?= $col_index; ?>" readonly>
                                                            </td>
                                                        <?php } else { ?>
                                                            <td>
                                                                <select name="<?php echo $row_index; ?>_<?php echo $col_index; ?>" id="<?php echo $row_index; ?>_<?php echo $col_index; ?>" class="form-select me-sm-2 inputnumber kolom<?= $col_index; ?>" data-target="<?php echo $col_index; ?>_<?php echo $row_index; ?>" data-kolom="<?php echo $col_index; ?>">
                                                                    <option selected value="1">1</option>
                                                                    <?php for ($i = 2; $i <= 9; $i++) { ?>
                                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                            <tr>
                                                <td scope="row" class="bg-light fw-bold">Jumlah</td>
                                                <?php foreach ($result as $inner_kriteria_id => $inner_kriteria_name) { ?>
                                                    <td><input type="text" id="totalBaris<?= $inner_kriteria_id; ?>" title="Total Baris <?= $inner_kriteria_id; ?>" value="0" class="form-control" readonly></td>
                                                <?php } ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-body">
                                    <div class="d-md-flex align-items-center float-end">
                                        <button type="submit" name="submit" class="btn btn-success waves-effect waves-light rounded-pill px-4 mx-2">
                                            Simpan Data Subkriteria
                                        </button>
                                    </div>
                                    <div class="d-md-flex align-items-center float-end">
                                        <a href="javascript:;" onclick="showSubkriteriaMatrix();" class="btn btn-outline-info waves-effect waves-light rounded-pill px-4 mx-2">
                                            Lihat Matriks Subkriteria
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div id="matriksSubkriteria" style="display: none">
                            <div class="card overflow-hidden">
                                <div class="card-body bg-light">
                                    <h2 class="text-center fw-bold">Matriks Nilai Subkriteria</h2>
                                </div>
                                <div class="table-responsive">
                                    <table class="table customize-table table-bordered mb-0 v-middle text-nowrap">
                                        <thead>
                                            <tr class="bg-light">
                                                <th></th>
                                                <?php foreach ($result as $row => $subkriteria) { ?>
                                                    <th class="fw-bold"><?php echo $subkriteria->subkriteria; ?></th>
                                                <?php } ?>
                                                <th class="fw-bold">Jumlah</th>
                                                <th class="fw-bold">Prioritas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($result as $row_index => $subkriteria) { ?>
                                                <tr>
                                                    <th scope="row" class="bg-light fw-bold"><?php echo $subkriteria->subkriteria; ?></th>
                                                    <?php foreach ($result as  $col_index => $col_name) { ?>
                                                        <?php if ($col_index == $row_index) { ?>
                                                            <td>
                                                                <input type="text" id="matriksNilai<?php echo $row_index; ?>_<?php echo $col_index; ?>" value="0" class="form-control" readonly>
                                                            </td>
                                                        <?php } else { ?>
                                                            <td>
                                                                <input type="text" id="matriksNilai<?php echo $row_index; ?>_<?php echo $col_index; ?>" value="0" class="form-control" readonly>
                                                            </td>
                                                        <?php } ?>
                                                    <?php } ?>
                                                    <td>
                                                        <input type="text" class="form-control" id="jml-b<?php echo $row_index; ?>" value="0" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" id="pri-b<?php echo $row_index; ?>" value="0" readonly>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card overflow-hidden">
                                <div class="card-body bg-light">
                                    <h2 class="text-center fw-bold">Matriks Lambda Maksimal</h2>
                                </div>
                                <div class="table-responsive">
                                    <table class="table customize-table table-bordered mb-0 v-middle text-nowrap">
                                        <thead>
                                            <tr class="bg-light">
                                                <th></th>
                                                <th class="fw-bold">Nilai Prioritas Pada Tabel Matriks Nilai Subkriteria</th>
                                                <th class="fw-bold">Jumlah Pada Matriks Perbandingan Subkriteria</th>
                                                <th class="fw-bold">Hasil</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($result as $row_index => $subkriteria) { ?>
                                                <tr>
                                                    <th scope="row" class="bg-light fw-bold"><?php echo $subkriteria->subkriteria; ?></th>

                                                    <td>
                                                        <input type="text" id="nilaiPrioritas<?php echo $row_index; ?>" value="0" class="form-control" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="nilaiJumlah<?php echo $row_index; ?>" value="0" class="form-control" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="hasil<?php echo $row_index; ?>" value="0" class="form-control" readonly>
                                                    </td>

                                                </tr>
                                            <?php }; ?>
                                            <tr>
                                                <th scope="row" colspan="3" class="bg-light fw-bold text-center">Lambda (λ) Maksimal</th>
                                                <td>
                                                    <input type="text" id="lambda" value="0" class="form-control" readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card overflow-hidden">
                                <div class="card-body bg-light">
                                    <h2 class="text-center fw-bold">Hasil Penghitungan</h2>
                                </div>
                                <div class="table-responsive">
                                    <table class="table customize-table table-bordered mb-0 v-middle text-nowrap">
                                        <thead>
                                            <tr class="bg-light">
                                                <th class="fw-bold">Keterangan</th>
                                                <th class="fw-bold">Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row" class="bg-light fw-bold">Lambda Maks</th>
                                                <td>
                                                    <input type="text" id="nilaiLambdaMaks" value="0" class="form-control" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="bg-light fw-bold">Jumlah Kriteria (n)</th>
                                                <td>
                                                    <input type="text" id="jumlahKriteria" value="<?= $jumlah; ?>" class="form-control" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="bg-light fw-bold">Consistency Index (CI)</th>
                                                <td>
                                                    <input type="text" id="nilaiCI" value="0" class="form-control" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="bg-light fw-bold">Consistency Ratio (CR)</th>
                                                <td>
                                                    <input type="text" id="nilaiCR" value="0" class="form-control" readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view('components/footer'); ?>
</body>

</html>