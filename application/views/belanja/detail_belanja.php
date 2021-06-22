<style type="text/css">
	.table th{
		color: #777777;
	}
	.table img{
		height: 120px;
		width: 120px;
	}
	.btn-back{
		display: inline-block;
		padding: 12px 30px;
		background-color: #FFF;
		border: solid;
		border-width: 2px;
		border-color: #50AB34;
		color: #50AB34;
		text-transform: uppercase;
		font-weight: 700;
		text-align: center;
		-webkit-transition: 0.2s all;
		transition: 0.2s all;
	}
	.btn-back:hover{
		display: inline-block;
		padding: 12px 30px;
		background-color: #50AB34;
		border: solid;
		border-width: 2px;
		color: #FFF;
		text-transform: uppercase;
		font-weight: 700;
		text-align: center;
		-webkit-transition: 0.2s all;
		transition: 0.2s all;
	}
	.btn-update{
		display: inline-block;
		padding: 12px 30px;
		background-color: #50AB34;
		border: solid;
		border-width: 2px;
		color: #FFF;
		text-transform: uppercase;
		font-weight: 700;
		text-align: center;
		-webkit-transition: 0.2s all;
		transition: 0.2s all;
	}
	.btn-update:hover{
	  opacity: 0.9;
	  color: #FFF;
	}
	.icon{
		color: #777777;
		font-size: 20px;
	}
	.kosong{
		margin-top: 30px;
	}
	.kosong p{
		display: flex;
  		justify-content: center;
  		font-size: 20px;
	}
	.kosong span{
		display: block;
		text-align: center;
	}
</style>
<!-- SECTION DETAIL BELANJA-->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<?php 
			//kalau ga ada data belanjaan
			if(empty($keranjang)){ ?>
				<div class="kosong">
					<p>Keranjang Belanja Anda Saat ini Masih Kosong</p>
					<span><a href="<?php echo base_url() ?>" class="btn btn-update">KEMBALI KE TOKO</a></span>
				</div>
				
			<?php }else{ ?>

			<div class="col-md-7">
				<table class="table">
					<thead>
						<tr>
							<th colspan="3">PRODUK</th>
							<th>HARGA</th>
							<th>JUMLAH</th>
							<th>SUBTOTAL</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php 
						foreach ($keranjang as $keranjang) {
							//form update
							$rowid	= $keranjang['rowid'];
							echo form_open(base_url('belanja/update_cart'));
							//echo form_hidden('rowid', $rowid);
							?>
						<tr>
							<td style="vertical-align: middle;"><a href="<?php echo base_url('belanja/hapus/'.$keranjang['rowid']) ?>"><i class="fa fa-times-circle icon"></i></a></td>
							<td><img src="<?php echo base_url('assets/img/produk/'.$keranjang['gambar']) ?>"></td>
							<td style="vertical-align: middle;"><?php echo $keranjang['name'] ?></td>
							<td style="vertical-align: middle;">Rp. <?php echo number_format($keranjang['price'],'0',',','.') ?></td>
							<td style="vertical-align: middle;">
								<div class="input-number" style="width: 100px;">
									<input type="number" name="<?php echo $i ?>[qty]" style="text-align: center;" value="<?php echo $keranjang['qty'] ?>">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</td>
							<td style="vertical-align: middle;">
								Rp. 
								<?php 
								$sub_total = ($keranjang['price'] * $keranjang['qty']);
								echo number_format($sub_total,'0',',','.');
								 ?>
							</td>
						</tr>
						<?php $i++; ?>
					<?php
						} 
					?>
					<tr>
						<td colspan="3" style="text-align: right;"><a href="<?php echo base_url() ?>" class="btn btn-back">Lanjutkan Belanja</a></td>
						<td colspan="3"><button class="btn btn-update">Update Keranjang</button></td>
					</tr>
					<?php echo form_close(); ?>
					</tbody>
				</table>
			</div>
			<div class="col-md-5 order-details">
				<table class="table">
					<thead>
						<tr>
							<th colspan="4">TOTAL KERANJANG BELANJA</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th colspan="3" style="vertical-align: middle;">Total Belanja</th>
							<td style="vertical-align: middle; text-align: right;">
								<?php echo 'Rp. '.number_format($this->cart->total(), '0',',','.'); ?>
							</td>
						</tr>
						<tr>
							<th colspan="4"></th>
						</tr>
					</tbody>
				</table>
				<a href="<?php echo base_url('belanja/checkout') ?>" class="btn btn-update">LANJUT KE CHECKOUT</a>
			</div>
		<?php } ?>
		</div>
	</div>
</div>