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
<!-- untuk format hari -->
<?php
function tanggal_indo($tanggal, $cetak_hari = false)
    {
      $hari = array ( 1 =>    'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
          );
          
      $bulan = array (1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
          );
      $split    = explode('-', $tanggal);
      $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
      
      if ($cetak_hari) {
        $num = date('N', strtotime($tanggal));
        return $hari[$num] . ', ' . $tgl_indo;
      }
      return $tgl_indo;
    }
 ?>

<!-- SECTION DETAIL BELANJA-->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-6">
				<h3>RINCIAN PESANAN</h3>
				<table class="table">
					<thead>
						<tr>
							<th colspan="3">PRODUK</th>
							<th style="text-align: right;">SUBTOTAL</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($transaksi as $transaksi) { 
							if($transaksi->harga != 0){
						?>
						<tr>
							<?php 
							if($transaksi->status==2){ ?>
							<td colspan="3" style="vertical-align: middle;"><?php echo $transaksi->nama_produk ?></td>
						<?php }else{ ?>
							<td colspan="3" style="vertical-align: middle;"><?php echo $transaksi->nama ?></td>
						<?php } ?>
							<td style="vertical-align: middle; text-align: right;"><?php echo 'Rp. '.number_format($transaksi->total_harga,'0',',','.') ?></td>
						</tr>
					<?php } }?>
						<tr>
							<th colspan="3">Total:</th>
							<th style="vertical-align: middle; text-align: right;"><?php echo 'Rp. '.number_format($detail->total_transaksi,'0',',','.') ?></th>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-md-6 order-details">
				<p style="color: #008000;">Terima Kasih Pesanan Anda Telah Diterima.</p>
				<table class="table">
					<tbody>
						<tr>
							<td colspan="3" style="vertical-align: middle;">Kode Transaksi : <strong><?php echo $detail->kode_transaksi ?></strong></td>
						</tr>
						<tr>
							<td colspan="3" style="vertical-align: middle;">Tanggal Transaksi : <strong><?php echo tanggal_indo(date('Y-m-d',strtotime($detail->tanggal_transaksi)),true); ?></strong></td>
						</tr>
						<tr>
							<td colspan="3" style="vertical-align: middle;">Total Item : <strong><?php echo $detail->total_item ?> Barang</strong></td>
						</tr>
						<tr>
							<td colspan="3" style="vertical-align: middle;">Total Transaksi : <strong><?php echo 'Rp. '.number_format($detail->total_transaksi,'0',',','.') ?></strong></td>
						</tr>
						<tr>
							<td colspan="3" style="vertical-align: middle;">Metode Pembayaran : 
								<strong><?php if($detail->metode_pembayaran ==1){
			                          echo "Transfer Bank";
			                        }else{
			                          echo "Cash Order Delivery (COD)";
			                        }
			                    ?></strong>
							</td>
						</tr>
						<tr>
							<th colspan="4"></th>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>