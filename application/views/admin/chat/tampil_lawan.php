<?php if($id=='group'){ ?>
<div class="avatar-lawan" id="group">
  <img class="avatar-icon" src="<?php echo base_url() ?>assets/chat/gambar/default/user.png">
  <span class="ml-2 mt-5">Kilat Office</span>
</div>
<?php }else{ ?>
<div class="avatar-lawan" id="<?php echo $id ?>">
  <img class="avatar-icon" src="<?php echo base_url() ?>assets/chat/gambar/default/user.png">
  <span class="ml-2 mt-5"><?php echo $marketing->nama_marketing ?></span>
</div>
<?php } ?>
