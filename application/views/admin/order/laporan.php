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
  <!-- filter pelanggan -->
  <div class="form-group" style="padding-right: 20px; display: flex;">
    <div class="filter">
      <select class="form-control" id="filter" name="filter" style="width: 180px;">
        <option value="">Semua Pelanggan</option>
        <option value="Customer">Customer</option>
        <option value="Mitra">Mitra</option>
      </select>
    </div>
  </div>
  <!-- filter -->
  <div class="form-group" style="padding-right: 20px; display: flex;">
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
      <span class="info-box-number"><label id="ongkir"><?php echo rupiah($ongkir->ongkir) ?></label></span>
    </div>
  </div>
  <!-- total Adsense -->
  <div class="info-box">
    <span class="info-box-icon bg-yellow"><i class="fa fa-cart-plus" aria-hidden="true"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">Total Adsense</span>
      <span class="info-box-number"><label id="ads"><?php echo $ads->total ?></label></span>
    </div>
  </div>
  <!-- Total Organik -->
  <div class="info-box">
    <span class="info-box-icon bg-red"><i class="fa fa-cart-plus" aria-hidden="true"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">Total Organik</span>
      <span class="info-box-number"><label id="organik"><?php echo $organik->total ?></label></span>
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

<!-- Modal filter Tahun -->
<div class="modal fade" id="tahun">
  <div class="modal-dialog" style="width: 350px;">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #F0F8FF;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Filter By Tahun</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Tahun</label>

          <select class="form-control" id="tahun" name="tahun">
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
        <button type="button" class="btn btn-primary">Filter</button>
      </div>
    </div>
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
        <?php echo form_open(base_url('admin/order/lap_tanggal')); ?>
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
<div class="modal fade" id="bulan">
  <div class="modal-dialog" style="width: 450px;">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #F0F8FF;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Filter By Bulan</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open(base_url('admin/order/lap_bulan')); ?>
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