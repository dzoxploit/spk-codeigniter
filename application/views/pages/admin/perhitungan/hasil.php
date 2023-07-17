<?php $this->load->view('components/head'); ?>

<body>
    <script type="text/javascript">
        $(document).ready(function() {

            var nilaiPrioritasKriteria = <?php echo json_encode($nilai_prioritas_kriteria); ?>;

            var indeksHarga = 0;

            $('#formRangking').submit(function(e) {
                e.preventDefault();

                var form = $(this);
                var url = form.attr('action');
                var formData = form.serialize();

                // Tambahkan data dari elemen input dengan id valueTotal-0, valueTotal-1, dst.
                $('[id^="valueTotal-"]').each(function() {
                    var inputId = $(this).attr('id');
                    var value = $(this).val();
                    formData += '&' + inputId + '=' + value;
                });

                console.log(formData)

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: "<?= site_url('update-rangking'); ?>",
                    data: formData,
                    success: function(response) {
                        // Tambahkan logika sukses di sini
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText)
                    }
                });
            });

            $("td[id^='subkriteria-harga-']").each(function() {
                var elemId = $(this).attr("id");
                var namaSubkriteriaHarga = elemId.split("-").slice(2, -1).join("-");

                $('th[id^="nilaiPrioritas-"]').each(function() {
                    var nilai = ''
                    var thId = $(this).attr('id');
                    var idParts = thId.split('-');
                    var data = idParts.slice(1, idParts.length - 1).join('-');

                    if (namaSubkriteriaHarga === data) {
                        nilai = parseFloat(idParts[idParts.length - 1]);
                        nilai *= nilaiPrioritasKriteria[1]

                        $("#valueHarga-" + indeksHarga).val(nilai);
                        indeksHarga++;
                        nilai = ''
                        return false;
                    } else {
                        console.log('Data tidak ditemukan');
                    }
                });

            });

            indeksJarak = 0;

            $("td[id^='subkriteria-jarak-']").each(function() {
                var elemId = $(this).attr("id");
                var namaSubkriteriaJarak = elemId.split("-").slice(2, -1).join("-");

                $('th[id^="nilaiPrioritas-"]').each(function() {
                    var nilai = ''
                    var thId = $(this).attr('id');
                    var idParts = thId.split('-');
                    var data = idParts.slice(1, idParts.length - 1).join('-');

                    if (namaSubkriteriaJarak === data) {
                        nilai = parseFloat(idParts[idParts.length - 1]);
                        nilai *= nilaiPrioritasKriteria[2]
                        $("#valueJarak-" + indeksJarak).val(nilai);
                        indeksJarak++;
                        nilai = ''
                        return false;
                    } else {
                        console.log('Data tidak ditemukan');
                    }
                });

            });

            indeksLuas = 0;

            $("td[id^='subkriteria-luas-']").each(function() {
                var elemId = $(this).attr("id");
                var namaSubkriteriaLuas = elemId.split("-").slice(2, -1).join("-");

                $('th[id^="nilaiPrioritas-"]').each(function() {
                    var nilai = ''
                    var thId = $(this).attr('id');
                    var idParts = thId.split('-');
                    var data = idParts.slice(1, idParts.length - 1).join('-');

                    if (namaSubkriteriaLuas === data) {
                        nilai = parseFloat(idParts[idParts.length - 1]);
                        nilai *= nilaiPrioritasKriteria[3]
                        $("#valueLuas-" + indeksLuas).val(nilai);
                        indeksLuas++;
                        nilai = ''
                        return false;
                    } else {
                        console.log('Data tidak ditemukan');
                    }
                });

            });

            indeksKeamanan = 0;

            $("td[id^='subkriteria-keamanan-']").each(function() {
                var elemId = $(this).attr("id");
                var namaSubkriteriaKeamanan = elemId.split("-").slice(2, -1).join("-");

                $('th[id^="nilaiPrioritas-"]').each(function() {
                    var nilai = ''
                    var thId = $(this).attr('id');
                    var idParts = thId.split('-');
                    var data = idParts.slice(1, idParts.length - 1).join('-');

                    if (namaSubkriteriaKeamanan === data) {
                        nilai = parseFloat(idParts[idParts.length - 1]);
                        nilai *= nilaiPrioritasKriteria[4]
                        $("#valueKeamanan-" + indeksKeamanan).val(nilai);
                        indeksKeamanan++;
                        nilai = ''
                        return false;
                    } else {
                        console.log('Data tidak ditemukan');
                    }
                });

            });

            rangking();
        });

        function rangking() {
            var totalDataAlternatif = $('[id^="subkriteria-harga"]').length;

            for (var i = 0; i < totalDataAlternatif; i++) {

                var totalNilai = 0;

                var valueHarga = parseFloat($("#valueHarga-" + i).val());
                var valueJarak = parseFloat($("#valueJarak-" + i).val());
                var valueLuas = parseFloat($("#valueLuas-" + i).val());
                var valueKeamanan = parseFloat($("#valueKeamanan-" + i).val());

                totalNilai = valueHarga + valueJarak + valueLuas + valueKeamanan;

                $("#valueTotal-" + i).val(totalNilai)
            }
        }
    </script>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div> -->
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
                                <li class="breadcrumb-item active" aria-current="page"><?= ucfirst($currentPage); ?></li>
                            </ol>
                        </nav>
                        <h1 class="mb-0 fw-bold"><?= ucfirst($currentPage); ?></h1>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card overflow-hidden">
                            <div class="card-body bg-light">
                                <h2 class="text-center fw-bold">Tabel Kriteria</h2>
                            </div>
                            <div class="table-responsive">
                                <table class="table customize-table table-bordered mb-0 v-middle text-nowrap">
                                    <thead>
                                        <tr class="bg-light">
                                            <th></th>
                                            <th>Prioritas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($kriteria as $data) { ?>
                                            <tr>
                                                <th scope="row" class="bg-light fw-bold"><?php echo $data->kriteria; ?></th>
                                                <td><?php echo $nilai_prioritas_kriteria[$data->id]; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php foreach ($kriteria as $kriteria_data) {
                            $idKriteria = $kriteria_data->id;
                            $jumlahSubkriteria = 0;
                        ?>
                            <div class="card overflow-hidden">
                                <div class="card-body bg-light">
                                    <h2 class="text-center fw-bold">Tabel Subkriteria <?php echo $kriteria_data->kriteria; ?></h2>
                                </div>
                                <div class="table-responsive">
                                    <table class="table customize-table table-bordered mb-0 v-middle text-nowrap">
                                        <thead>
                                            <tr class="bg-light">
                                                <th></th>
                                                <th>Prioritas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($subkriteria as $subkriteria_data) {
                                                if ($subkriteria_data->idKriteria == $idKriteria) {
                                                    $jumlahSubkriteria++;
                                            ?>
                                                    <tr>
                                                        <?php
                                                        $nilaiPrioritas = isset($groupedData[$idKriteria][$jumlahSubkriteria]['nilaiPrioritas']) ? $groupedData[$idKriteria][$jumlahSubkriteria]['nilaiPrioritas'] : "Data tidak tersedia";
                                                        ?>
                                                        <th id="nilaiPrioritas-<?php echo $subkriteria_data->subkriteria; ?>-<?= $nilaiPrioritas ?>" scope="row" class="bg-light fw-bold"><?php echo $subkriteria_data->subkriteria; ?></th>

                                                        <?php echo "<td>" . $nilaiPrioritas . "</td>"; ?>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="card overflow-hidden">
                            <div class="card-body bg-light">
                                <h2 class="text-center fw-bold">Tabel Alternatif</h2>
                            </div>
                            <div class="table-responsive">
                                <table class="table customize-table table-hover mb-0 v-middle text-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col" colspan="2">Nama Kos</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Jarak</th>
                                            <th scope="col">Luas Kamar</th>
                                            <th scope="col">Keamanan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($alternatif as $index => $row) { ?>
                                            <tr>
                                                <th scope="row"><?php echo $index + 1; ?></th>
                                                <td colspan="2"><?php echo $row->kost; ?></td>
                                                <td><?php echo $row->namaSubkriteriaHarga; ?></td>
                                                <td><?php echo $row->namaSubkriteriaJarak; ?></td>
                                                <td><?php echo $row->namaSubkriteriaLuas; ?></td>
                                                <td><?php echo $row->namaSubkriteriaKeamanan; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="notification"></div>
                        <form action="<?= base_url("") ?>" class="form-horizontal" method="post" id="formRangking">
                            <div class="card overflow-hidden">
                                <div class="card-body bg-light">
                                    <h2 class="text-center fw-bold">Tabel Hasil Akhir</h2>
                                </div>
                                <div class="table-responsive">
                                    <table class="table customize-table table-hover mb-0 v-middle text-nowrap">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col" colspan="2">Nama Kos</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Jarak</th>
                                                <th scope="col">Luas Kamar</th>
                                                <th scope="col">Keamanan</th>
                                                <th scope="col">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($alternatif as $index => $row) { ?>
                                                <tr>
                                                    <th scope="row"><?php echo $index + 1; ?></th>
                                                    <td colspan="2"><?php echo $row->kost; ?></td>
                                                    <td id="subkriteria-harga-<?php echo $row->namaSubkriteriaHarga; ?>-<?php echo $index; ?>">
                                                        <input type="text" id="valueHarga-<?php echo $index; ?>" value="0" class="form-control" readonly>
                                                    </td>
                                                    <td id="subkriteria-jarak-<?php echo $row->namaSubkriteriaJarak; ?>-<?php echo $index; ?>">
                                                        <input type="text" id="valueJarak-<?php echo $index; ?>" value="0" class="form-control" readonly>
                                                    </td>
                                                    <td id="subkriteria-luas-<?php echo $row->namaSubkriteriaLuas; ?>-<?php echo $index; ?>">
                                                        <input type="text" id="valueLuas-<?php echo $index; ?>" value="0" class="form-control" readonly>
                                                    </td>
                                                    <td id="subkriteria-keamanan-<?php echo $row->namaSubkriteriaKeamanan; ?>-<?php echo $index; ?>">
                                                        <input type="text" id="valueKeamanan-<?php echo $index; ?>" value="0" class="form-control" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="alternatif_id[]" value="<?php echo $row->id; ?>">
                                                        <input type="text" name="valueTotal[]" id="valueTotal-<?php echo $index; ?>" value="0" class="form-control" readonly>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-body">
                                    <div class="d-md-flex align-items-center float-end">
                                        <button type="submit" name="submit" class="btn btn-success waves-effect waves-light rounded-pill px-4 mx-2">
                                            Simpan Data Hasil Akhir
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->load->view('components/footer'); ?>
</body>

</html>