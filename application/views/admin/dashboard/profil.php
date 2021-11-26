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
<?php 
        // Form open
  echo form_open_multipart(base_url('admin/dashboard/save_change'), ' class="form-horizontal"');
?>
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
            <span style="font-size: 20px;"><b><?php echo $this->session->userdata('nama_user'); ?></b></span>
          </div>
          <div class="form-input">
            <label for="file-ip-1">Upload Image</label>
            <input type="file" name="gambar" id="file-ip-1" class="form-control-file" accept="image/*" onchange="showPreview(event);">
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
                <input type="text" class="form-control" name="nama_marketing" value="<?php echo $marketing->nama_marketing ?>">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" value="<?php echo $marketing->email ?>">
                <input type="hidden" class="form-control" name="alamat" id="alamat" value="<?php echo $marketing->alamat ?>">
                <input type="hidden" class="form-control" name="no_hp" id="no_hp" value="<?php echo $marketing->no_hp ?>">
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-6">
          <form role="form">
            <div class="box-body">
              <div class="form-group">
                <label>Alamat</label>
                <input type="text" class="form-control" id="address" value="<?php echo $marketing->alamat ?>">
              </div>
              <div class="form-group">
                <label>No. Hp</label>
                <input type="text" class="form-control" id="hp" value="<?php echo $marketing->no_hp ?>">
              </div>
            </div>
          </form>
        </div>
      </div>
      
      <div class="row">
        <div class="col-md-6">
          <!-- <button class="btn btn-block btn-default"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Ubah Password</button> -->
          <a type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#modal-default"><i class="fa fa-unlock-alt" aria-hidden="true"></i>Ubah Password</a>
          <div style="padding-top: 5px;"></div>
          <button type="submit" id="submit" class="btn btn-block btn-success"><i class="fa fa-floppy-o"></i> Simpan Perubahan</button>
        </div>
      </div>
    </div>
    <!-- /.box-body -->
  </div>
</div>
<?php echo form_close(); ?>

<!-- modal -->
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
          <input type="text" name="pass_lama" id="pass_lama" class="form-control" value="<?php echo set_value('pass_lama') ?>" placeholder="Masukkan Password Lama Anda" required>
        </div>
        <div class="form-group">
          <label>Password Baru</label>
          <input type="password" id="pass_baru" name="pass_baru" class="form-control" value="<?php echo set_value('pass_baru') ?>" placeholder="Masukkan Password Baru" required>
          <div id="msg1"></div>
        </div>
        <div class="form-group">
          <label>Ulangi Password</label>
          <input type="password" id="rep_pass" name="rep_pass" class="form-control" value="<?php echo set_value('rep_pass') ?>" placeholder="Ulangi Password Baru" required>
          <div id="msg"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button id="btn-submit" class="btn btn-primary">Ubah Password</button>
      </div>
    </div>
  </div>
</div>
<!-- java script -->
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
  //ubah password
  $('#pass_baru, #rep_pass').on('keyup', function () {
    if ($('#pass_baru').val() == $('#rep_pass').val()) {
      $('#msg').html('Password Matching').css('color', 'green');
    } else {
      $('#msg').html('Password Not Matching').css('color', 'red');
    }
  });
  $('#pass_baru').on('keyup', function () {
    var pass_baru = $('#pass_baru').val();
    var panjang = pass_baru.length;
    if(panjang < 3){
      $('#msg1').html('Panjang Password Minimal 3').css('color', 'red');
    }else{
      $('#msg1').html('').css('color', 'red');
    }
  });
  $("body").on("click","#btn-submit",function(){
    var pass_lama = $("#pass_lama").val();
    var pass_baru = $("#pass_baru").val();
    //alert(pass_lama);
    $.ajax({
        type: 'POST',
        dataType : 'json', 
        url: "<?php echo base_url('admin/dashboard/change_password') ?>",
        data: {pass_lama:pass_lama,
              pass_baru:pass_baru
        },
        success: function(hasil) {
          if (hasil.kode == 1){
            toastr.success(hasil.sukses);
          }else{
            toastr.error(hasil.error);
          }
          $('#modal-default').modal('hide');
        }
    });
  });

  function showPreview(event){
    if(event.target.files.length > 0 ){
      var src = URL.createObjectURL(event.target.files[0]);
      var preview = document.getElementById("file-ip-1-preview");
      preview.src = src;
      preview.style.display = "block";
    }
  }
  $('#address').on('keyup', function(){
      var input = $(this).val();
      $('#alamat').val(input);
   });
  $('#hp').on('keyup', function(){
      var input = $(this).val();
      $('#no_hp').val(input);
   });
</script>