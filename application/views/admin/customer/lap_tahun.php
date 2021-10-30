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
  <!-- filter pelanggan -->
  <!-- <div class="form-group" style="padding-right: 20px;">
    <div class="filter">
      <select class="form-control" id="filter" name="filter">
        <option value="">Semua Pelanggan</option>
        <option value="Calon">Calon Customer</option>
        <option value="Customer">Customer</option>
      </select>
    </div>
  </div> -->
  <!-- filter Status Pelanggan -->
  <div class="form-group" style="padding-right: 20px;">
    <div class="filter">
      <select class="form-control" id="filter-status" name="filter-status">
        <option value="">Semua Status</option>
        <option value="Organik">Organik</option>
        <option value="Adsense">Adsense</option>
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
          <li><a href="#" data-toggle="modal" data-target="#bulan">Bulan</a></li>
          <li><a href="#" data-toggle="modal" data-target="#tahun">Tahun</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-4 col-sm-6 col-xs-12">
    <!-- Total Penjualan -->
    <?php 
    $calon_customer = $calon_cus->total;
    $tot_customer = $customer->total;
    $all = $calon_customer + $tot_customer;
     ?>
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Semua Pelanggan</span>
        <span class="info-box-number"><label id="total"><?php echo $all; ?></label></span>
      </div>
    </div>
  </div>
  <!-- Total Ongkos Kirim -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Total Calon Customer</span>
        <span class="info-box-number"><label id="calon"><?php echo $calon_cus->total ?></label></span>
      </div>
    </div>
  </div>
  <!-- total Adsense -->
  <div class="col-md-4 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-user" aria-hidden="true"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Total Customer</span>
        <span class="info-box-number"><label id="customer"><?php echo $customer->total ?></label></span>
      </div>
    </div>
  </div>
</div>

<!-- rincian -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Rincian Order</h3>
  </div>
  <div class="box-body">
    <div class="scrollmenu">
     <table id="example3" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>Tanggal</th>
        <th>Nama</th>
        <th>No. Telp</th>
        <th>Komoditi</th>
        <th>Kabupaten</th>
        <th>Status</th>
        <th>Jenis <br>Pelanggan</th>
      </tr>
      </thead>
      <tbody>
        <?php
            foreach ($pelanggan as $pelanggan) { ?>
        <tr>
          <td><?php echo tanggal(date('Y-m-d',strtotime($pelanggan->tanggal_daftar))) ?></td>
          <td><?php echo $pelanggan->nama_pelanggan ?></td>
          <td><?php echo $pelanggan->no_hp ?></td>
          <td><?php echo $pelanggan->komoditi ?></td>
          <td><?php echo $pelanggan->kabupaten ?></td>
          <td><?php if($pelanggan->status == 0){ echo "Organik";}else{ echo "Adsense";}?></td>
          <td><?php echo $pelanggan->jenis_pelanggan ?></td>
        </tr>
      <?php } ?>
      <?php foreach ($calon as $calon) { ?>
        <tr>
          <td><?php echo tanggal(date('Y-m-d',strtotime($calon->tanggal))) ?></td>
          <td><?php echo $calon->nama_calon ?></td>
          <td><?php echo $calon->no_hp ?></td>
          <td><?php echo $calon->komoditi ?></td>
          <td><?php echo $calon->kabupaten ?></td>
          <td><?php if($calon->status == 0){ echo "Organik";}else{ echo "Adsense";}?></td>
          <td><?php echo "Calon" ?></td>
        </tr>
      <?php } ?>
      </tbody>
     </table>
    </div>
  </div>
</div>
<input type="hidden" name="awal" id="thn" value="<?php echo $thn; ?>">
<?php include "filter.php"; ?>

<script type="text/javascript">
  $(document).ready(function(){
    dataTable = $("#example3").DataTable({
      'pageLength'  : 50
    });
    
    $('#filter-status').on('change', function(e){
      var filter = $(this).val();
      //var filter = $('#filter-status option:selected').text();
      
      //alert(filter);
      $('#filter-status').val(filter)
      dataTable.column(5).search(filter).draw();
      report(filter);
    })

    $('#filter').on('change', function(e){
      var filter = $(this).val();
      var produk = $('#filter-produk option:selected').val();
      //alert(status);
      $('#filter').val(filter)
      //alert(produk);
      dataTable.column(6).search(filter).draw();
      report(produk,filter);
    })

    function report(status){
      
      var bulan = $('#bln').val();
      var tahun = $('#thn').val();
      var data = "status="+status+"&bulan="+bulan+"&tahun="+tahun;
      //alert(tahun);
      $.ajax({
        type: 'POST',
        url: "<?php echo base_url('admin/pelanggan/report_tahun'); ?>",
        data: data,
        success: function(hasil) {
          var response = $.parseJSON(hasil);
          var customer = response.customer;
          var calon = response.calon;
          var total = parseInt(customer) + parseInt(calon);
          //alert(customer);
            $("#customer").html(customer);
            $("#calon").html(calon);
            $("#total").html(total);
        }
      });
    }
  });

</script>