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
                                <li class="breadcrumb-item active" aria-current="page"><a href="<?= site_url('kriteria') ?>" class="link">Kriteria</a></li>
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
                                <h4 class="card-title mb-3 pb-3 border-bottom">Form Edit Kriteria</h4>
                                <form action="<?= site_url('kriteria/kriteria_update'); ?>" method="post">
                                    <?php foreach ($kriteria as $row) { ?>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-floating mb3">
                                                    <input type="hidden" name="slug" value="<?= $row->slug; ?>">
                                                    <input type="text" name="namaKriteria" id="namaKriteria" class="form-control" value="<?= $row->kriteria; ?>" required>
                                                    <label for="namaKriteria">Nama Kriteria</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-md-flex align-items-center mt-3 float-end">
                                                    <a href="<?= site_url('kriteria') ?>" class="btn btn-outline-secondary waves-effect waves-light rounded-pill px-4 mx-2">
                                                        Batal
                                                    </a>
                                                    <button type="submit" class="btn btn-info font-weight-medium text-white rounded-pill px-4">
                                                        <i class="mdi mdi-content-save"></i>
                                                        Simpan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view('components/footer'); ?>
</body>

</html>