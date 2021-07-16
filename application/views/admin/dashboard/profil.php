<style type="text/css">
  .form-input{
    text-align: center;
    width: 150px;
    /*padding: 20px;*/
    background: #fff;
  }
  .form-input input{
    display: none;
  }
  .form-input label{
    display: block;
    width: auto;
    height: 40px;
    line-height: 40px;
    text-align: center;
    background: #E0E0E0;
    border-radius: 5px;
  }
</style>
<div class="col-md-4">
  <div class="box box-widget widget-user">
    <div class="widget-user-header bg-aqua-active">
      
    </div>

    <div class="widget-user-image">
      <img id="file-ip-1-preview" class="img-circle" src="<?php echo base_url() ?>assets/img/logo/logo_2.png" alt="User Avatar">
    </div>
    <div class="box-footer">
      <div class="row">
        <div class="col-sm-3 border-right">
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-6 ">
          <div class="description-block">
            <h5 class="description-header"></h5>
            <span style="font-size: 20px;"><b>Melina</b></span>
          </div>
          <div class="form-input">
            <label for="file-ip-1">Upload Image</label>
            <input type="file" id="file-ip-1" class="form-control-file" accept="image/*" onchange="showPreview(event);">
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-3">
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
  </div>
</div>
<div class="col-md-8">
  <div class="box box-primary box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Profil</h3>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="row">
        <div class="col-md-6">
          <form role="form">
            <div class="box-body">
              <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control" value="<?php echo $marketing->nama_marketing ?>">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" value="<?php echo $marketing->email ?>">
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-6">
          <form role="form">
            <div class="box-body">
              <div class="form-group">
                <label>Alamat</label>
                <input type="text" class="form-control" value="<?php echo $marketing->alamat ?>">
              </div>
              <div class="form-group">
                <label>No. Hp</label>
                <input type="text" class="form-control" value="<?php echo $marketing->no_hp ?>">
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <!-- <button class="btn btn-block btn-default"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Ubah Password</button> -->
          <a type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#modal-default"><i class="fa fa-unlock-alt" aria-hidden="true"></i>
            Ubah Password
          </a>
          <button type="submit" class="btn btn-block btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan Perubahan</button>
        </div>
      </div>
    </div>
    <!-- /.box-body -->
  </div>
</div>

<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #F0F8FF;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp; <strong>Ubah Password</strong></h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Password Lama</label>
          <input type="text" name="pass_lama" class="form-control" value="<?php echo set_value('pass_lama') ?>" placeholder="Masukkan Password Lama Anda">
        </div>
        <div class="form-group">
          <label>Password Baru</label>
          <input type="text" name="pass_baru" class="form-control" value="<?php echo set_value('pass_baru') ?>" placeholder="Masukkan Password Baru">
        </div>
        <div class="form-group">
          <label>Ulangi Password</label>
          <input type="text" name="rep_pass" class="form-control" value="<?php echo set_value('rep_pass') ?>" placeholder="Ulangi Password Baru">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a href="<?php echo base_url('') ?>" type="button" class="btn btn-primary">Ubah Password</a>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function showPreview(event){
    if(event.target.files.length > 0 ){
      var src = URL.createObjectURL(event.target.files[0]);
      var preview = document.getElementById("file-ip-1-preview");
      preview.src = src;
      preview.style.display = "block";
      //alert(src);
    }
    
  }
</script>