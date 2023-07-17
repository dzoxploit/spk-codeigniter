<?php $this->load->view('components/head'); ?>

<body>
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
                                <li class="breadcrumb-item active" aria-current="page"><a href="<?= site_url('alternatif') ?>" class="link">Alternatif</a></li>
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
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3 pb-3 border-bottom">Form Tambah Alternatif</h4>
                                <form action="<?= site_url('perbandingan/alternatif_update'); ?>" method="post">
                                    <?php foreach ($alternatif as $data) : ?>
                                        <input type="hidden" id="id" name="id" value="<?php echo $data->id; ?>">
                                    <?php endforeach; ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group mb-4">
                                                <label for="kost">Kost</label>
                                                <select name="kost" class="form-select me-sm-2" required>
                                                    <?php foreach ($alternatif as $data) : ?>
                                                        <option value="<?php echo $data->idKost; ?>" <?php if ($data->idKost == $data->idKost) : ?>selected<?php endif; ?>>
                                                            <?php echo $data->kost; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                    <?php foreach ($kost as $row) { ?>
                                                        <option value="<?php echo $row->id; ?>"><?php echo $row->kost; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <h5 class="mb-3 fw-bold">Subkriteria</h5>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="harga">Harga</label>
                                                <select name="harga" class="form-select me-sm-2" required>
                                                    <?php foreach ($alternatif as $data) : ?>
                                                        <option value="<?php echo $data->idSubkriteriaHarga; ?>" <?php if ($data->idSubkriteriaHarga == $data->idSubkriteriaHarga) : ?>selected<?php endif; ?>>
                                                            <?php echo $data->namaSubkriteriaHarga; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                    <?php foreach ($harga as $row) { ?>
                                                        <option value="<?php echo $row->id; ?>"><?php echo $row->subkriteria; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="jarak">Jarak</label>
                                                <select name="jarak" class="form-select me-sm-2" required>
                                                    <?php foreach ($alternatif as $data) : ?>
                                                        <option value="<?php echo $data->idSubkriteriaJarak; ?>" <?php if ($data->idSubkriteriaJarak == $data->idSubkriteriaJarak) : ?>selected<?php endif; ?>>
                                                            <?php echo $data->namaSubkriteriaJarak; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                    <?php foreach ($jarak as $row) { ?>
                                                        <option value="<?php echo $row->id; ?>"><?php echo $row->subkriteria; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="luas">Luas Kamar</label>
                                                <select name="luas" class="form-select me-sm-2" required>
                                                    <?php foreach ($alternatif as $data) : ?>
                                                        <option value="<?php echo $data->idSubkriteriaLuas; ?>" <?php if ($data->idSubkriteriaLuas == $data->idSubkriteriaLuas) : ?>selected<?php endif; ?>>
                                                            <?php echo $data->namaSubkriteriaLuas; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                    <?php foreach ($luas as $row) { ?>
                                                        <option value="<?php echo $row->id; ?>"><?php echo $row->subkriteria; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group mb-3">
                                                <label for="keamanan">Keamanan</label>
                                                <select name="keamanan" class="form-select me-sm-2" required>
                                                    <?php foreach ($alternatif as $data) : ?>
                                                        <option value="<?php echo $data->idSubkriteriaKeamanan; ?>" <?php if ($data->idSubkriteriaKeamanan == $data->idSubkriteriaKeamanan) : ?>selected<?php endif; ?>>
                                                            <?php echo $data->namaSubkriteriaKeamanan; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                    <?php foreach ($keamanan as $row) { ?>
                                                        <option value="<?php echo $row->id; ?>"><?php echo $row->subkriteria; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-md-flex align-items-center mt-3 float-end">
                                                <a href="<?= site_url('alternatif') ?>" class="btn btn-outline-secondary waves-effect waves-light rounded-pill px-4 mx-2">
                                                    Batal
                                                </a>
                                                <button type="submit" class="btn btn-info font-weight-medium text-white rounded-pill px-4">
                                                    <i class="mdi mdi-content-save"></i>
                                                    Simpan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view('components/footer'); ?>
</body>

</html>