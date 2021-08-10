
<button id="follow" class="btn btn-info" style="border-radius: 50%;" data-toggle="modal" data-target="#follow<?= $sudah_bayar->kode_transaksi?>" type="button" role="button">1</button>

<div class="modal fade" id="follow<?= $sudah_bayar->kode_transaksi?>">
  <div class="modal-dialog" style="max-width: 450px;">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #F0F8FF;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">&nbsp; <strong>Welcome <?php echo $i ?></strong></h4>
      </div> 
      <div class="modal-body">
        <!-- <?php echo form_open('admin/order/follow_up') ?> -->
        <div class="form-group">
          <label>Nama :&nbsp; <?php echo $sudah_bayar->nama_pelanggan ?></label>
        </div>
        <?php 
        $nohp = $sudah_bayar->no_hp;
        $hp = preg_replace("/[^0-9]/", "", $nohp);
        $no = substr($hp,0,1);
        $a = substr($hp,1);
        
        if($no == '0'){
          $no_hp = '62'.$a;
        }else{
          $no_hp = $hp;
        } 

        $text = $welcome->text;
        $text = str_replace('{', '<?php echo $sudah_bayar->', $text);
        $text = str_replace('}', '?>', $text);
        $coba = "welcome";
        $php  = 'echo $sudah_bayar->nama_pelanggan';
        ?>
        <div class="form-group">
          <label>No Handphone (WhatsApp)</label>
          <input type="text" name="no_hp" class="form-control" value="<?php echo $no_hp ?>" placeholder="Masukkan Password Lama Anda" required>
        </div>
        <div class="form-group">
          <label>Text</label>
          <textarea style="height: 100px; white-space: pre-line;" name="text_wa" id="text_wa" placeholder="Isikan Text" class="form-control text"/></textarea>
          <textarea style="white-space: pre-line;" name="text_wa" id="text_wa1" placeholder="Isikan Text" class="form-control text"/><?php echo $welcome->text ?></textarea>
          <input type="text" name="url" id="url">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button class="btn btn-info">Follow Up</button>
      </div>
      <!-- <?php echo form_close() ?> -->
    </div>
  </div>
</div>

<script type="text/javascript">
  var text = $("#text_wa1").val();
  $('#text_wa').val('text');
  //alert(text);
</script>

<!-- <script type="text/javascript">
  function visitPage(){
    $(document).ready(function () {
       var message = $("#txtArea").val();
       alert(message);
    });
  }
$(function(){
  //ongkir
    var url = function(){
      $('.text').each(function(){
        var text = $("#text_wa").val();
        $("#url").val(text);
      });
    }

    $('.text').keyup(function(){
      url();
    });
  });
</script> -->