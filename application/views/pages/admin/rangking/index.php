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
                        <div class="table-responsive">
                            <table class="table customize-table table-hover mb-0 v-middle text-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Rangking</th>
                                        <th scope="col" colspan="2">Nama Kost</th>
                                        <th scope="col" colspan="2">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($rangking as $index => $row) { ?>
                                        <tr>
                                            <th scope="row"><?php echo $index + 1; ?></th>
                                            <td colspan="2"><?php echo $row->kost; ?></td>
                                            <td colspan="2"><?php echo $row->nilai; ?></td>
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