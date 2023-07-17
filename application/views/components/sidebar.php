<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url("dashboard") ?>" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-checkbox-multiple-marked"></i>
                        <span class="hide-menu">Kriteria</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item active">
                            <a href="<?= site_url('kriteria') ?>" class="sidebar-link">Kriteria</a>
                            <a href="<?= site_url('subkriteria') ?>" class="sidebar-link">Subkriteria</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url('kost') ?>" aria-expanded="false"><i class="mdi mdi-home-modern"></i><span class="hide-menu">Kost</span></a></li>
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                        <i class="mdi mdi-calculator"></i>
                        <span class="hide-menu">Perhitungan</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a href="<?= site_url('alternatif') ?>" class="sidebar-link">Alternatif</a>
                            <a href="<?= site_url('perbandingan') ?>" class="sidebar-link">Perbandingan Kriteria</a>
                            <a href="<?= site_url('perbandingan/subkriteria') ?>" class="sidebar-link">Perbandingan Subkriteria</a>
                            <a href="<?= site_url('hasil') ?>" class="sidebar-link">Hasil Penghitungan</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= site_url('rangking') ?>" aria-expanded="false"><i class="mdi mdi-trophy"></i><span class="hide-menu">Perangkingan</span></a></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>