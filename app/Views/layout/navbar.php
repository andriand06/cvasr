<header class="main-header">
    <!-- Logo -->
    <a href="/adminlte/index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>SR</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>ASR</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/adminlte/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?= $username; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="/adminlte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                            <p>
                                <?= $username; ?> - Admin
                                <small>Member since <?= $datecreated; ?></small>
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?= base_url('login/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/adminlte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= $username; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="/admin"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Pengolahan Data </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url('barang'); ?>"><i class="fa fa-circle-o"></i>Data Barang</a></li>
                    <li><a href="/adminlte/pages/layout/boxed.html"><i class="fa fa-circle-o"></i>Laporan Penjualan</a></li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-circle-o"></i>Transaksi
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/barang/penjualan"><i class="fa fa-circle-o"></i>Penjualan</a></li>
                            <li><a href="/adminlte/pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i>Pembelian</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>