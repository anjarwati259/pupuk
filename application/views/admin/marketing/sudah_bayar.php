<!-- START CUSTOM TABS -->
<div class="row">
  <div class="col-md-12">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li><a href="<?php echo site_url('marketing/order');?>">Tambah Order</a></li>
      <li role="presentation"><a href="<?php echo site_url('marketing/belum_bayar');?>">Belum Bayar</a></li>
      <li role="presentation" class="active"><a href="<?php echo site_url('marketing/sudah_bayar');?>">Sudah Bayar</a></li>
      </ul>
      <?php
      //notifikasi
      if($this->session->flashdata('sukses')){
        echo '<p class="alert alert-success">';
        echo $this->session->flashdata('sukses');
        echo '</div>';
       }
       ?>
      <div class="tab-content">
        <!-- /.tab-pane -->
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
                <th>Jumlah Bayar</th>
                <th>Status</th>
              </tr>
              </thead>
              <tbody>
                <?php
                $j = 1;
                foreach ($sudah_bayar as $sudah_bayar) { ?>
                    <tr>
                      <td><a href="<?php echo base_url('admin/order/detail/'.$sudah_bayar->kode_transaksi) ?>"><?php echo $sudah_bayar->kode_transaksi ?></a></td>
                      <td><?php echo $sudah_bayar->nama_pelanggan ?></td>
                      <td><?php echo $sudah_bayar->no_hp ?></td>
                      <td><?php echo tanggal(date('Y-m-d',strtotime($sudah_bayar->tanggal_transaksi)),FALSE); ?></td>
                      <td><?php echo $sudah_bayar->total_item ?></td>
                      <td>Rp. <?php echo number_format($sudah_bayar->total_bayar,'0',',','.') ?></td>
                      <td>Rp. <?php echo number_format($sudah_bayar->jumlah_bayar,'0',',','.') ?></td>
                      <td><?php if($sudah_bayar->status_bayar==1 && $sudah_bayar->metode_pembayaran ==1){
                          echo "<span class='alert-success'>Transfer Bank</span>";
                        }else{
                          echo "<span class='alert-success'>COD</span>";
                        }
                    ?></td>
                    </tr>
              <?php } ?>
              </tbody>
            </table>
          <!-- /.box -->
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
<!-- END CUSTOM TABS -->
