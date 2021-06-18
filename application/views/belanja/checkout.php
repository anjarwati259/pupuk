<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">

			<div class="col-md-7">
				<!-- Billing Details -->
				<div class="billing-details">
					<div class="section-title">
						<h3 class="title">Alamat Pengiriman</h3>
					</div>
					<?php 
                  echo form_open(base_url('belanja/checkout'));
                  
                  //$kode_transaksi = date('dmY').strtoupper(random_string('alnum',8));
                  ?>
					<div class="form-group">
						<label>Nama Lengkap</label>
						<input class="input" type="text" name="nama_pelanggan" value="<?php echo $pelanggan->nama_pelanggan ?>">
					</div>
					<div class="form-group">
						<label>No Telephone (WhatsApp)</label>
						<input class="input" type="number" name="no_telp" value="<?php echo $pelanggan->no_hp ?>">
					</div>
					<div class="order-notes">
						<label>Alamat Lengkap</label>
						<textarea class="input" name="alamat"><?php echo $pelanggan->alamat ?></textarea>
					</div>
					<div class="form-group">
						<label>Provinsi</label>
						<select class="form-control input-select" name="provinsi" id="form_prov">
						<?php foreach ($provinsi as $provinsi) { ?>
                            <option value="<?php echo $provinsi->kode ?>"<?php if($pelanggan->provinsi==$provinsi->nama){ echo "selected"; } ?>>
                             <?php echo $provinsi->nama ?>
                            </option>
						<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label>Kabupaten/Kota</label>
						<select class="form-control input-select" name="kabupaten" id="form_kab">
							<option></option>
						</select>
					</div>
					<div class="form-group">
						<label>Kecamatan</label>
						<select class="form-control input-select" name="kecamatan" id="form_kec">
							<option></option>
						</select>
					</div>
				</div>
				<!-- /Billing Details -->
				<div class="section-title">
					<h4 class="title">Informasi Tambahan</h4>
				</div>
				<div class="caption">
					<p>Catatan Pesanan (Optional)</p>
				</div>
				<!-- Order notes -->
				<div class="order-notes">
					<textarea class="input" name="catatan" placeholder="Catatan Pesanan"></textarea>
				</div>
				<!-- /Order notes -->
			</div>

			<!-- Order Details -->
			<div class="col-md-5 order-details">
				<div class="section-title text-center">
					<h3 class="title">Pesanan Anda</h3>
				</div>
				<!-- daftar pesanan/chart -->
				<table class="table">
					<thead>
						<tr>
							<th colspan="4" style="vertical-align: middle; color: #777777;">PRODUK</th>
							<th colspan="1" style="vertical-align: middle; text-align: right; color: #777777;">SUBTOTAL</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$total_item = 0;
						foreach ($keranjang as $keranjang) { 
							$total_item = $total_item + $keranjang['qty'];
							?>
						<tr>
							<td colspan="4" style="vertical-align: middle;color: #777777; font-weight: 500;"><?php echo $keranjang['name'] ?> x<?php echo $keranjang['qty'] ?></td>
							<td colspan="2" style="vertical-align: middle;text-align: right; font-weight: 500;"><?php echo 'Rp. '.number_format($keranjang['price'] * $keranjang['qty'], '0',',','.'); ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<!-- end -->
				<div class="payment-method">
					<div class="input-radio">
						<input type="radio" value="1" class="form-control" name="payment" id="payment-1">
						<label for="payment-1">
							<span></span>
							Transfer Bank
						</label>
						<div class="caption">
							<p>Pembayaran dapat Melalui Rekening Perusahaan BCA atau Mandiri, Lebih Lengkapnya akan Disampaikan Saat Proses Verifikasi Melalui WhatsApp</p>
						</div>
					</div>
					<div class="input-radio">
						<input type="radio" class="form-control" name="payment" value="0" id="payment-2" value="1">
						<label for="payment-2">
							<span></span>
							Cash Order Deliery (COD)
						</label>
						<div class="caption">
							<p>Pembayaran Melalui COD akan dilakukan saat barang telah sampai serta akan dikenai biaya tambahan sebesar 3% dari total belanja</p>
						</div>
					</div>
				</div>
			  <input type="hidden" name="kode_transaksi" class="form-control" value="<?php echo $kode_transaksi ?>">
              <input type="hidden" name="total_transaksi" value="<?php echo $this->cart->total() ?>">
              <input type="hidden" name="tanggal_transaksi" value="<?php echo date('Y-m-d'); ?>">
              <input type="hidden" name="total_item" value="<?php echo $total_item ?>">
              <input type="hidden" name="kab" id="kab">
              <input type="hidden" name="kec" id="kec">
              <input type="hidden" name="prov" id="prov">
				<button class="primary-btn order-submit">BUAT PESANAN</button>
			</div>
			<?php echo form_close(); ?>
			<!-- /Order Details -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION-->
<script type="text/javascript">
  $(document).ready(function(){

      // ambil data kabupaten ketika data memilih provinsi
      $('body').on("change","#form_prov",function(){
        var id = $(this).val();
        var data = "id="+id+"&data=kabupaten";
        $.ajax({
          type: 'POST',
          url: "<?php echo base_url('wilayah/get_wilayah'); ?>",
          data: data,
          success: function(hasil) {
             $("#form_kab").html(hasil);
            //alert("sukses");
          }
        });
      });

      // ambil data kecamatan/kota ketika data memilih kabupaten
      $('body').on("change","#form_kab",function(){
        var id = $(this).val();
        var data = "id="+id+"&data=kecamatan";
        $.ajax({
          type: 'POST',
          url: "<?php echo base_url('wilayah/get_wilayah'); ?>",
          data: data,
          success: function(hasil) {
            $("#form_kec").html(hasil);
          }
        });
      });

       //get provinsi
      $('body').on("change","#form_prov",function(){
        var id=$(this).val();
        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('wilayah/getprov'); ?>",
            dataType : "JSON",
            data : {id: id},
            cache:false,
            success: function(data){
                $.each(data,function(nama){
                    $('[name="prov"]').val(data.nama);
                     
                });
                 
            }
        });
        return false; 
      });

      //get kabupaten
    $('body').on("change","#form_kab",function(){
        var datakab = $("option:selected", this).attr('datakab');
          $("input[name=kab]").val(datakab);
      });
    //get kecamatan
    $('body').on("change","#form_kec",function(){
        var datakec = $("option:selected", this).attr('datakec');
          $("input[name=kec]").val(datakec); 
      });
    });
</script>