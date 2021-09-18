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
        <i class="fa fa-chevron-down" aria-hidden="true"></i>
        <div style="white-space:pre-wrap;">
          <?php echo $chat->chat ?>
        </div>
        <div class="pesan-waktu">
          <small>
            12:00
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
      <div class="dropdown ml-auto" style="float: right;">
        <div class="dropdown-toggle" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="tre" aria-expanded="flse">
        </div>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton2">
          <a class="dropdown-item" href="#" id="tarik" data-toggle="modal" data-target="#staticBackdrop">Tarik Pesan</a>
        </div>
      </div>
      <!-- <div class="icon-action" style="float: right;">
        <i class="fa fa-chevron-down" aria-hidden="true"></i>
      </div> -->
      <div class="media-body">
        <div style="white-space:pre-wrap;">
          <?php echo $chat->chat ?>
        </div>
        
        <div class="pesan-waktu">
          <small>
            12:00
          </small>
        </div>
      </div>
    </div>
  </div>
<?php }} ?>
</div>