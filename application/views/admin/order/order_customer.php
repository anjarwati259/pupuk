<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title">Data Order Customer</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <br>
    <div class="scrollmenu">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>Kode Invoice</th>
          <th>Marketing</th>
          <th>Nama</th>
          <th>No. HP</th>
          <th>Tanggal</th>
          <th>Jumlah Item</th>
          <th>Jumlah Belanja</th>
          <th>Status</th>
          <th>Action</th>
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
              $i=1;
          foreach ($order as $order) { ?>
          <tr>
            <td><?php echo $i ?></td>
            <td><a href="<?php echo base_url('admin/order/detail/'.$order->kode_transaksi) ?>"><?php echo $order->kode_transaksi ?></a></td>
            <td><?php echo $order->nama_marketing ?></td>
            <td><?php echo $order->nama_pelanggan ?></td>
            <td><?php echo $order->no_hp ?></td>
            <td><?php echo tanggal_indo(date('Y-m-d',strtotime($order->tanggal_transaksi)),FALSE); ?></td>
            <td><?php echo $order->total_item ?></td>
            <td>Rp. <?php echo number_format($order->total_bayar,'0',',','.') ?></td> 
            <td><?php if($order->status_bayar==0 && $order->metode_pembayaran ==1){
                  echo "<span class='alert-warning'>Transfer Bank</span>";
                }else if($order->status_bayar==0 && $order->metode_pembayaran ==2){
                  echo "<span class='alert-success'>Cash</span>";
                }else{
                  echo "<span class='alert-danger'>COD</span>";
                }
             ?></td>
             <td>
              <?php if($order->metode_pembayaran ==1){ ?>
               <?php include('konfirmasi.php') ?>
             <?php }else if($order->metode_pembayaran ==2){ ?>
              <a href="<?php echo base_url('admin/order/cash/'.$order->kode_transaksi) ?>" class="btn btn-success btn-xs">
                <i class="fa fa-check"></i> Konfirmasi
              </button>
            <?php }else{ ?>
               <?php include('konfirmasi_cod.php') ?>
            <?php } ?>
            <a href="<?php echo base_url('admin/order/edit/'.$order->kode_transaksi) ?>" class="btn btn-info btn-xs"><i class="fa fa-print" target="_blank"></i> Edit</a>
            <a href="<?php echo base_url('admin/order/hapus/'.$order->kode_transaksi) ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" ><i class="fa fa-trash-o" aria-hidden="true"></i> Hapus</a>
             </td>
          </tr>
        <?php $i++; } ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->