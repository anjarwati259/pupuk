<!-- SECTION PRODUK-->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- shop -->
			<div class="col-md-4 col-xs-6">
				<div class="shop">
					<div class="shop-img">
						<img src="<?php echo base_url() ?>assets/img/produk/POC.jpg" alt="">
					</div>
					<div class="shop-body">
						<h3>Pupuk<br>Kilat</h3>
						<a href="<?php echo base_url('home/detail/'.'POC') ?>" class="cta-btn">Belanja Sekarang <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
			<!-- /shop -->

			<!-- shop -->
			<div class="col-md-4 col-xs-6">
				<div class="shop">
					<div class="shop-img">
						<img src="<?php echo base_url() ?>assets/img/produk/ikan.jpg" alt="">
					</div>
					<div class="shop-body">
						<h3>Nutrisi <br>Ikan</h3>
						<a href="<?php echo base_url('home/detail/'.'NUTRISIIKAN') ?>" class="cta-btn">Belanja Sekarang <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
			<!-- /shop -->

			<!-- shop -->
			<div class="col-md-4 col-xs-6">
				<div class="shop">
					<div class="shop-img">
						<img src="<?php echo base_url() ?>assets/img/produk/ternak.jpg" alt="">
					</div>
					<div class="shop-body">
						<h3>Nutrisi <br>Ternak</h3>
						<a href="<?php echo base_url('home/detail/'.'NUTRISITERNAK') ?>" class="cta-btn">Belanja Sekarang <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
			<!-- /shop -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->
<!-- SECTION PRODUK-->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">Promo dan Paket Kilat</h3>
				</div>
			</div>
			<!-- /section title -->

			<!-- Products tab & slick -->
			<div class="col-md-12">
				<div class="row">
					<div class="products-tabs">
						<!-- tab -->
						<div id="tab2" class="tab-pane fade in active">
							<div class="products-slick" data-nav="#slick-nav-2">
								<!-- product -->
								<?php foreach ($promo as $promo) { ?>
								<div class="product">
									<?php 
							//form untuk memproses belanjaan
							echo form_open(base_url('belanja/add')); 
							//elemen yang dibawa
							echo form_hidden('id', $promo->id_promo);
							echo form_hidden('id_produk', $promo->kode_produk);
							echo form_hidden('id_promo', $promo->id_promo);
							echo form_hidden('qty', 1);
							echo form_hidden('jumlah', $promo->jumlah);
							echo form_hidden('bonus', $promo->bonus);
							echo form_hidden('price', $promo->harga);
							echo form_hidden('name', $promo->nama_promo);
							echo form_hidden('gambar', $promo->gambar);
							echo form_hidden('option', 2);
							//elemen redirect
							echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
							?>
									<div class="product-img">
										<img src="<?php echo base_url('assets/img/produk/'.$promo->gambar) ?>" alt="">
									</div>
									<div class="product-body">
										<h3 class="product-name"><a href="<?php echo base_url('home/detail/'.$promo->kode_produk) ?>"><?php echo $promo->nama_promo ?></a></h3>
										<h4 class="product-price">Rp. <?php echo number_format($promo->harga,'0',',','.') ?></h4>
										<div class="product-rating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
										<div class="product-btns">
											<button class="add-to-compare"><i class="fa fa-shopping-cart"></i><span class="tooltipp">add to cart</span></button>
											<a href="<?php echo base_url('home/detail/'.$promo->kode_produk) ?>" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Detail</span></a>
										</div>
									</div>
									<?php echo form_close(); ?>
								</div>
								<?php } ?>
								<!-- /product -->
							</div>
							<div id="slick-nav-2" class="products-slick-nav"></div>
						</div>
						<!-- /tab -->
					</div>
				</div>
			</div>
			<!-- /Products tab & slick -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

<!-- HOT DEAL SECTION -->

<!-- /HOT DEAL SECTION -->

<!-- SECTION PRODUK-->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h3 class="title">Produk Kilat</h3>
				</div>
			</div>
			<!-- /section title -->

			<!-- Products tab & slick -->
			<div class="col-md-12">
				<div class="row">
					<div class="products-tabs">
						<!-- tab -->
						<div id="tab2" class="tab-pane fade in active">
							<div class="products-slick" data-nav="#slick-nav-2">
								<!-- product -->
								<?php foreach ($produk as $produk) { ?>
								<div class="product">
									<?php 
							//form untuk memproses belanjaan
							echo form_open(base_url('belanja/add')); 
							//elemen yang dibawa
							echo form_hidden('id', $produk->kode_produk);
							echo form_hidden('id_produk', $produk->kode_produk);
							echo form_hidden('id_promo', null);
							echo form_hidden('qty', 1);
							echo form_hidden('jumlah', null);
							echo form_hidden('bonus', null);
							echo form_hidden('price', $produk->harga_customer);
							echo form_hidden('name', $produk->nama_produk);
							echo form_hidden('gambar', $produk->gambar);
							echo form_hidden('option', 2);
							//elemen redirect
							echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
							?>
									<div class="product-img">
										<img src="<?php echo base_url('assets/img/produk/'.$produk->gambar) ?>" alt="">
									</div>
									<div class="product-body">
										<h3 class="product-name"><a href="<?php echo base_url('home/detail/'.$produk->kode_produk) ?>"><?php echo $produk->nama_produk ?></a></h3>
										<h4 class="product-price">Rp. <?php echo number_format($produk->harga_customer,'0',',','.') ?></h4>
										<div class="product-rating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
										</div>
										<div class="product-btns">
											<button class="add-to-compare"><i class="fa fa-shopping-cart"></i><span class="tooltipp">add to cart</span></button>
											<a href="<?php echo base_url('home/detail/'.$produk->kode_produk) ?>" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Detail</span></a>
										</div>
									</div>
									<?php echo form_close(); ?>
								</div>
								<?php } ?>
								<!-- /product -->
							</div>
							<div id="slick-nav-2" class="products-slick-nav"></div>
						</div>
						<!-- /tab -->
					</div>
				</div>
			</div>
			<!-- /Products tab & slick -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->