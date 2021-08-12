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
        <h3>Penjualan Berdasarkan Bulan</h3>
        <h2><STRONG>PT Agrikultur Gemilang Indonesia</STRONG></h2>
        <h4>Dari Tahun <b><?php echo $tahun ?></b></h4>
      </div>
      <div class="table">
        <table class="table table-bordered table-striped">
            <thead>
            <tr class="table-primary">
              <th>No</th>
              <th>Kode Invoice</th>
              <th>Tanggal</th>
              <th>Marketing</th>
              <th>Jenis Order</th>
              <th>Nama</th>
              <th>Produk</th>
              <th>Jumlah</th>  
              <th>Harga</th>
              <th>Potogan</th>
              <th>Total</th>
              <th>Status</th>
              <th>Status Bayar</th>
            </tr>
            </thead>
            <tbody>
              <?php $no=1; foreach ($laporan as $laporan) { ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $laporan->kode_transaksi ?></td>
                <td><?php echo $laporan->tanggal_transaksi ?></td>
                <td><?php echo $laporan->nama_marketing ?></td>
                <td><?php if($laporan->status==1){
                  echo "Adsense";
                }else{
                  echo "organik";
                }
                 ?></td>
                <td><?php echo $laporan->nama_pelanggan ?></td>
                <td><?php echo $laporan->nama_produk ?></td>
                <td><?php echo $laporan->jml_beli ?></td>
                <td>Rp. <?php echo number_format($laporan->harga,'0',',','.') ?></td>
                <td>Rp. <?php echo number_format($laporan->potongan,'0',',','.') ?></td>
                <td>Rp. <?php echo number_format($laporan->total_transaksi,'0',',','.') ?></td>
                <td><?php if($laporan->metode_pembayaran==1){
                          echo "Transfer Bank";
                        }else{
                          echo "COD";
                        }
                 ?></td>
                 <td><?php if($laporan->status_bayar==1){
                          echo "Sudah Bayar";
                        }else{
                          echo "Belum Bayar";
                        }
                 ?></td>
              </tr>
            <?php } ?>
            <tr>
                <td colspan="8" style="text-align: right;"><b>Total</b></td>
                <td></td>
                <td colspan="2">Rp. <?php echo number_format($total->total,'0',',','.') ?></td>
                <td></td>
              </tr>
            </tbody>
          </table>
      </div>
    </div>
  </div>
  <!-- /.box -->
</div>