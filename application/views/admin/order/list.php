<div class="row">
  <div class="col-md-12">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li><a href="<?php echo site_url('admin/order/tambah_order');?>">Tambah Order</a></li>
        <li class="active"><a href="#tab_1" data-toggle="tab">Belum Bayar</a></li>
        <li><a href="<?php echo site_url('admin/order/sudah_bayar');?>">Sudah Bayar</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
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
                 ?>
                 <td>
                  <?php if($order->metode_pembayaran ==1){ ?>
                   <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#konfirmasi<?= $order->kode_transaksi?>">
                    <i class="fa fa-check"></i> Konfirmasi
                  </button>
                <?php }else{ ?>
                  <button class="btn btn-success btn-xs" data-toggle="modal" data-target="#cod<?php echo $order->kode_transaksi?>"><i class="fa fa-check"></i> Konfirmasi</button>
                <?php } ?>
                 </td>
                   
                 </td>
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

<!-- modal konfirmasi transfer bank -->
<?php foreach ($konfirmasi as $order) { ?>
<div class="modal fade" id="konfirmasi<?php echo$order->kode_transaksi?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Order #<strong><?php echo $order->kode_transaksi ?></strong></h4>
      </div>
      <div class="modal-body">
        <?php echo form_open(base_url('admin/order/konfirmasi/'.$order->kode_transaksi)); ?>
        <form role="form">
          <div class="box-body">
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                   <label >Nama Bank</label>
                    <input type="text" name="nama_bank" placeholder="Bank BRI" class="form-control">
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Tanggal Bayar</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="tanggal_bayar" class="form-control pull-right" id="datepicker" value="<?php echo date("Y-m-d") ?>">
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                   <label >Ongkos Kirim</label>
                    <div class="input-group">
                      <span class="input-group-addon prc">Rp</span>
                      <input type="number" value="<?php echo $order->ongkir ?>" name="ongkir" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                   <label >Jumlah Transfer</label>
                    <div class="input-group">
                      <span class="input-group-addon prc">Rp</span>
                      <input type="number" name="total_bayar" value="<?php echo $order->total_bayar ?>" class="form-control">
                    </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Transfer Ke</label>
                    <br>
                    <div class="form-group">
                      <label>
                        <input type="radio" name="id_rekening" class="flat-red" value="2" checked>
                        Bank BCA
                      </label>
                      <label>
                        <input type="radio" name="id_rekening" class="flat-red" value="1">
                        Bank Mandiri
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Konfirmasi</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php } ?>

<!-- modal COD -->
<?php foreach ($konfirmasi as $order) { ?>
<div class="modal fade" id="cod<?php echo$order->kode_transaksi?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Order #<strong><?php echo $order->kode_transaksi ?></strong></h4>
      </div>
      <div class="modal-body">
        <?php echo form_open(base_url('admin/order/cod/'.$order->kode_transaksi)); ?>
        <form role="form">
          <div class="box-body">
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                   <label >No Resi</label>
                    <input type="text" name="no_resi" placeholder="No Resi" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Tanggal Bayar</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="tanggal_bayar" class="form-control pull-right" id="datepicker" value="<?php echo date("Y-m-d") ?>">
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-md-6">
                  <!-- potongan COD -->
                  <?php 
                  $total_bayar = (int) round(($order->total_bayar * 3)/100);
                  $total = $order->total_bayar + $total_bayar;
                   ?>
                   <label >Jumlah Transfer</label>
                    <div class="input-group">
                      <span class="input-group-addon">Rp</span>
                      <input type="text"  value="<?php echo number_format($total,'0',',','.') ?>" class="form-control">
                      <input type="hidden" name="total_bayar" value="<?php echo $total ?>" class="form-control">
                    </div>
                </div>
                
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Konfirmasi</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php } ?>