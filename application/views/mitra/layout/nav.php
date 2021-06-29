<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <?php 
                //check data belanjaan ada atau tidak
                $keranjang = $this->cart->contents();
                ?>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter"><?php echo $this->cart->total_items();?></span>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                    Message Center
                </h6> 
                <?php 
                    //kalau ga ada data belanjaan
                    if(empty($keranjang)){ ?>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="alert alert-success" role="alert">
                              Keranjang Belanja Anda Masih Kosong
                        </div>
                    </a>
                <?php }else{ ?>
                <?php  foreach ($keranjang as $keranjang) { ?>
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="dropdown-list-image mr-3">
                        <img class="rounded-circle" src="<?php echo base_url('assets/img/produk/'.$keranjang['gambar']) ?>"
                            alt="...">
                    </div>
                    <div class="font-weight-bold">
                        <div class="text-truncate"><?php echo $keranjang['nama'] ?> X <?php echo $keranjang['qty'] ?></div>
                        <div class="small text-gray-500">Total Rp.<?php echo number_format(($keranjang['price'] * $keranjang['qty']),'0',',','.')?></div>
                    </div>
                </a>
            <?php } ?>
        <?php } ?>
                <a class="dropdown-item text-center" style="font-size: 20px; background-color: #4E73DF; color: #fff" href="<?php echo base_url('mitra/view_cart') ?>">Checkout</a>
            </div>
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $this->session->userdata('username')?></span>
                <img class="img-profile rounded-circle"
                    src="<?php echo base_url() ?>assets/mitra/img/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo base_url('login/logout') ?>">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->