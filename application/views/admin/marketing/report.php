<style type="text/css">
  .group-filter{
    margin-top: 25px;
    display: flex;
    flex-direction: row;
  }
  .report{
    display: flex;
  }
  .info-box{
    margin-right: 15px;
  }
  /* Responsive layout - makes a one column layout instead of a two-column layout */
    @media (max-width: 500px) {
      .group-filter {
        flex-direction: column;
      }
      .filter-2{
        display: block;
        margin-left: auto;
        margin-right: auto;
      }
    }
</style>
<div class="group-filter">
  <!-- produk -->
  <div class="form-group" style="padding-right: 20px;">
    <div class="filter">
      <select class="form-control" id="filter-produk" name="filter-produk">
        <option value="">Semua Produk</option>
        <?php foreach ($produk as $produk) { ?>
        <option value="<?php echo $produk->kode_produk ?>"><?php echo $produk->nama_produk ?></option>
      <?php } ?>
      </select>
    </div>
  </div>
  <!-- filter -->
  <div class="form-group filter-2" style="padding-right: 20px;">
    <div class="filter">
      <div class="input-group-btn">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Filter
          <span class="fa fa-caret-down"></span></button>
        <ul class="dropdown-menu">
          <li><a href="#" data-toggle="modal" data-target="#tanggal">Tanggal</a></li>
          <li><a href="#" data-toggle="modal" data-target="#filter-bln">Bulan</a></li>
          <li><a href="#" data-toggle="modal" data-target="#filter-thn">Tahun</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Performa Marketing</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="scrollmenu">
     <table id="example3" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>No</th>
        <th>Marketing</th>
        <th style="text-align: center;">Order</th>
        <th style="text-align: center;">Organik</th>
        <th style="text-align: center;">Adsense</th>
        <!-- <th style="text-align: center;">Follow Up</th> -->
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
        <?php 
        $no=1; 
        $user_id = $this->session->userdata('id_user');
        foreach ($marketing as $key => $value) {
          $id_marketing = $value->id_marketing;
          $data = array('id' => $id_marketing,
                        'awal' =>$awal,
                        'akhir' =>$akhir,
                        'kode'  => $kode,
                        'status' => $status  );
          ?>
        <tr>
          <td><?php echo $no++ ?></td>
          <td style="max-width: 20px;"><?php echo $value->nama_marketing ?></td>
          <td style="text-align: center;">
            <?php $order = count_order($data);
            if($order<=50){ ?>
            <span class="badge bg-red">
            <?php }else if($order<=60){ ?>
            <span class="badge bg-yellow">
            <?php }else{ ?>
              <span class="badge bg-green">
            <?php } ?>
              <?php 
                if($order){
                  echo count_order($data);
                }else{
                  echo '0';
                }
          ?></span></td>
          <td style="text-align: center;">
            <?php $order = organik($data);
            if($order<=50){ ?>
            <span class="badge bg-red">
            <?php }else if($order<=60){ ?>
            <span class="badge bg-yellow">
            <?php }else{ ?>
              <span class="badge bg-green">
            <?php } ?>
            <?php 
                if($order){
                  echo organik($data);
                }else{
                  echo '0';
                }
          ?></span></td>
          <td style="text-align: center;">
            <?php $order = adsense($data);
            if($order<=50){ ?>
            <span class="badge bg-red">
            <?php }else if($order>50 && $order<=60){ ?>
            <span class="badge bg-yellow">
            <?php }else{ ?>
              <span class="badge bg-green">
            <?php } ?>
              <?php  
                if($order){
                  echo adsense($data);
                }else{
                  echo '0';
                }
          ?></span></td>
          <!-- <td><?php echo $value->id_user ?></td> -->
          <td style="text-align: center; width: 30px;">
            <a href="<?php echo base_url('login/user_login/'.$value->id_user.'/'.$user_id) ?>" class="btn btn-block btn-warning btn-sm">Login</a></td>
        </tr>
      <?php } ?>
      </tbody>
     </table>
    </div>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->

<!-- modal -->
<!-- Modal filter Tahun -->
<div class="modal fade" id="filter-thn">
  <div class="modal-dialog" style="width: 350px;">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #F0F8FF;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Filter By Tahun</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open(base_url('marketing/report_thn')); ?>
        <div class="form-group">
          <label>Tahun</label>

          <select class="form-control" id="tahun2" name="tahun2">
            <option value="">-- Pilih Tahun --</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
          </select>
          <!-- /.input group -->
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-defaul" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Filter</button>
      </div>
    </div>
    <?php echo form_close(); ?>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- Modal filter tanggal -->
<div class="modal fade" id="tanggal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #F0F8FF;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Filter By Tanggal</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open(base_url('marketing/report_tgl')); ?>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Mulai Tanggal</label>

              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="tgl_awal" class="form-control pull-right" id="datepicker2" required>
              </div>
              <!-- /.input group -->
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Sampai Tanggal</label>

              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="tgl_akhir" class="form-control pull-right" id="datepicker" required>
              </div>
              <!-- /.input group -->
            </div>
          </div>
        </div>
        
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-defaul" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Filter</button>
      </div>
      <?php echo form_close(); ?>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- Modal filter bulan -->
<div class="modal fade" id="filter-bln">
  <div class="modal-dialog" style="width: 450px;">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #F0F8FF;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Filter By Bulan</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open(base_url('marketing/report_bln')); ?>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Tahun</label>

              <select class="form-control" id="tahun" name="tahun" style="width: 180px;">
                <option value="">-- Pilih Tahun --</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
              </select>
              <!-- /.input group -->
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Bulan</label>

              <select class="form-control" id="bulan" name="bulan" style="width: 180px;">
                <option value="">-- Pilih Bulan --</option>
                <option value="01">Januari</option>
                <option value="02">Februari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08">Agustus</option>
                <option value="09">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
              </select>
            </div>
          </div>
        </div>
        
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-defaul" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Filter</button>
      </div>
      <?php echo form_close(); ?>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
  $(document).ready(function(){
    dataTable = $("#example3").DataTable({
      'pageLength'  : 50
    });
    $('#filter-produk').on('change', function(e){
      var produk = $(this).val();
      var status = '<?php echo $status ?>';
      //alert(status);
      //$('#filter-produk').val(produk)
      report(produk,status);
    })

    function report(kode,status){
      var id = '1';//filter-produk

      var data = "kode="+kode+"&id="+id;
      //alert(data);
      if(status==0){
        var url = '<?php echo base_url('marketing/report_marketing'); ?>'
      }
      $.ajax({
        type: 'POST',
        url: "<?php echo base_url('marketing/report_marketing'); ?>",
        data: data,
        success: function(hasil) {
          // var response = $.parseJSON(hasil);
          // var total = response.total;
          // var ads = response.ads;
          // var organik = response.organik;
          // //alert(hasil);
          //   $("#total").html(total);
          //   $("#ads").html(ads);
          //   $("#organik").html(organik);
        }
      });
    }
  });
</script>
