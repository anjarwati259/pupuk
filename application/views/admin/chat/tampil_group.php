<div class="row">
  <?php 
  $id_user = $this->session->userdata('id_user');
  foreach ($chat as $chat) { 
    if($chat->id_user ==$id_user){
    ?>
  <div class="col-12">
    <div class="group-saya" style="float: right; padding-left: 20px;">
        <span><small><strong><?php echo $chat->nama_marketing ?></strong></small></span>
    </div>
    <div class="media pesan-item mb-2 pesan-saya">    
      <div class="media-body">
        <?php echo $chat->chat ?>
        <div class="pesan-waktu">
          <small>
            12:00
            <span class="text-primary"><i class="fa fa-check"></i></span>
          </small>
        </div>
      </div>
    </div>
  </div>
<?php }else{ ?>
  <div class="col-12">
    <div class="group-saya" style="float: left; padding-right: 20px;">
        <span><small><strong><?php echo $chat->nama_marketing ?></strong></small></span>
    </div>
    <div class="media pesan-item mb-2 pesan-teman">   
      <div class="media-body">
        <?php echo $chat->chat ?>
        <div class="pesan-waktu">
          <small>
            12:00
            <span class="text-primary"><i class="fa fa-check"></i></span>
          </small>
        </div>
      </div>
    </div>
  </div>
<?php }} ?>
</div>