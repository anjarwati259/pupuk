<a type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#modal-default"><i class="fa fa-unlock-alt" aria-hidden="true"></i>Ubah Password</a>

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
          <input type="password" id="pass_baru" name="pass_baru" class="form-control" value="<?php echo set_value('pass_baru') ?>" placeholder="Masukkan Password Baru">
          <div id="msg1"></div>
        </div>
        <div class="form-group">
          <label>Ulangi Password</label>
          <input type="password" id="rep_pass" name="rep_pass" class="form-control" value="<?php echo set_value('rep_pass') ?>" placeholder="Ulangi Password Baru">
          <div id="msg"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a id="coba" href="<?php //echo base_url('admin/dashboard/change_password') ?>" type="button" class="btn btn-primary">Ubah Password</a>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $('#pass_baru, #rep_pass').on('keyup', function () {
    if ($('#pass_baru').val() == $('#rep_pass').val()) {
      $('#msg').html('Password Matching').css('color', 'green');
    } else {
      $('#msg').html('Password Not Matching').css('color', 'red');
    }
  });
  $('#pass_baru').on('keyup', function () {
    var pass_baru = $('#pass_baru').val();
    if(pass_baru.length() > 3){
      $('#msg1').html('Password Minimal 3 Karakter').css('color', 'red');
    }
  });
</script>