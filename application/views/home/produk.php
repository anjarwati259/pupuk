<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- ASIDE -->
			<div id="aside" class="col-md-3">
				<!-- aside Widget -->
				<div class="aside">
					<h3 class="aside-title">Produk</h3>
					<div class="checkbox-filter">

						<div class="input-checkbox">
							<label for="category-1">
								<span></span>
								<a href="<?php echo base_url('home/detail/'.'POC') ?>">Pupuk Kilat 1 Liter</a>
							</label>
						</div>

						<div class="input-checkbox">
							<label for="category-2">
								<span></span>
								<a href="<?php echo base_url('home/detail/'.'POC500') ?>">Pupuk Kilat 500 ml</a>
							</label>
						</div>

						<div class="input-checkbox">
							<label for="category-3">
								<span></span>
								<a href="<?php echo base_url('home/detail/'.'NUTRISITERNAK') ?>">Nutrisi Ternak</a>
							</label>
						</div>

						<div class="input-checkbox">
							<label for="category-4">
								<span></span>
								<a href="<?php echo base_url('home/detail/'.'NUTRISIIKAN') ?>">Nutrisi Ikan</a>
							</label>
						</div>

						<div class="input-checkbox">
							<label for="category-5">
								<span></span>
								<a href="#">Paket</a>
							</label>
						</div>
					</div>
				</div>
				<!-- /aside Widget -->

				<!-- aside Widget top salling -->
				<div class="aside">
					<h3 class="aside-title">Top selling</h3>
					<div class="product-widget">
						<div class="product-img">
							<img src="<?php echo base_url('assets/img/produk/'.'POC-5.jpg') ?>" alt="">
						</div>
						<div class="product-body">
							<h3 class="product-name"><a href="<?php echo base_url('home/detail_promo/'.'6') ?>">PAKET 5 POC 1 LITER</a></h3>
							<h4 class="product-price">Rp.850.000</h4>
						</div>
					</div>

					<div class="product-widget">
						<div class="product-img">
							<img src="<?php echo base_url('assets/img/produk/'.'POC.jpg') ?>" alt="">
						</div>
						<div class="product-body">
							<h3 class="product-name"><a href="<?php echo base_url('home/detail/'.'POC') ?>">PUPUK KILAT 1L</a></h3>
							<h4 class="product-price">Rp.170.000</h4>
						</div>
					</div>

					<div class="product-widget">
						<div class="product-img">
							<img src="<?php echo base_url('assets/img/produk/'.'ternak.jpg') ?>" alt="">
						</div>
						<div class="product-body">
							<h3 class="product-name"><a href="<?php echo base_url('home/detail/'.'NUTRISITERNAK') ?>">NUTRISI TERNAK</a></h3>
							<h4 class="product-price">Rp.110.000</h4>
						</div>
					</div>
				</div>
				<!-- /aside Widget -->
			</div>
			<!-- /ASIDE -->

			<!-- STORE -->
			<div id="store" class="col-md-9">
				<!-- store products -->
				<div class="row">
					<!-- product -->
					<?php foreach ($produk as $produk) { ?>
						<?php 
							//form untuk memproses belanjaan
							echo form_open(base_url('belanja/add')); 
							//elemen yang dibawa
							echo form_hidden('id', $produk->kode_produk);
							echo form_hidden('id_produk', $produk->kode_produk);
							echo form_hidden('id_promo', null);
							echo form_hidden('qty', 1);
							echo form_hidden('price', $produk->harga_customer);
							echo form_hidden('name', $produk->nama_produk);
							echo form_hidden('gambar', $produk->gambar);
							echo form_hidden('option', 2);
							//elemen redirect
							echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
							?>
					<div class="col-md-4 col-xs-6">
						<div class="product">
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
									<button href="#" class="add-to-compare"><i class="fa fa-shopping-cart"></i><span class="tooltipp">add to cart</span></button>
									<a href="<?php echo base_url('home/detail/'.$produk->kode_produk) ?>" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">detail</span></a>
										</div>
							</div>
						</div>
					</div>
					<?php echo form_close(); ?>
					<?php } ?>
					<!-- /product -->

					<!-- promo -->
					<?php foreach ($promo as $promo) { ?>
						<?php 
							//form untuk memproses belanjaan
							echo form_open(base_url('belanja/add')); 
							//elemen yang dibawa
							echo form_hidden('id', $promo->id_promo);
							echo form_hidden('id_promo', $promo->id_promo);
							echo form_hidden('id_produk', null);
							echo form_hidden('qty', 1);
							echo form_hidden('price', $promo->harga);
							echo form_hidden('name', $promo->nama_promo);
							echo form_hidden('gambar', $promo->gambar);
							echo form_hidden('option', 1);
							//elemen redirect
							echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
							?>
					<div class="col-md-4 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="<?php echo base_url('assets/img/produk/'.$promo->gambar) ?>" alt="">
							</div>
							<div class="product-body">
								<h3 class="product-name"><a href="<?php echo base_url('home/detail_promo/'.$promo->id_promo) ?>"><?php echo $promo->nama_promo ?></a></a></h3>
								<h4 class="product-price">Rp. <?php echo number_format($promo->harga,'0',',','.') ?></h4>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
								<div class="product-btns">
									<button href="#" class="add-to-compare"><i class="fa fa-shopping-cart"></i><span class="tooltipp">add to cart</span></button>
									<a href="<?php echo base_url('home/detail_promo/'.$promo->id_promo) ?>" class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></a></div>
							</div>
						</div>
					</div>
					<?php echo form_close(); ?>
					<?php } ?>
					<!-- /promo -->
				</div>
				<!-- /store products -->
			</div>
			<!-- /STORE -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->