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
          <li><a href="#" data-toggle="modal" data-target="#bulan">Bulan</a></li>
          <li><a href="#" data-toggle="modal" data-target="#tahun">Tahun</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <!-- Total Penjualan -->
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Total</span>
        <span class="info-box-number"><label id="total"><?php if(!isset($report->total)){ echo "0";}else{echo $report->total;} ?></label></span>
      </div>
    </div>
  </div>
  <!-- Total Ongkos Kirim -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="fa fa-truck"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Bonus</span>
        <span class="info-box-number"><label id="ongkir"><?php echo rupiah($ongkir->ongkir) ?></label></span>
      </div>
    </div>
  </div>
  <!-- total Adsense -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-cart-plus" aria-hidden="true"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Sample</span>
        <span class="info-box-number"><label id="ads"><?php if(!isset($ads->total)){ echo "0";}else{echo $ads->total;} ?></label></span>
      </div>
    </div>
  </div>
  <!-- Total Organik -->
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="fa fa-cart-plus" aria-hidden="true"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Proses</span>
        <span class="info-box-number"><label id="organik"><?php if(!isset($organik->total)){ echo "0";}else{echo $organik->total;} ?></label></span>
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
        <th>No</th>
        <th>Tanggal</th>
        <th>Marketing</th>
        <th>Nama Pelanggan</th>
        <th>Produk</th>
        <th>Jumlah</th>
        <th>Status</th>
        <th>Sisa Stok</th>
      </tr>
      </thead>
      <tbody>
        
      </tbody>
     </table>
    </div>
  </div>
</div>

<?php include "filter.php"; ?>

<script type="text/javascript">
  $(document).ready(function(){
    dataTable = $("#example3").DataTable({
      'pageLength'  : 50
    });
    
    $('#filter-produk').on('change', function(e){
      var produk = $(this).val();
      var filter = $('#filter option:selected').text();
      //alert(id);
      $('#filter-produk').val(produk)
      dataTable.column(12).search(produk).draw();
      report(produk,filter);
    })

    $('#filter').on('change', function(e){
      var filter = $(this).val();
      var produk = $('#filter-produk option:selected').val();
      //alert(status);
      $('#filter').val(filter)
      //alert(produk);
      dataTable.column(11).search(filter).draw();
      report(produk,filter);
    })

    function report(kode, jenis){
      var id = $(this).find(':selected').attr('dataid');

      var data = "kode="+kode+"&jenis="+jenis;
      //alert(data);
      $.ajax({
        type: 'POST',
        url: "<?php echo base_url('admin/order/report'); ?>",
        data: data,
        success: function(hasil) {
          var response = $.parseJSON(hasil);
          var total = response.total;
          var ads = response.ads;
          var organik = response.organik;
          //alert(hasil);
            $("#total").html(total);
            $("#ads").html(ads);
            $("#organik").html(organik);
        }
      });
    }
  });
</script>