<!-- admin -->
<?php if($this->session->userdata('hak_akses')=='1'){ ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url() ?>assets/img/logo/logo_2.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('nama_user'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"></li>
        <li class="active">
          <a href="<?php echo base_url('admin/dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <!-- customer -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-group"></i>
            <span>Master Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('admin/pelanggan/customer') ?>"><i class="fa fa-user"></i> Data Customer</a></li>
            <li><a href="<?php echo base_url('admin/pelanggan/mitra') ?>"><i class="fa fa-users"></i> Data Mitra</a></li>
            <li><a href="<?php echo base_url('admin/pelanggan/distributor') ?>"><i class="fa fa-users"></i> Data Distributor</a></li>
          </ul>
        </li>
        <!-- Stok -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cubes"></i>
            <span>Stok</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('admin/order/stok_awal') ?>"><i class="fa fa-users"></i> Data Stok</a></li>
            <li><a href="<?php echo base_url('admin/order/stok') ?>"><i class="fa fa-plus-square-o"></i> Riwayat Stok</a></li>
          </ul>
        </li>
        <!-- Order -->
        <li>
          <a href="<?php echo base_url('admin/order') ?>">
            <i class="fa fa-cart-plus"></i>
            <span>Order</span>
          </a>
        </li>
        <!-- laporan Order -->
        <li>
          <a href="<?php echo base_url('admin/order/laporan') ?>">
            <i class="fa fa-file" aria-hidden="true"></i>
            <span>Laporan Penjualan</span>
          </a>
        </li>
        <!-- reward -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-gift"></i>
            <span>Reward</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('admin/dashboard/reward') ?>"><i class="fa fa-bitcoin"></i> Data Point</a></li>
            <li><a href="<?php echo base_url('admin/dashboard/pencairan_reward') ?>"><i class="fa fa-plus-square-o"></i> Pencairan Reward</a></li>
          </ul>
        </li>
        <!-- setting -->
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs" aria-hidden="true"></i>
            <span>Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('admin/dashboard/follow_up') ?>"><i class="fa fa-paper-plane" aria-hidden="true"></i> Follow UP</a></li>
          </ul>
        </li> -->

        <!-- pengguna -->
        <!-- <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Pengguna</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('admin/user') ?>"><i class="fa fa-users"></i> Data Pengguna</a></li>
            <li><a href="<?php echo base_url('admin/user/tambah_user') ?>"><i class="fa fa-plus-square-o"></i> Tambah Pengguna</a></li>
          </ul>
        </li> -->
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title; ?>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
<!-- end admin -->
<?php }else if($this->session->userdata('hak_akses')=='5'){ ?>
<!-- marketing -->
<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url() ?>assets/img/logo/logo_2.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('nama_user'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header"></li>
        <li class="active">
          <a href="<?php echo base_url('marketing') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <!-- customer -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-group"></i>
            <span>Master Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('admin/pelanggan/customer') ?>"><i class="fa fa-user"></i> Data Customer</a></li>
            <li><a href="<?php echo base_url('admin/pelanggan/mitra') ?>"><i class="fa fa-users"></i> Data Mitra</a></li>
            <li><a href="<?php echo base_url('admin/pelanggan/distributor') ?>"><i class="fa fa-users"></i> Data Distributor</a></li>
          </ul>
        </li>
        <!-- Order -->
        <li>
          <a href="<?php echo base_url('marketing/order') ?>">
            <i class="fa fa-cart-plus"></i>
            <span>Order</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title; ?>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
<!-- End marketing -->
<?php } ?>