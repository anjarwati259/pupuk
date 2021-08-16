<style type="text/css">
  .judul h3{
    text-align: center;
    font-size: 20px;
    line-height: 10px;
  }
  .judul h2{
    text-align: center;
    font-size: 25px;
    line-height: 20px;
  }
  .judul h4{
    text-align: center;
    line-height: 20px;
  }
  .table{
    padding: 20px;
  }
</style>
<div class="container-fluit">
  <!-- Default box -->
  <div class="box">
    <div class="box-body">
      <div class="judul">
        <h3>Laporan Penjualan</h3>
        <h2><STRONG>PT Agrikultur Gemilang Indonesia</STRONG></h2>
      </div>
      <div class="scrollmenu">
       <table id="example" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          <th>Kode Invoice</th>
          <th>Tanggal</th>
          <th>Marketing</th>
          <th>Jenis Order</th>
          <th>Nama Pelanggan</th>
          <th>Produk</th>
          <th>Jumlah</th>
          <th>Harga</th>
          <th>Ongkir</th>
          <th>Total Harga</th>
          <th>Pembayaran</th>
          <th>Status</th>
        </tr>
        </thead>
        <tbody>
          <?php $no=1; foreach ($laporan as $laporan) {?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $laporan->kode_transaksi ?></td>
            <td><?php echo $laporan->tanggal_transaksi ?></td>
            <td><?php echo $laporan->nama_marketing ?></td>
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
          </tr>
          <?php } ?>
        </tbody>
       </table>
      </div>
    </div>
  </div>
  <!-- /.box -->
</div>