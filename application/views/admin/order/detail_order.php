<!-- Main content -->
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
 <?php if($this->session->flashdata('sukses')){
    echo '<div class="alert alert-warning">';
    echo $this->session->flashdata('sukses');
    echo '</div>';
  } ?>
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-7">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><strong>Data Order</strong></h3>
        </div>
        <table id="example1" class="table table-bordered table-striped">
          <tbody>
          	<tr>
          		<td width="40%">Kode Invoice</td>
          		<th><?php echo $detail_order->kode_transaksi ?></th>
          	</tr>
            <tr>
              <td width="40%">Marketing</td>
              <th><?php echo $detail_order->nama_marketing ?></th>
            </tr>
          	<tr>
          		<td width="40%">Tanggal Transaksi</td>
          		<th><strong><?php echo tanggal_indo(date('Y-m-d',strtotime($detail_order->tanggal_transaksi)),true); ?></strong></th>
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
              <td width="40%">No Resi</td>
              <th><?php if($detail_order->no_resi !=null){
                echo $detail_order->no_resi;
              } else{
                echo "-";
              }
              ?>
              </th>
            </tr>
          	<tr>
          		<td width="40%">Status</td>
          		<th><?php $status = $detail_order->status_bayar;
               if($status==0){
          			echo "Belum Bayar";
              }else{
                echo "Sudah Bayar";
          		} ?></th>
          	</tr>
          </tbody>
        </table>
      </div>

      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><strong>Barang Dalam Pesanan</strong></h3>
        </div>
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
          		<td><?php echo $transaksi->nama_produk ?></td>
          		<td><?php echo $transaksi->jml_beli ?></td>
          		<td>Rp. <?php echo number_format($transaksi->harga,'0',',','.') ?></td>
          	</tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="col-md-5">
      <!-- Horizontal Form -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><strong>Data Penerima</strong></h3>
        </div>
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

      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><strong>Pembayaran</strong></h3>
        </div>
        <?php if($detail_order->status_bayar==0){ ?>
          <br>
          <div class="alert alert-success alert-dismissible">
            Belum Ada Pembayaran
          </div>
          <br>
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
          		<th>
                <?php if($bayar->nama_bank == null){
                  echo '-';
                }else{ 
                  echo $bayar->nama_bank; 
                } ?></th>
          	</tr>
          </tbody>
        </table>
      <div class="row">
        <div class="col-sm-9">
          <?php echo form_open(base_url('admin/order/resi/'.$detail_order->kode_transaksi)); ?>
          <div class="input-group">
            <!-- /btn-group -->
            <input type="text" name="no_resi" placeholder="No Resi" value="<?php echo $detail_order->no_resi ?>" class="form-control">
            <div class="input-group-btn">
              <button type="submit" class="btn btn-success">Kirim</button>
            </div>
          </div>
          <?php form_close(); ?>
        </div>
        <div class="col-sm-3">
          <a href="<?php echo base_url('admin/order/print/'.$detail_order->kode_transaksi) ?>" class="btn btn-info"><i class="fa fa-print" target="_blank"></i> Print</a>
        </div>
      </div>
        <br>
        <?php }?>

      <!-- /.box -->
    </div>
    <!--/.col (right) -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->