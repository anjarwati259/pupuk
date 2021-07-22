<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- Product main img -->
			<div class="col-md-5 col-md-push-2">
				<div id="product-main-img">
					<div class="product-preview">
						<img src="<?php echo base_url('assets/img/produk/'.$gambar->gambar) ?>" alt="">
					</div>
				</div>
			</div>
			<!-- /Product main img -->

			<!-- Product thumb imgs -->
			<div class="col-md-2  col-md-pull-5">

			</div>
			<!-- /Product thumb imgs -->

			<!-- Product details -->
			<div class="col-md-5">
				<?php foreach ($produk as $produk) { ?>
				<div class="product-details">
					<?php 
							//form untuk memproses belanjaan
							echo form_open(base_url('belanja/add')); 
							//elemen yang dibawa
							echo form_hidden('id', $produk->kode_produk);
							//echo form_hidden('qty', 1);
							echo form_hidden('price', $produk->harga_customer);
							echo form_hidden('name', $produk->nama_produk);
							echo form_hidden('gambar', $produk->gambar);
							echo form_hidden('option', 2);
							//elemen redirect
							echo form_hidden('redirect_page', str_replace('index.php/', '', current_url()));
							?>
					<h2 class="product-name"><?php echo $produk->nama_produk ?></h2>
					<div>
						<div class="product-rating">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star-o"></i>
						</div>
						<a class="review-link" href="#">10 Review(s) | Add your review</a>
					</div>
					<div>
						<h3 class="product-price">Rp. <?php echo number_format($produk->harga_customer,'0',',','.') ?></h3>
						<span class="product-available">In Stock</span>
					</div>

					<div class="add-to-cart">
						<div class="qty-label">
							Qty
							<div class="input-number">
								<input type="number" value="1" name="qty">
								<span class="qty-up">+</span>
								<span class="qty-down">-</span>
							</div>
						</div>
						<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
					</div>

					<ul class="product-links">
						<li>Share:</li>
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="#"><i class="fa fa-envelope"></i></a></li>
					</ul>
					<?php echo form_close(); ?>
				</div>
				<?php } ?>
			</div>
			<!-- /Product details -->

			<!-- Product tab -->
			<div class="col-md-12">
				<div id="product-tab">
					<!-- product tab nav -->
					<ul class="tab-nav">
						<li class="active"><a data-toggle="tab" href="#tab1">Deskripsi</a></li>
					</ul>
					<!-- /product tab nav -->

					<!-- product tab content -->
					<div class="tab-content">
						<!-- tab1  -->
						<div id="tab1" class="tab-pane fade in active">
							<div class="row">
								<div class="col-md-12">
									<p><?php echo $produk->keterangan ?></p>
								</div>
							</div>
						</div>
						<!-- /tab1 -->
					</div>
					<!-- /product tab content  -->
				</div>
			</div>
			<!-- /product tab -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->
