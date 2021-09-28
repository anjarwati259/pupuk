<div class="row">
  <div class="col-md-12">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li role="presentation"><a href="<?php echo site_url('admin/produk/stok_awal');?>">Data Stok</a></li>
      <li role="presentation" ><a href="<?php echo site_url('admin/produk/tambah_stok');?>">Tambah Stok</a></li>
      <li role="presentation" ><a href="<?php echo site_url('admin/produk/stok_keluar');?>">Stok Keluar</a></li>
      <li role="presentation" class="active"><a href="#tab_1">Retur Barang</a></li>
      </ul>
      <div class="tab-content">
        <!-- /.tab-pane -->
        <div class="tab-pane active" id="tab_1">
          <form class="form-horizontal" method="POST">
            <div class="box-body">
              <div class="col-md-6" style="padding-top: 20px;">
                <div class="form-group">
                  <label class="col-sm-4 control-label" for="kode">Kode Invoice</label>
                  <div class="col-sm-6">
                    <input type="text" name="kode_transaksi" id="kode_transaksi" class="form-control" disabled/>
                  </div>
                  <div class="col-sm-2">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default">Cari</button>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label" for="kode">Tanggal Retur</label>
                   <div class="col-sm-8">
                     <input type="text" value="<?php echo date('Y-m-d') ?>" name="tgl_retur" id="tgl_retur" class="form-control"/>
                   </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label" for="kode">Tanggal Transaksi</label>
                   <div class="col-sm-8">
                     <input type="text" id="tgl_transaksi" name="tgl_transaksi" class="form-control" disabled/>
                   </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label" for="kode">Nama Pelanggan</label>
                   <div class="col-sm-8">
                     <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" disabled/>
                   </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label" for="kode">Marketing</label>
                   <div class="col-sm-8">
                     <input type="text" name="nama_marketing" id="nama_marketing" class="form-control" disabled/>
                   </div>
                </div>
              </div>
              <div class="col-md-6" style="padding-top: 20px;">
                <div class="form-group">
                  <label class="col-sm-4 control-label" for="kode">Alamat</label>
                   <div class="col-sm-8">
                     <textarea class="form-control" id="alamat" style=" height: 120px;" disabled></textarea>
                   </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-4 control-label" for="kode">Keterangan Retur</label>
                   <div class="col-sm-8">
                     <textarea class="form-control" id="keterangan" style=" height: 120px;"></textarea>
                   </div>
                </div>
              </div>

                <div class="col-md-12">
                    <h3 class="content-title">Informasi Barang yang ingin di Retur</h3>
                    <div class="content-process">
                    <table class="table">
                      <thead>
                        <tr style="text-align: center;">
                          <td>No</td>
                          <td>Kode Produk</td>
                          <td>Nama Produk</td>
                          <td>Jumlah</td>
                          <td>Harga Jual</td>
                        </tr>
                      </thead>
                      <tbody id="transaksi-item">
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="col-md-3 col-md-offset-4" style="padding-top: 15px;">
                <a href="<?php echo base_url('admin/produk/stok_awal') ?>" class="btn btn-default">Cancel</a>
                <button class="btn btn-info pull-right" type="submit" id="retur">Retur</button>
              </div>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>


<!-- modal -->
<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Select Data Order</h4>
      </div>
      <div class="modal-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Kode Invoice</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Kecamatan</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody>
            <?php foreach ($order as $order) { ?>
            <tr>
              <td><?php echo $order->kode_transaksi ?></td>
              <td><?php echo date('Y-m-d', strtotime($order->tanggal_transaksi)) ?></td>
              <td><?php echo $order->nama_pelanggan ?></td>
              <td><?php echo $order->kecamatan ?></td>
              <td><button type="submit" class="btn btn-primary btn-sm" id="pilih" 
                data-id="<?= $order->kode_transaksi ?>"
                data-tgl="<?= date('Y-m-d', strtotime($order->tanggal_transaksi)) ?>"
                data-nama="<?= $order->nama_pelanggan ?>"
                data-market="<?= $order->nama_marketing ?>"
                data-alamat="<?= $order->alamat ?>"><i class="fa fa-check"></i>&nbsp; Pilih</button></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
  $(document).ready(function(){
    $("body").on("click","#pilih",function(){
      var id = $(this).data('id');
      var tgl = $(this).data('tgl');
      var nama = $(this).data('nama');
      var alamat = $(this).data('alamat');
      var market = $(this).data('market');

      $('#kode_transaksi').val(id);
      $('#tgl_transaksi').val(tgl);
      $('#nama_pelanggan').val(nama);
      $('#nama_marketing').val(market);
      $('#alamat').val(alamat);
      $('#modal-default').modal('hide');

      $.ajax({
          type: 'POST',
          url: "<?php echo base_url('admin/produk/detail_order') ?>",
          data: {id:id},
          dataType : 'json',
          success: function(data) {
            var i;
            var html = '';
            for(i=0; i<data.length; i++){
              var id_produk = data[i].id_produk;
              var produk = data[i].nama_produk;
              var qty = data[i].jml_beli;
              var harga = data[i].harga;
              var no = parseInt(i)+1;
             html += '<tr style="text-align: center;">'+
                    '<td>'+no+'</td>'+
                    '<td>'+id_produk+'</td>'+
                    '<td>'+produk+'</td>'+
                    '<td>'+qty+'</td>'+
                    '<td>'+harga+'</td>'+
                    '</tr>';

            }
           $('#transaksi-item').html(html);
          }
      });
    });
});
//save retur
  $("body").on("click","#retur",function(){
    var id = $("#kode_transaksi").val();
    var tgl_trans = $("#tgl_transaksi").val();
    var tgl_retur = $("#tgl_retur").val();
    var ket = $("#keterangan").val();
    $.ajax({
        type: 'POST',
        url: "<?php echo base_url('admin/produk/add_retur') ?>",
        data: {id:id, tgl_retur:tgl_retur,tgl_trans:tgl_trans,ket:ket},
        success: function(data) {
          alert('Retur Barang berhasil');
        }
    });
  });
</script>