<div class="row">
  <?php 
  $id_user = $this->session->userdata('id_user');
  foreach ($chat as $chat) { 
    if($chat->dari ==$id_user){
    ?>
  <div class="col-12">
    <div class="media pesan-item mb-2 pesan-saya">
      <div class="media-body">
        <div style="white-space:pre-wrap;">
          <?php echo $chat->chat ?>
        </div>
        <div class="pesan-waktu">
          <small>
            <?php echo $chat->tanggal ?>
            <span class="text-primary"><i class="fa fa-check"></i></span>
          </small>
        </div>
      </div>
    </div>
  </div>
<?php }else{ ?>
  <div class="col-12">
    <div class="media pesan-item mb-2 pesan-teman">   
      <div class="media-body">
        <div style="white-space:pre-wrap;">
          <?php echo $chat->chat ?>
        </div>
        <div class="pesan-waktu">
          <small>
            <?php echo $chat->tanggal ?>
            <span class="text-primary"><i class="fa fa-check"></i></span>
          </small>
        </div>
      </div>
    </div>
  </div>
<?php }} ?>
</div>