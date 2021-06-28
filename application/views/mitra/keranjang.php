<div class="container">
	<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-5">
	        <div class="card-header py-3">
	            <h6 class="m-0 font-weight-bold text-primary">Alamat Pengiriman</h6>
	        </div>
	        <div class="card-body">
            	<div class="row">
            		<div class="col-md-6">
            			<div class="mb-3">
						    <label class="form-label">Nama Lengkap</label>
						    <input type="text" class="form-control" name="nama_pelanggan" value="<?php echo $pelanggan->nama_pelanggan ?>">
						</div>
						<div class="mb-3">
						    <label class="form-label">No. Telephone (WhatsApp)</label>
						    <input type="text" class="form-control" name="no_hp" value="<?php echo $pelanggan->no_hp ?>">
						</div>
						<div class="mb-3">
						    <label class="form-label">Catatan</label>
						    <textarea class="form-control" name="catatan"></textarea>
						</div>
						<input type="text" name="kode_transaksi" value="<?php echo $kode_transaksi ?>">
            		</div>
            		<div class="col-md-6">
            			<div class="mb-3">
						    <label class="form-label">Alamat Lengkap</label>
						    <textarea class="form-control" name="alamat"><?php echo $pelanggan->alamat ?></textarea>
						</div>
						<div class="mb-3">
						    <label class="form-label">Provinsi</label>
						    <select class="form-control" name="provinsi" id="form_prov" name="provinsi">
						    	<?php foreach ($provinsi as $provinsi) { ?>
						    	<option value="<?php echo $provinsi->kode ?>"<?php if($pelanggan->provinsi==$provinsi->nama){ echo "selected"; } ?>>
                         <?php echo $provinsi->nama ?></option>
						    	<?php } ?>
						    </select>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
								    <label class="form-label">Kabupaten</label>
								    <select class="form-control" id="form_kab" name="kabupaten">
								    	<option><?php echo $pelanggan->kabupaten ?></option>
								    </select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
								    <label class="form-label">Kecamatan</label>
								    <select class="form-control" id="form_kec" name="kecamatan">
								    	<option><?php echo $pelanggan->kecamatan ?></option>
								    </select>
								</div>
							</div>
						</div>
            		</div>
            	</div>
	        </div>
	    </div>
	</div>
</div>
</div>
<!--  -->
<div class="container">
	<div class="row">
	<div class="col-lg-12">
		<div class="card shadow mb-5">
	        <div class="card-header py-3">
	            <h6 class="m-0 font-weight-bold text-primary">Pesanan Anda</h6>
	        </div>
	        <div class="card-body">
	        	<table class="table">
					<thead>
						<tr>
							<th style="vertical-align: middle;">PRODUK</th>
							<th style="vertical-align: middle;">HARGA</th>
							<th style="vertical-align: middle;">JUMLAH</th>
							<th style="vertical-align: middle;">SUBTOTAL</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php 
						foreach ($keranjang as $keranjang) {
							//form update
							$rowid	= $keranjang['rowid'];
							echo form_open(base_url('mitra/update_cart'));
							?>
						<tr>
							<td style=""><?php echo $keranjang['nama'] ?></td>
							<td style="vertical-align: middle;">Rp. <?php echo number_format($keranjang['price'],'0',',','.') ?></td>
							<td style="vertical-align: middle;">
								<input class="form-control" type="number" value="<?php echo $keranjang['qty'] ?>" name="<?php echo $i ?>[qty]" style="width: 100px;">
							</td>
							<td>
								Rp. 
								<?php 
								$sub_total = ($keranjang['price'] * $keranjang['qty']);
								echo number_format($sub_total,'0',',','.');
								 ?>
							</td>
						</tr>
						<?php $i++; ?>
					<?php } ?>
					<tr>
						<td></td>
						<td colspan="3" style="text-align: right;">
							<a href="<?php echo base_url('mitra/belanja') ?>" type="submit" class="btn btn-primary">Lanjutkan Belanja</a>
							<button type="submit" class="btn btn-primary">Update Keranjang</button>
							<?php echo form_close(); ?></td>
						<?php 
		                  echo form_open(base_url('mitra/checkout'));
		                ?>
		                <td>
							<button type="submit" class="btn btn-primary">Lanjutkan Checkout</button>
							<?php echo form_close(); ?>
						</td>
					</tr>
					
					</tbody>
				</table>
	        </div>
	    </div>
	</div>
</div>
</div>

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