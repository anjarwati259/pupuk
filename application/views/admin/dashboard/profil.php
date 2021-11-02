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
      <?php 
        $id_user = $this->session->userdata('id_user');
        $this->db->select('*');
        $this->db->from('tb_marketing');
        $this->db->where('id_user', $this->session->userdata('id_user')); 
        $getfoto= $this->db->get()->row();  ?>
      <img id="file-ip-1-preview" class="img-circle" src="<?php echo base_url() ?>assets/img/team/<?php echo $getfoto->foto ?>" alt="User Avatar">
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
          <?php include "change_password.php" ?>
          <div style="padding-top: 5px;"></div>
          <button type="submit" id="submit" class="btn btn-block btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan Perubahan</button>
        </div>
      </div>
    </div>
    <!-- /.box-body -->
  </div>
</div>
<?php if($this->session->flashdata('sukses')) { ?>
  <script type="text/javascript">
    var pesan = '<?php echo $this->session->flashdata('sukses') ?>'
    toastr.success(pesan);
  </script>
<?php }else if($this->session->flashdata('error')){ ?>
  <script type="text/javascript">
    var pesan = '<?php echo $this->session->flashdata('error') ?>'
    toastr.error(pesan);
  </script>
<?php }; ?>
<script type="text/javascript">
  function showPreview(event){
    if(event.target.files.length > 0 ){
      var src = URL.createObjectURL(event.target.files[0]);
      var preview = document.getElementById("file-ip-1-preview");
      preview.src = src;
      preview.style.display = "block";
    }
  }
</script>