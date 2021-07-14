<div class="row">
  <div class="col-md-12">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li><a href="<?php echo site_url('marketing/order');?>">Tambah Order</a></li>
        <li class="active"><a href="#tab_1" data-toggle="tab">Belum Bayar</a></li>
        <li><a href="<?php echo site_url('marketing/sudah_bayar');?>">Sudah Bayar</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active scrollmenu" id="tab_1">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Kode Invoice</th>
              <th>Nama</th>
              <th>No. HP</th>
              <th>Tanggal</th>
              <th>Jumlah Item</th>
              <th>Jumlah Belanja</th>
              <th>Status</th>
            </tr>
            </thead>
            <tbody>
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
              foreach ($order as $order) { ?>
              <tr>
                <td><a href="<?php echo base_url('admin/order/detail/'.$order->kode_transaksi) ?>"><?php echo $order->kode_transaksi ?></a></td>
                <td><?php echo $order->nama_pelanggan ?></td>
                <td><?php echo $order->no_hp ?></td>
                <td><?php echo tanggal_indo(date('Y-m-d',strtotime($order->tanggal_transaksi)),FALSE); ?></td>
                <td><?php echo $order->total_item ?></td>
                <td>Rp. <?php echo number_format($order->total_bayar,'0',',','.') ?></td>
                <td><?php if($order->status_bayar==0 && $order->metode_pembayaran ==1){
                      echo "<span class='alert-warning'>Belum Bayar</span>";
                    }else{
                      echo "<span class='alert-danger'>COD</span>";
                    }
                 ?></td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
  </div>
  <!-- /.col -->