<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +6281 335 005 334</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> support@ptagi.co.id</a></li>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
									<img src="<?php echo base_url() ?>assets/img/logo/logo.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>
									<select class="input-select">
										<option value="0">All</option>
										<option value="1">Promo</option>
										<option value="1">Pupuk</option>
									</select>
									<input class="input" placeholder="Search here">
									<button class="search-btn">Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- login -->
								<?php if(($this->session->userdata('username')) && ($this->session->userdata('hak_akses')=='4')){ ?>
									<div>
									<a href="<?php echo base_url('login/logout') ?>">
										<i class="fa fa-user"></i>
										<span><?php echo $this->session->userdata('username')?></span>
									</a>
								</div>
								<?php }else{ ?>
								<div>
									<a href="<?php echo base_url('login') ?>">
										<i class="fa fa-lock"></i>
										<span>Login</span>
									</a>
								</div>
								<?php } ?>
								<!-- /login -->

								<!-- Cart -->
								<div class="dropdown">
									<?php 
									//check data belanjaan ada atau tidak
									$keranjang = $this->cart->contents();
									?>
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty"><?php echo $this->cart->total_items();?></div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
											<?php 
											//kalau ga ada data belanjaan
											if(empty($keranjang)){ ?>
												<div class="product-widget">
													<p class="alert alert-success">Keranjang Belanja Kosong</p>
												</div>
											<?php 
											//kalau ada
										}else{ 
											foreach ($keranjang as $keranjang) {
											?>
											<div class="product-widget">
												<div class="product-img">
													<img src="<?php echo base_url('assets/img/produk/'.$keranjang['gambar']) ?>" alt=""> 
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#"><?php echo $keranjang['name'] ?></a></h3>
													<h4 class="product-price"><span class="qty"><?php echo $keranjang['qty'] ?>x</span> Rp. <?php echo number_format($keranjang['price'],'0',',','.') ?></h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>
											<?php } } ?>
										</div>
										<?php 
											//kalau ga ada data belanjaan
											if(!empty($keranjang)){ ?>
										<div class="cart-summary">
											<h5>SUBTOTAL: <?php echo 'Rp. '.number_format($this->cart->total(), '0',',','.'); ?></h5>
										</div>
										<div class="cart-btns">
											<a href="<?php echo base_url('belanja') ?>">View Cart</a>
											<a href="<?php echo base_url('belanja/checkout') ?>">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									<?php } ?>
									</div>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->