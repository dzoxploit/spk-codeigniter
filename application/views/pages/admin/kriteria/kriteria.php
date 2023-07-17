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
                    <div class="col-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                                <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?= ucfirst($currentPage); ?></li>
                            </ol>
                        </nav>
                        <h1 class="mb-0 fw-bold"><?= ucfirst($currentPage); ?></h1>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <a href="<?= site_url('kriteria/add') ?>" class="justify-content-center btn btn-info text-white align-items-center">
                                <i class="mdi mdi-plus"></i>
                                Tambah Data Kriteria
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table customize-table table-hover mb-0 v-middle text-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col" colspan="2">Kriteria</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($kriteria as $index => $row) { ?>
                                        <tr>
                                            <th scope="row"><?php echo $index + 1; ?></th>
                                            <td colspan="2"><?php echo $row->kriteria; ?></td>
                                            <td>
                                                <div class="dropdown dropright">
                                                    <a href="#" class="link" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="mdi mdi-dots-horizontal"></i>
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <li><a href="<?php echo site_url('kriteria/parameter/' . $row->id); ?>" class="dropdown-item">Parameter</a></li>
                                                        <li><a href="<?php echo site_url('kriteria/edit/' . $row->slug); ?>" class="dropdown-item">Edit</a></li>
                                                        <li><button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#al-danger-alert-<?php echo $row->slug; ?>">Hapus</button></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <div class="modal fade" id="al-danger-alert-<?php echo $row->slug; ?>" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content modal-filled bg-light-danger">
                                                        <div class="modal-body p4">
                                                            <div class="text-center text-danger">
                                                                <i class="mdi mdi-delete-forever"></i>
                                                                <h4 class="mt-2">
                                                                    Apakah anda yakin ?
                                                                </h4>
                                                                <p class="mt-3">
                                                                    Anda akan menghapus data tersebut
                                                                </p>
                                                                <a href="<?php echo site_url('kriteria/delete/' . $row->slug); ?>" class="btn btn-light my-2">
                                                                    Hapus Data
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php $this->load->view('components/footer'); ?>
</body>

</html>