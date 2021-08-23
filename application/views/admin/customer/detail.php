<div class="row">
  <div class="col-md-4">
    <!-- Widget: user widget style 1 -->
    <div class="box box-widget widget-user-2">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-primary">
        <div class="widget-user-image">
          <img class="img-circle" src="<?php echo base_url() ?>assets/img/logo/logo_2.png" alt="User Avatar">
        </div>
        <!-- /.widget-user-image -->
        <h3 class="widget-user-username" style="padding-top: 12px; padding-bottom: 10px;"><?php echo $pelanggan->nama_pelanggan ?></h3>
      </div>
      <div class="box-footer no-padding">
        <ul class="nav nav-stacked">
          <li><a href="#"><b>No. HP</b> <br><span><?php echo $pelanggan->no_hp ?></span></a></li>
          <li><a href="#"><b>Alamat</b> <br><span><?php echo $pelanggan->alamat ?></span></a></li>
          <li><a href="#"><b>Provinsi</b> <br><span><?php echo $pelanggan->provinsi ?></span></a></li>
          <li><a href="#"><b>Kabupaten/Kota</b> <br><span><?php echo $pelanggan->kabupaten ?></span></a></li>
          <li><a href="#"><b>Kecamatan</b> <br><span><?php echo $pelanggan->kecamatan ?></span></a></li>
          <li><a href="#"><b>Marketing</b> <br><span><?php echo $pelanggan->nama_marketing ?></span></a></li>
          <li><a href="#"><b>Last Contact</b> <br><span><?php echo $pelanggan->last_update ?></span></a></li>
        </ul>
      </div>
    </div>
    <!-- /.widget-user -->
  </div>
  <!-- /.col -->

  <div class="col-md-8">
    <!-- DIRECT CHAT PRIMARY -->
    <div class="box box-primary direct-chat direct-chat-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Follow Up</h3>
      </div>
      <!-- /.box-header -->
      <!-- <?php echo form_open(base_url('admin/pelanggan/follow')); ?> -->
      <div class="box-body">
        <div class="group" style="padding: 10px;">
          <div class="form-group">
            <label for="exampleInputEmail1">No WhatsApp</label>
            <input type="text" class="form-control" value="<?php echo $pelanggan->no_hp ?>" id="no_hp">
          </div>
          <div class="form-group">
            <label>Follow Up Text</label>
            <textarea style="height: 190px;" class="form-control" rows="3" placeholder="Enter ..." id="text-follow"></textarea>
          </div>
        </div>
      </div>
      <input type="text" name="id_Pelanggan" id="id_pelanggan" value="<?php echo $pelanggan->id ?>">
      <input type="text" name="id_marketing" id="id_marketing" value="<?php echo $pelanggan->id_marketing ?>">
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" id="btn-submit" class="btn btn-primary pull-right"><i class="fa fa-paper-plane"></i> &nbsp;&nbsp;Kirim</button>
      </div>
      <!-- /.box-footer-->
    </div>
    <!--/.direct-chat -->
  </div>
  <!-- /.col -->
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#btn-submit').on('click', function() {
      var id_Pelanggan = $('#id_pelanggan').val();
      var id_marketing = $('#id_marketing').val();
      var no_hp = $('#no_hp').val();
      var text = $('#text-follow').val();
      var url = encodeURI(text);
      alert(url);
      // $.ajax({
      //   url: "<?php echo base_url('admin/pelanggan/follow') ?>",
      //   type: "POST",
      //   data: {
      //     id_pelanggan: id_Pelanggan,
      //     id_marketing: id_marketing,
      //     status: 1,     
      //   },
      //   cache: false,
      //   success: function(dataResult){
      //     var dataResult = JSON.parse(dataResult);
      //     if(dataResult.statusCode==200){
      //       alert('sukses');          
      //     }
      //     else{
      //        alert("Error occured !");
      //     }
          
      //   }
      // });

    });
  });
</script>