<style type="text/css">
  .group-filter{
    margin-top: 25px;
    display: flex;
  }
  .report{
    display: flex;
  }
  .info-box{
    margin-right: 15px;
  }
</style>
<div class="group-filter">
  <!-- produk -->
  <div class="form-group" style="padding-right: 20px; display: flex;">
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
  <div class="form-group" style="padding-right: 20px; display: flex;">
    <div class="filter">
      <select class="form-control" id="filter" name="filter" style="width: 180px;">
        <option value="">Semua Pelanggan</option>
        <option value="Customer">Customer</option>
        <option value="Mitra">Mitra</option>
      </select>
    </div>
  </div>
</div>

<div class="report">
  <!-- Total Penjualan -->
  <div class="info-box">
    <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">Total Penjualan</span>
      <span class="info-box-number"><label id="total"><?php echo $report->total ?></label></span>
    </div>
  </div>
  <!-- Total Ongkos Kirim -->
  <div class="info-box">
    <span class="info-box-icon bg-green"><i class="fa fa-truck"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">Total Ongkos Kirim</span>
      <span class="info-box-number"><label id="ongkir"><?php echo $ongkir->ongkir ?></label></span>
    </div>
  </div>
  <!-- total Adsense -->
  <div class="info-box">
    <span class="info-box-icon bg-yellow"><i class="fa fa-cart-plus" aria-hidden="true"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">Total Adsense</span>
      <span class="info-box-number">1,410</span>
    </div>
  </div>
  <!-- Total Organik -->
  <div class="info-box">
    <span class="info-box-icon bg-red"><i class="fa fa-cart-plus" aria-hidden="true"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">Total Organik</span>
      <span class="info-box-number">1,410</span>
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
        <th>Jenis Order</th>
        <th>Nama Pelanggan</th>
        <th>Produk</th>
        <th>Jumlah</th>
        <th>Harga</th>
        <th>Ongkir</th>
        <th>Total Harga</th>
        <th>Pembayaran</th>
        <th>Status</th>
        <th style="display: none;">Jenis</th>
        <th style="display: none;">Kode</th>
      </tr>
      </thead>
      <tbody>
        <?php $no=1; foreach ($laporan as $laporan) {?>
        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo tanggal(date('Y-m-d',strtotime($laporan->tanggal_transaksi)),FALSE);?></td>
          <td><?php if($laporan->jenis_order==1){
                echo "Adsense";
              }else{
                echo "organik";
              }
               ?></td>
          <td><?php echo $laporan->nama_pelanggan ?></td>
          <td><?php echo $laporan->nama_produk ?></td>
          <td><?php echo $laporan->jml_beli ?></td>
          <td>Rp. <?php echo number_format($laporan->harga,'0',',','.') ?></td>
          <td>Rp. <?php echo number_format($laporan->ongkir,'0',',','.') ?></td>
          <td>Rp. <?php echo number_format($laporan->total_transaksi,'0',',','.') ?></td>
          <td><?php if($laporan->metode_pembayaran==0){
                echo "COD";
              }else if($laporan->metode_pembayaran==1){
                echo "Transfer Bank";
              }else{
                echo "Cash";
              } ?> 
          </td>
          <td><?php if($laporan->status_bayar==0){
                echo "Belum Bayar";
              }else{
                echo "Sudah Bayar";
              }
               ?></td>
          <td style="display: none;"><?php echo $laporan->jenis_pelanggan ?></td>
          <td style="display: none;"><?php echo $laporan->id_produk ?></td>
        </tr>
        <?php } ?>
      </tbody>
     </table>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    dataTable = $("#example3").DataTable();
    
    $('#filter-produk').on('change', function(e){
      var produk = $(this).val();
      var filter = $('#filter option:selected').text();
      $('#filter-produk').val(produk)
      dataTable.column(12).search(produk).draw();
      report(produk,filter);
    })

    $('#filter').on('change', function(e){
      var filter = $(this).val();
      //alert(status);
      $('#filter').val(filter)
      dataTable.column(11).search(filter).draw();
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
          //alert(total);
          if(total == null){
            $("#total").html('0');
          }else{
            $("#total").html(total);
          }
        }
      });
    }
  });
</script>