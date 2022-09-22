<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="profile-image">
                    <img src="/assets/images/faces/user-default.png" alt="image" />
                </div>
                <div class="profile-name">
                    <p class="name">
                        <?=ucfirst($userinfo['fullname']);?>
                    </p>
                    <p class="designation">
                        <?=ucfirst($userinfo['level']);?>
                    </p>
                </div>
            </div>
        </li>

        <?php if ($userinfo['level'] == 'Auditor' || $userinfo['level'] == 'Super Admin') {?>

        <li class="nav-item">
            <a class="nav-link" href="/" p>
                <i class="fa fa-home menu-icon"></i>
                <span class="menu-title">Dashboard Auditor</span>
            </a>
        </li>
        <?php } elseif ($userinfo['level'] == 'Admin Operasional' || $userinfo['level'] == 'Super Admin') {?>

        <li class="nav-item">
            <a class="nav-link" href="/" p>
                <i class="fa fa-home menu-icon"></i>
                <span class="menu-title">Dashboard Operasional</span>
            </a>
        </li>
        <?php } elseif ($userinfo['level'] == 'Admin Warehouse 2' || $userinfo['level'] == 'Super Admin') {?>
        <li class="nav-item">
            <a class="nav-link" href="/" p>
                <i class="fa fa-home menu-icon"></i>
                <span class="menu-title">Dashboard Gudang Opr</span>
            </a>
        </li>
        <?php } elseif ($userinfo['level'] == 'SDM' || $userinfo['level'] == 'Super Admin') {?>
        <li class="nav-item">
            <a class="nav-link" href="/" p>
                <i class="fa fa-home menu-icon"></i>
                <span class="menu-title">Dashboard SDM</span>
            </a>
        </li>
        <?php }?>


        <?php if ($userinfo['level'] == 'SDM' || $userinfo['level'] == 'Super Admin' || $userinfo['level'] == 'Auditor') {?>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#page-layouts" aria-expanded="false"
                aria-controls="page-layouts">
                <i class="far fa-id-card menu-icon"></i>
                <span class="menu-title">Modul SDM</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page-layouts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="/sdm/master">Master
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/sdm/resign">Resign</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/sdm/phk">PHK
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/sdm/absensi">Absensi
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <?php }?>

        <?php if ($userinfo['level'] == 'Admin Operasional' || $userinfo['level'] == 'Super Admin') {?>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#page-operasional" aria-expanded="false"
                aria-controls="page-layouts">
                <i class="far fa-id-card menu-icon"></i>
                <span class="menu-title">Modul Operasional</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page-operasional">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="/op/master_product">Master Product
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/op/delivery_order">Surat Jalan Operasional</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Laporan Upload</a>
                    </li>
                </ul>
            </div>
        </li>
        <?php }?>

        <?php if ($userinfo['level'] == 'Auditor' || $userinfo['level'] == 'Super Admin' || $userinfo['level'] == 'Gudang Pusat') {?>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#page-warehouse-unit" aria-expanded="false"
                aria-controls="page-layouts">
                <i class="far fa-id-card menu-icon"></i>
                <span class="menu-title">Modul Gudang Unit</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page-warehouse-unit">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Master Items
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Request</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Barang Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Barang Keluar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Report</a>
                    </li>
                </ul>
            </div>
        </li>
        <?php }?>

        <?php if ($userinfo['level'] == 'Admin Warehouse 2' || $userinfo['level'] == 'Super Admin') {?>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#page-operasional" aria-expanded="false"
                aria-controls="page-layouts">
                <i class="far fa-id-card menu-icon"></i>
                <span class="menu-title">Modul Gudang</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="page-operasional">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="/op/gd/items">Informasi Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/op/gd/deliver">Barang Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/op/gd/out">Barang Keluar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/op/gd/refresh">Penyesuaian Stok</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/op/gd/request">Request Permintaan</a>
                    </li>
                </ul>
            </div>
        </li>
        <?php }?>
    </ul>
</nav>