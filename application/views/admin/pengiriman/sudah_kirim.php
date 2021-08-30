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
        <li><a href="<?php echo site_url('pengiriman/data_kirim');?>">Belum Dikirim</a></li>
        <li class="active"><a href="#tab_1" data-toggle="tab">Sudah Dikirim</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active scrollmenu" id="tab_1">
          <div class="filter_group" style="display: flex; margin-top: 20px; margin-bottom: 20px;">
              <!-- filter -->
              <!-- <div class="form-group" style="padding-right: 20px; display: flex;">
                <label class="control-label label_filter">Filter : </label>
                <div class="filter">
                  <select class="form-control" id="filter" name="filter">
                    <option value="">Semua</option>
                    <option value="Customer">Customer</option>
                    <option value="Mitra">Mitra</option>
                  </select>
                </div>
              </div> -->
            </div>
          <table id="example2" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Kode Invoice</th>
              <th>Marketing</th>
              <th>Nama</th>
              <th>No. HP</th>
              <th>Ekspedisi</th>
              <th>Jumlah<br>Item</th>
              <th>Status</th>
              <th>no_resi</th>
            </tr>
            </thead>
            <tbody>
              <?php $no=1; foreach ($sudah_kirim as $sudah_kirim) { ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo tanggal(date('Y-m-d',strtotime($sudah_kirim->tanggal_transaksi)),FALSE) ?></td>
                <td><?php echo $sudah_kirim->kode_transaksi ?></td>
                <td><?php echo $sudah_kirim->nama_marketing ?></td>
                <td><?php echo $sudah_kirim->nama_pelanggan ?></td>
                <td><?php echo $sudah_kirim->expedisi ?></td>
                <td><?php echo $sudah_kirim->no_hp ?></td>
                <td><?php echo $sudah_kirim->total_item ?></td>
                <td>
                  <?php if($sudah_kirim->metode_pembayaran==0){
                    echo "<span class='alert-danger'>COD</span>";
                  }else if($sudah_kirim->metode_pembayaran==1){
                    echo "<span class='alert-warning'>Transfer Bank</span>";
                  }else{
                    echo "<span class='alert-success'>Cash</span>";
                  } ?>
                </td>
                <td><?php echo $sudah_kirim->no_resi ?></td>
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