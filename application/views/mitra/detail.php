<?php 
//format tanggal
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
 <style type="text/css">
 	td,th{
 		color: #121212;
 	}
 </style>
<div class="container">
	 <div class="row">
	 	<div class="col-lg-7">
	 		<!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Order</h6>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
			          <tbody>
			          	<tr>
			          		<td width="40%">Kode Transaksi</td>
			          		<th><?php echo $detail_order->kode_transaksi ?></th>
			          	</tr>
			          	<tr>
			          		<td width="40%">Tanggal Transaksi</td>
			          		<th><?php echo tanggal_indo(date('Y-m-d',strtotime($detail_order->tanggal_transaksi)),true); ?></th>
			          	</tr>
			          	<tr>
			          		<td width="40%">Jumlah Item</td>
			          		<th><?php echo $detail_order->total_item ?></th>
			          	</tr>
			          	<tr>
			          		<td width="40%">Ekspedisi</td>
			          		<th><?php echo $detail_order->expedisi ?></th>
			          	</tr>
			          	<tr>
			          		<td width="40%">Ongkos Kirim</td>
			          		<th>Rp. <?php echo number_format($detail_order->ongkir,'0',',','.') ?></th>
			          	</tr>
			          	<tr>
			          		<td width="40%">Total Bayar</td>
			          		<th>Rp. <?php echo number_format($detail_order->total_bayar,'0',',','.') ?></th>
			          	</tr>
			          	<tr>
			          		<td width="40%">Status Pembayaran</td>
			          		<th><?php $status = $detail_order->status_bayar;
			               if($status==0){
			          			echo "Belum Bayar";
			              }else if($status==2){
			                echo "Menunggu Konfirmasi";
			          		}else{
			          			echo "Sudah Bayar";
			          		} ?></th>
			          	</tr>
			            <tr>
			              <td width="40%">Rekening Pembayaran</td>
			              <th><?php echo $detail_order->nama_bank ?> - <?php echo $detail_order->no_rekening ?></th>
			            </tr>
			          </tbody>
			        </table>
                </div>
            </div>
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Penerima</h6>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
			        	<thead>
			        		<tr>
			        			<th></th>
			        			<th>Produk</th>
			        			<th>Jml Beli</th>
			        			<th>Harga Satuan</th>
			        		</tr>
			        	</thead>
			          <tbody>
			          	<?php foreach ($transaksi as $transaksi) { ?>
			          	<tr>
			          		<td><img src="<?php echo base_url('assets/img/produk/'.$transaksi->gambar) ?>" class="img img-responsive img-thumbnail" width="60"></td>
			          		<?php if($transaksi->harga==0){ ?>
			          			<td>Bonus</td>
			          		<?php }else{ ?>
			          		<td><?php echo $transaksi->nama_produk ?></td>
			          		<?php } ?>
			          		<td><?php echo $transaksi->jml_beli ?></td>
			          		<td>Rp. <?php echo number_format($transaksi->harga,'0',',','.') ?></td>
			          	</tr>
			          <?php } ?>
			          </tbody>
			        </table>
                </div>
            </div>
	 	</div>
	 	<div class="col-lg-5">
	 		<!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Penerima</h6>
                </div>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
			          <tbody>
			          	<tr>
			          		<td width="40%">Nama Penerima</td>
			          		<th><?php echo $detail_order->nama_pelanggan ?></th>
			          	</tr>
			          	<tr>
			          		<td width="40%">No. Hp</td>
			          		<th><?php echo $detail_order->no_hp ?></th>
			          	</tr>
			          	<tr>
			          		<td width="40%">Alamat</td>
			          		<th><?php echo $detail_order->alamat ?></th>
			          	</tr>
			            <tr>
			              <td width="40%">Kabupaten</td>
			              <th><?php echo $detail_order->kabupaten ?></th>
			            </tr>
			            <tr>
			              <td width="40%">Provinsi</td>
			              <th><?php echo $detail_order->provinsi ?></th>
			            </tr>
			          </tbody>
			        </table>
                </div>
            </div>
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pembayaran</h6>
                </div>
                <div class="card-body">
                	<?php if($detail_order->status_bayar==0){ ?>
                    <div class="alert alert-success alert-dismissible">
			            Belum Ada Pembayaran, segera lakukan pembayaran terlebih dahulu dan lakukan konfirmasi via WA berikut
			        </div>
			        <div class="col-md-5">
		              <a href="https://wa.me/6281335005334" type="button" class="btn btn-block btn-success" target="_blank"><i class="fab fa-whatsapp"></i> Konfirmasi</a>
		            </div>
			    <?php }else{ ?>
			    	<table id="example1" class="table table-bordered table-striped">
          <tbody>
          	<tr>
          		<td width="40%">Transfer</td>
          		<th>Rp. <?php echo number_format($bayar->jumlah_bayar,'0',',','.') ?></th>
          	</tr>
          	<tr>
          		<td width="40%">Tanggal</td>
          		<th><?php echo tanggal_indo(date('Y-m-d',strtotime($bayar->tanggal_bayar)),true); ?></th>
          	</tr>
          	<tr>
          		<td width="40%">Transfer ke</td>
          		<th><?php echo $bayar->bank ?> a.n <?php echo $bayar->nama_pemilik ?> (<?php echo $bayar->rekening ?>)</th>
          	</tr>
          	<tr>
          		<td width="40%">Transfer Dari</td>
          		<th><?php echo $bayar->nama_bank ?>
          	</tr>
          </tbody>
        </table>
			    <?php } ?>
                </div>
            </div>
	 	</div>
	 </div>
</div>