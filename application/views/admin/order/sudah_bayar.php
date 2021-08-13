<style type="text/css">
  .label_filter{
    width: 200px;
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
<!-- START CUSTOM TABS -->
<div class="row">
  <div class="col-md-12">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li><a href="<?php echo site_url('admin/order/tambah_order');?>">Tambah Order</a></li>
      <li role="presentation"><a href="<?php echo site_url('admin/order');?>">Belum Bayar</a></li>
      <li role="presentation" class="active"><a href="<?php echo site_url('admin/order/sudah_bayar');?>">Sudah Bayar</a></li>
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
        <div class="tab-pane active" id="tab_1">
          <div class="scrollmenu">
            <div class="filter_group" style="display: flex;">
              <!-- filter -->
              <div class="form-group" style="padding-right: 20px;">
                <label class="control-label label_filter">Filter</label>
                <div class="filter">
                  <select class="form-control" id="filter" name="filter">
                    <option value="">--Pilih--</option>
                    <option value="Customer">Customer</option>
                    <option value="Mitra">Mitra</option>
                  </select>
                </div>
              </div>
              <!-- date from -->
              <div class="form-group" style="padding-right: 20px;">
                <label class="control-label label_filter">Date From</label>
                <div class="filter">
                  <input type="text" class="form-control" name="">
                </div>
              </div>
              <!-- date End -->
              <div class="form-group" style="padding-right: 20px;">
                <label class="control-label label_filter">Date End</label>
                <div class="filter">
                  <input type="text" class="form-control" name="">
                </div>
              </div>
              <!-- button -->
              <div class="form-group">
                <label class="control-label label_filter" style="padding-top: 16px;"></label>
                <div class="button-filter">
                  <button type="submit" class="btn btn-primary">Cari</button>
                </div>
              </div>
            </div>
            <table id="example2" class="table table-bordered table-striped">
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
                <th>Jumlah Bayar</th>
                <th>Status</th>
                <th style="display: none;">Status</th>
              </tr>
              </thead>
              <tbody>
                <?php 
                    $no=1;
                foreach ($sudah_bayar as $sudah_bayar) { ?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><a href="<?php echo base_url('admin/order/detail/'.$sudah_bayar->kode_transaksi) ?>"><?php echo $sudah_bayar->kode_transaksi ?></a></td>
                      <td><?php echo $sudah_bayar->nama_marketing ?></td>
                      <td><?php echo $sudah_bayar->nama_pelanggan ?></td>
                      <td><?php echo $sudah_bayar->no_hp ?></td>
                      <td><?php echo tanggal(date('Y-m-d',strtotime($sudah_bayar->tanggal_transaksi)),FALSE); ?></td>
                      <td><?php echo $sudah_bayar->total_item ?></td>
                      <td>Rp. <?php echo number_format($sudah_bayar->total_bayar,'0',',','.') ?></td>
                      <?php if($sudah_bayar->metode_pembayaran==2){ ?>
                        <td>Rp. <?php echo number_format($sudah_bayar->total_bayar,'0',',','.') ?></td>
                      <?php }else{ ?>
                      <td>Rp. <?php echo number_format($sudah_bayar->jumlah_bayar,'0',',','.') ?></td>
                    <?php } ?>
                      <td><?php if($sudah_bayar->status_bayar==1 && $sudah_bayar->metode_pembayaran ==1){
                          echo "<span class='alert-success'>Sudah Bayar</span>";
                        }else if($sudah_bayar->status_bayar==1 && $sudah_bayar->metode_pembayaran ==2){
                          echo "<span class='alert-success'>Cash</span>";
                        }else{
                          echo "<span class='alert-success'>COD</span>";
                        }
                    ?></td>
                    <td style="display: none;"><?php echo $sudah_bayar->jenis_pelanggan ?></td>
                    </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
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
<script type="text/javascript">
  $(document).ready(function() {
      //$('#tabelData').DataTable();
      function filterData () {
        $('#example2').DataTable().search(
            $('#filter').val()
          ).draw();
    }
    $('#filter').on('change', function () {
          filterData();
      });
  });
</script>