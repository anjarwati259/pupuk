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
        <h3 class="widget-user-username" style="padding-top: 12px; padding-bottom: 10px;"><?php echo $calon->nama_calon ?></h3>
      </div>
      <div class="box-footer no-padding">
        <ul class="nav nav-stacked">
          <li><a href="#"><b>Alamat</b> <br><span><?php echo $calon->alamat ?></span></a></li>
          <li><a href="#"><b>Provinsi</b> <br><span><?php echo $calon->provinsi ?></span></a></li>
          <li><a href="#"><b>Kabupaten/Kota</b> <br><span><?php echo $calon->kabupaten ?></span></a></li>
          <li><a href="#"><b>Kecamatan</b> <br><span><?php echo $calon->kecamatan ?></span></a></li>
          <li><a href="#"><b>Marketing</b> <br><span><?php echo $calon->nama_marketing ?></span></a></li>
          <li><a href="#"><b>Last Contact</b> <br><span> <?php if($total->total==0){ echo tanggal(date('Y-m-d',strtotime($calon->tanggal)),FALSE);}else{ ?>
            <?php echo tanggal(date('Y-m-d',strtotime($last_contact->last_kontak)),FALSE); ?> <?php echo date('g:i', strtotime($last_contact->last_kontak)); }?></span></a></li>
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
      <?php 
        $nohp = $calon->no_hp;
        $hp = preg_replace("/[^0-9]/", "", $nohp);
        $no = substr($hp,0,1);
        $a = substr($hp,1);
        
        if($no == '0'){
          $no_hp = '62'.$a;
        }else{
          $no_hp = $hp;
        }
        $tgl = date('Y-m-d');
        ?>
      <div class="box-body">
        <div class="group" style="padding: 10px;">
          <div class="form-group">
            <label for="exampleInputEmail1">Tanggal</label>
            <input type="text" class="form-control" value="<?php echo tanggal(date('Y-m-d',strtotime($tgl)),FALSE); ?>" id="tanggal" readonly>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1" style="padding-right: 2%;">Follow Up Ke:</label><span class="badge bg-blue"><?php $tot = $total->total + 1;
            echo $tot ?></span>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">No WhatsApp</label>
            <input type="text" class="form-control" value="<?php echo $no_hp ?>" id="no_hp">
          </div>
          <div class="form-group">
            <label>Follow Up Text</label>
            <textarea style="height: 190px;" class="form-control" rows="3" placeholder="Enter ..." id="text-follow"></textarea>
          </div>
        </div>
      </div>

      <input type="hidden" name="id_calon" id="id_calon" value="<?php echo $calon->id_calon ?>">
      <?php
       if($this->session->userdata('hak_akses')=='1'){ 
        $id_user = $this->session->userdata('id_user');
        $this->db->select('id_marketing');
        $this->db->where('id_user', $id_user);
        $this->db->from('tb_marketing');
        $id = $this->db->get()->row();
        ?>
        <input type="hidden" name="id_marketing" id="id_marketing" value="<?php echo $id->id_marketing ?>">
      <?php }else{ ?>
        <input type="hidden" name="id_marketing" id="id_marketing" value="<?php echo $calon->id_marketing ?>">
      <?php } ?>
      <!-- /.box-body -->
      <div class="box-footer">
        <?php if($calon->status==2){?>
        <button type="submit" id="btn-submit" class="btn btn-primary pull-right disabled"><i class="fa fa-paper-plane"></i> &nbsp;&nbsp;Kirim</button>
      <?php }else{ ?>
        <button type="submit" id="btn-submit" class="btn btn-primary pull-right"><i class="fa fa-paper-plane"></i> &nbsp;&nbsp;Kirim</button>
      <?php } ?>
      </div>
      <!-- /.box-footer-->
    </div>
    <!--/.direct-chat -->
  </div>
  <!-- /.col -->
</div>

<section class="content">

  <!-- row -->
  <div class="row">
    <div class="col-md-12">
      <!-- The time line -->
      <ul class="timeline">
        <!-- timeline time label -->
        <li class="time-label">
          <span class="bg-green">
            Aktivitas Follow Up
          </span>
        </li>
        <!-- /.timeline-label -->
        <!-- timeline item -->
        <?php foreach ($follow as $follow) { ?>
        <li>
          <i class="fa fa-envelope bg-blue"></i>

          <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> <?php echo tanggal(date('Y-m-d',strtotime($follow->last_kontak)),FALSE); ?>, <?php echo date('g:i', strtotime($follow->last_kontak)); ?></span>

            <h3 class="timeline-header"><a href="#"><?php echo $follow->nama_marketing ?></a> Mengirim Pesan WhatsApp ke <a href="#"><?php echo $follow->nama_calon ?></a></h3>

            <div class="timeline-body">
              <?php echo $follow->text ?>
            </div>
          </div>
        </li>
      <?php } ?>
        <li>
          <i class="fa fa-clock-o bg-gray"></i>
          <?php if(isset($follow)){ ?>
          <div class="timeline-item">
            <h3 class="timeline-header no-border"><a href="#"><?php echo $calon->nama_calon ?></a> Belum Pernah Di follow Up</h3>
          </div>
        <?php } ?>
        </li>
      </ul>
    </div>
  </div>

</section>
<!-- /.content -->
<?php if($calon->status!=2){ ?>
<script type="text/javascript">
  $(document).ready(function() {
    $('#btn-submit').on('click', function() {
      var id_Pelanggan = $('#id_calon').val();
      var id_marketing = $('#id_marketing').val();
      var no_hp = $('#no_hp').val();
      var text = $('#text-follow').val();
      var text2 = encodeURI(text);
      
      //alert(url);

      $.ajax({
        url: "<?php echo base_url('admin/pelanggan/follow') ?>",
        type: "POST",
        data: {
          id_pelanggan: id_Pelanggan,
          id_marketing: id_marketing,
          text_follow: text,
          status: 2,     
        },
        cache: false,
        success: function(dataResult){
          var dataResult = JSON.parse(dataResult);
          if(dataResult.statusCode==200){
            var url =  'https://api.whatsapp.com/send?phone='+no_hp+'&text='+text2;
            window.open(url);
            location.reload();         
          }
          else{
             alert("Text Belum Diisi");
          }
          
        }
      });

    });
  });
</script>
<?php } ?>