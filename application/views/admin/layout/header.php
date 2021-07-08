<?php 
$this->load->model('dashboard_model');
$jml_order = $this->dashboard_model->total_order();
$order = $this->dashboard_model->data_notif();
$notif = $this->dashboard_model->data_notif();
 ?>
  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>PTAGI</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <?php if($this->session->userdata('hak_akses')=='1'){ ?>
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning" id="notif"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Notifikasi Order</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu" id="pesan">
                  <!-- <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i>
                    </a>
                  </li> -->
                </ul>
              </li>
            </ul>
          </li>
        <?php } ?>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url() ?>assets/admin/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('nama_user'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url() ?>assets/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <!-- <?php echo $this->session->userdata('nama_user'); ?> - <?php echo $this->session->userdata('akses_level'); ?> -->
                  <small><?php echo date('d M Y') ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url('login/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
<style type="text/css">
  .invoice-col img{
    height: 120px;
    width: 120px;
  }
</style>
  <!-- modal notifikasi -->
<?php foreach ($notif as $notif) {
  $data = $this->dashboard_model->detail_notif($notif->kode_transaksi);
  $transaksi = $this->order_model->kode_order($notif->kode_transaksi);
  ?>
<div class="modal fade" id="notif<?= $notif->kode_transaksi?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Order</h4>
      </div>
      <div class="modal-body">
        <section class="invoice">
      <!-- info row -->
      <div class="row invoice-info">
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <h3>Data Customer</h3>
          <address style="font-size: 16px;">
            <strong style="font-size: 20px;"><?php echo $data->nama_pelanggan ?></strong><br>
            <strong>Alamat</strong> : <?php echo $data->alamat ?>,Kec. <?php echo $data->kecamatan ?>,kab. <?php echo $data->kabupaten ?>, Provinsi <?php echo $data->provinsi ?><br>
            <br>
            <b>No. Hp</b>: <?php echo $data->no_hp ?><br>
            <b>Marketing</b>: <?php echo $data->nama_marketing ?><br>
          </address>
        </div>
        <div class="col-sm-4 invoice-col">
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col" style="font-size: 16px;">
          <h3>Invoice : <?php echo $data->kode_transaksi ?></h3>
          <br>
          <b>Ekspedisi:</b> <?php echo $data->expedisi ?><br>
          <b>Ongkir:</b> Rp. <?php echo number_format($data->ongkir,'0',',','.') ?><br>
          <b>Metode Bayar:</b> <?php echo $data->metode_pembayaran ?><br>
          <b>Total Bayar:</b> Rp. <?php echo number_format($data->total_bayar,'0',',','.') ?>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>Produk</th>
              <th>Jumlah Beli</th>
              <th>Harga Satuan</th>
              <th>Subtotal</th>
            </tr>
            </thead>
            <tbody>
              <?php foreach ($transaksi as $transaksi) { ?>
            <tr>
              <?php if($transaksi->harga==0){ ?>
                <td>Bonus</td>
              <?php }else{ ?>
              <td><?php echo $transaksi->nama_produk ?></td>
            <?php } ?>
              <td><?php echo $transaksi->jml_beli ?></td>
              <td>Rp. <?php echo number_format($transaksi->harga,'0',',','.') ?></td>
              <td>Rp. <?php echo number_format($transaksi->total_harga,'0',',','.') ?></td>
            </tr>
          <?php } ?>
            <tr>
              <td colspan="3" style="text-align: right;"><strong>Total Belanja :</strong></td>
              <td colspan="1"><strong></strong></td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
      </div>
      <div class="modal-footer">
        <a href="<?php echo base_url('admin/dashboard/status_baca/'.$data->kode_transaksi) ?>" type="button" class="btn btn-primary">OK</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<?php } ?>
<script type="text/javascript">
  $(document).ready(function(){
    selesai();
  });
  function selesai(){
    setTimeout(function(){
      jumlah();
      selesai();
      pesan();
    },900);
  }
  function jumlah(){
    $.getJSON("<?php echo base_url('admin/dashboard/get_notif') ?>", function(datas){
      $("#notif").html(datas.total);
    });
  }
  function pesan(){
    $.getJSON("<?php echo base_url('admin/dashboard/data_notif') ?>", function(data){
      $("#pesan").empty();
      var no = 1;
      $.each(data.data_notif, function(){
        if(this['nama_marketing'] == null){
          $("#pesan").append('<li><a href="#" data-toggle="modal" data-target="#notif'+this['kode_transaksi']+'"> <i class="fa fa-shopping-cart text-green"></i> Order Baru Dari Mitra</a></li>');
        }else{
        $("#pesan").append('<li><a href="#" data-toggle="modal" data-target="#notif'+this['kode_transaksi']+'"> <i class="fa fa-shopping-cart text-green"></i> Order Baru Dari '+this['nama_marketing']+'</a></li>');
      }
      })
    })
  }
</script>