<style type="text/css">
  .label_filter{
    width: 50px;
  }
  .filter{
    width: 200px;
  }
  @media screen and (max-width: 640px) {
    .filter{
      margin-left: auto;
      margin-right: auto;
      top: 0px;
      width: 250px;
    }
    })
</style>
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
        <div class="tab-pane active scrollmenu" id="tab_1">
          <div class="filter_group" style="display: flex; margin-top: 20px; margin-bottom: 20px;">
              <!-- filter -->
              <div class="form-group" style="padding-right: 20px; display: flex;">
                <label class="control-label label_filter">Filter : </label>
                <div class="filter">
                  <select class="form-control" id="filter" name="filter">
                    <option value="">Semua</option>
                    <option value="Customer">Customer</option>
                    <option value="Mitra">Mitra</option>
                  </select>
                </div>
              </div>
            </div>
          <table id="example" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Kode Invoice</th>
              <th>Marketing</th>
              <th>Nama</th>
              <th>No. HP</th>
              <th>Tanggal</th>
              <th>Jumlah <br>Item</th>
              <th>Jumlah <br>Belanja</th>
              <th>Status</th>
              <th>Action</th>
              <th style="display: none;">Action</th>
            </tr>
            </thead>
            <tbody>
              <?php 
                  $i=1;
              foreach ($order as $order) { ?>
              <tr>
                <td><?php echo $i ?></td>
                <td><a href="<?php echo base_url('admin/order/detail/'.$order->kode_transaksi) ?>"><?php echo $order->kode_transaksi ?></a></td>
                <td><?php echo $order->nama_marketing ?></td>
                <td><?php echo $order->nama_pelanggan ?></td>
                <td><?php echo $order->no_hp ?></td>
                <td><?php echo tanggal(date('Y-m-d',strtotime($order->tanggal_transaksi)),FALSE); ?></td>
                <td><?php echo $order->total_item ?></td>
                <td>Rp. <?php echo number_format($order->total_bayar,'0',',','.') ?></td> 
                <td><?php if($order->status_bayar==0 && $order->metode_pembayaran ==1){
                      echo "<span class='alert-warning'>Transfer</span>";
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
                 <td style="display: none;"><?php echo $order->jenis_pelanggan ?></td>
              </tr>
            <?php $i++; } ?>
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