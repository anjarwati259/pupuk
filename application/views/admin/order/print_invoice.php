<style type="text/css">
	.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 12px; 
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

#logo {
  text-align: center;
  margin-bottom: 10px;
}

#logo img {
  width: 90px;
}

h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  background-image: url('../img/bg-admin.jpg');
}

#project {
  float: left;
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  float: right;
  text-align: right;
}

#project div,
#company div {
  white-space: nowrap;   
  font-size: 15px;     
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: right;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 0.9em;
}

table td.grand {
  border-top: 1px solid #5D6975;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.3em;
}

footer {
  color: #5D6975;
  width: 100%;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}
#grid {
  display: grid;
  height: 100px;
  grid-template-columns: repeat(6, 1fr);
  grid-template-rows: 100px;
}

#item1 {
  /*background-color: lime;*/
  grid-column: 1 / 4;
}
#item1 span{
	line-height: 20px;
}

#item3 {
	/*text-align: center;*/
  /*background-color: blue;*/
  grid-column: span 2 / 7;
}
</style>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo $kode_transaksi ?></title>
    <link rel="stylesheet" href="style.css" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="<?php echo base_url() ?>assets/img/logo/logo_2.png">
      </div>
      <h1>INVOICE : <?php echo $kode_transaksi ?></h1>
      <div id="company" class="clearfix">
        <div style="font-size: 20px;"><strong>Agrikultur Gemilang Indonesia</strong></div>
        <div>Jl. Manggis Raya No.11 Jemberlor Patrang, Jember Jawa Timur</div>
        <div>+6233 1510 8758</div>
        <div><a href="#" style="color: blue;">support@ptagi.co.id</a></div>
      </div>
      <div id="project">
      	<br>
        <div><span>Nama</span> <?php echo $detail->nama_pelanggan ?></div>
        <div><span>No. Telp</span> <?php echo $detail->no_hp ?></div>
        <div><span>Alamat</span> Jl H Ismail No 17 DSN Parimono 
        <div><span></span>RT/RW 002/001 Kec jombang,Jombang, 
          <div><span></span><?php echo $detail->kecamatan ?>, <?php echo $detail->kabupaten ?></div>
        <div><span></span> <?php echo $detail->provinsi ?></div>
        <div><span>Tanggal</span> <?php echo tanggal(date('Y-m-d',strtotime('2021-06-17'))); ?></div>
      </div>
    </header>
    <main>
      <table>
        <thead style="background-color: #8FBC8F; color: white;">
          <tr>
            <th style="color: black;" class="service">No</th>
            <th style="color: black;" class="desc">Produk</th>
            <th style="color: black;">QTY</th>
            <th style="color: black;">Potongan</th>
            <th style="color: black;">Harga</th>
            <th style="color: black;">TOTAL</th>
          </tr>
        </thead>
        <tbody>
        	<?php $no=1; foreach ($order as $order) { ?>
            <?php if($order->harga !=0){ ?>
          <tr>
            <td class="service"><?php echo $no++ ?></td>
            <td class="desc"><?php echo $order->nama_produk ?></td>
            <td class="unit"><?php echo $order->jml_beli ?></td>
            <td class="qty">Rp. <?php echo number_format($order->potongan,'0',',','.') ?></td>
            <td class="qty">Rp. <?php echo number_format($order->harga,'0',',','.') ?></td>
            <td class="total">Rp. <?php echo number_format($order->total_transaksi,'0',',','.') ?></td>
          </tr>
        <?php } ?>
      <?php } ?>
          <tr>
            <td colspan="5"><b>Subtotal<b></td>
            <td class="total">Rp. <?php echo number_format($detail->total_transaksi,'0',',','.') ?></td>
          </tr>
          <tr>
            <td colspan="5"><b>Ongkos Kirim</b></td>
            <td class="total">Rp. <?php echo number_format($detail->ongkir,'0',',','.') ?></td>
          </tr>
          <tr>
            <td style="background-color: #8FBC8F;" colspan="5" class="grand total"><b>Total</b></td>
            <td style="background-color: #8FBC8F;" class="grand total">Rp. <?php echo number_format($detail->total_bayar,'0',',','.') ?></td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>Rekening Perusahaan:</div>
        <div class="notice">
        	<br>
        	<div id="grid">
			  <div id="item1">
			  	<span>Bank BCA</span><br>
			  	<span>A/C : 024 - 7095 - 555</span><br>
			  	<span>A/N : Agrikultur Gemilang Indonesia</span>
			  	<br><br>
			  	<span>Bank Mandiri</span><br>
			  	<span>A/C : 14300 - 8165 - 5555</span><br>
			  	<span>A/N : Agrikultur Gemilang Indonesia</span>
			  </div>
			  <div id="item3">
			  	<span>Jember, <?php $date = date('2021-06-17');
			  	 echo tanggal(date('Y-m-d',strtotime($date))); ?></span><br>
			  	 <br>
			  	 <br>
			  	 <br>
			  	 <br>
           <br>
           <br>
			  	 <span>Melina</span>
			  </div>
			</div>
      <div style="padding-top: 100px; line-height: 1.4em;">
        <b>Catatan:</b>
        <br><br>
        <b>19 Juni 2021</b> <br>Pembayaran 15 Botol kemasan 1 Liter Rp. 1.800.000
      </div>
        </div>
      </div>
    </main>
  </body>
</html>
<script type="text/javascript">
  window.print();
</script>