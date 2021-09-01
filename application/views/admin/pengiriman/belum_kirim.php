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
        <li class="active"><a href="#tab_1" data-toggle="tab">Belum Dikirim</a></li>
        <li><a href="<?php echo site_url('pengiriman/sudah_dikirim');?>">Sudah Dikirim</a></li>
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
          <table id="example" class="table table-bordered table-striped">
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
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
              <?php $no=1; foreach ($belum_kirim as $belum_kirim) { ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo tanggal(date('Y-m-d',strtotime($belum_kirim->tanggal_transaksi)),FALSE) ?></td>
                <td><a href="<?php echo base_url('admin/order/detail/'.$belum_kirim->kode_transaksi) ?>"><?php echo $belum_kirim->kode_transaksi ?></a></td>
                <td><?php echo $belum_kirim->nama_marketing ?></td>
                <td><?php echo $belum_kirim->nama_pelanggan ?></td>
                <td><?php echo $belum_kirim->no_hp ?></td>
                <td><?php echo $belum_kirim->expedisi ?></td>
                <td><?php echo $belum_kirim->total_item ?></td>
                <td>
                  <?php if($belum_kirim->metode_pembayaran==0){
                    echo "<span class='alert-danger'>COD</span>";
                  }else if($belum_kirim->metode_pembayaran==1){
                    echo "<span class='alert-warning'>Transfer Bank</span>";
                  }else{
                    echo "<span class='alert-success'>Cash</span>";
                  } ?>
                </td>
                <td>
                  <div class="input-group-btn">
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Action
                      <span class="fa fa-caret-down"></span></button>
                    <ul class="dropdown-menu">
                      <li><a href="#" class="edit_button"
                        data-toggle="modal" data-target="#myModal"
                        data-id="<?php echo $belum_kirim->kode_transaksi; ?>"
                        data-nama="<?php echo $belum_kirim->nama_pelanggan; ?>"
                        data-kab="<?php echo $belum_kirim->kabupaten; ?>"
                        data-resi="<?php echo $belum_kirim->no_resi; ?>">
                      Input Resi</a></li>
                      <li><a href="#" class="follow_button"
                        data-toggle="modal" data-target="#follow"
                        data-id="<?php echo $belum_kirim->kode_transaksi; ?>"
                        data-nama="<?php echo $belum_kirim->nama_pelanggan; ?>"
                        data-kab="<?php echo $belum_kirim->kabupaten; ?>"
                        data-resi="<?php echo $belum_kirim->no_resi; ?>">Follow Up</a></li>
                    </ul>
                  </div>
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

<!-- input resi -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #F0F8FF;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><label id="nama"></label> <label>-</label> <label id="kab"></label></h4>
        </div>
        <div class="modal-body">
          <?php echo form_open(base_url('pengiriman/input_resi')); ?>
          <form role="form">
            <div class="box-body">
              <div class="form-group">
                <label style="text-align: center; display: block;">Nomor Resi Pengiriman</label>
                <input type="text" name="no_resi" id="no_resi" class="form-control" placeholder="No Resi">
                <input type="hidden" name="kode_transaksi" id="kode_transaksi">
                <!-- /.input group -->
              </div>
            </div>

            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right">Save</button>
            </div>
          </form>
          <?php echo form_close() ?>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
  </div>

  <!-- follow up -->
  <div class="modal fade" id="follow">
    <div class="modal-dialog" style="width: 400px;">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #F0F8FF;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><label>Clossing</label></h4>
        </div>
        <div class="modal-body">
          <?php echo form_open(base_url('pengiriman/input_resi')); ?>
          <form role="form">
            <div class="box-body">
              <label style="margin-bottom: 20px;">Nama : <label id="nama_pelanggan"></label></label>
              <div class="form-group">
                <label>Nomor Resi Pengiriman</label>
                <input type="text" name="no_resi" id="no_resi" class="form-control" placeholder="No Resi">
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <label>Nomor Resi Pengiriman</label>
                <textarea class="form-control" style="height: 180px;"></textarea>
                <!-- /.input group -->
              </div>
            </div>

            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right">Save</button>
            </div>
          </form>
          <?php echo form_close() ?>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <script type="text/javascript">
    $(document).on( "click", '.edit_button',function(e) {
      var id = $(this).data('id');
      var nama = $(this).data('nama');
      var kab = $(this).data('kab');
      var resi = $(this).data('resi');
      //alert(resi);
      $("#nama").text(nama);
      $("#kab").text(kab);
      $("#kode_transaksi").val(id);
      $("#no_resi").val(resi); 
    });
    $(document).on( "click", '.follow_button',function(e) {
      var id = $(this).data('id');
      var nama = $(this).data('nama');
      var kab = $(this).data('kab');
      var resi = $(this).data('resi');
      //alert(resi);
      $("#nama").text(nama);
      $("#kab").text(kab);
      $("#kode_transaksi").val(id);
      $("#no_resi").val(resi); 
    });
  </script>