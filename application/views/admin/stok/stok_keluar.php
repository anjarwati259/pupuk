<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php 
//error upload
if(isset($error)){
  echo '<p clasfs="alert alert-warning">';
  echo $error;
  echo '</p>';
}
//Notifikasi error
echo validation_errors('<div class = "alert alert-warning">','</div>');

// Form open
echo form_open_multipart(base_url('admin/produk/stok_keluar'), ' class="form-horizontal"');
 ?>
<!-- START CUSTOM TABS -->
      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li role="presentation"><a href="<?php echo site_url('admin/produk/stok_awal');?>">Data Stok</a></li>
            <li role="presentation" ><a href="<?php echo site_url('admin/produk/tambah_stok');?>">Tambah Stok</a></li>
            <li role="presentation" class="active"><a href="#tab_1">Stok Keluar</a></li>
            <li role="presentation"><a href="<?php echo site_url('admin/produk/retur_barang');?>">Retur Barang</a></li>
            </ul>
            <div class="tab-content">
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="tab_1">
                <form class="form-horizontal" method="POST">
                  <div class="box-body">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-sm-4 control-label">Tanggal</label>
                        <div class="col-sm-8">
                          <input type="text" value="<?php echo date('Y-m-d') ?>" name="tanggal" id ='datepicker' class="form-control" required/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label">Kode Produk</label>
                        <div class="col-sm-8">
                          <select name='kode_produk' class="form-control" id="kode_produk">
                            <option value="0">--Pilih Produk--</option>
                            <?php foreach ($produk as $produk) { ?>
                              <option value="<?php echo $produk->kode_produk ?>"><?php echo $produk->nama_produk ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label">Nama Produk</label>
                        <div class="col-sm-8">
                          <input type="text" value="<?php echo set_value('nama_produk') ?>" name="nama_produk" placeholder="Nama Produk" class="form-control" readonly required/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label">Sisa Stok</label>
                        <div class="col-sm-8">
                          <input type="text" name="sisa_stok" placeholder="Sisa Stok" class="form-control" readonly required/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label">Status</label>
                        <div class="col-sm-8">
                          <select name='status' class="form-control" id="status">
                            <option>--Pilih Status--</option>
                              <option value="sampel">Sample</option>
                              <option value="rusak">Rusak</option>
                              <option value="bonus">Bonus</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label">Jumlah</label>
                        <div class="col-sm-8">
                          <input type="text" value="<?php echo set_value('stok') ?>" name="stok" placeholder="Jumlah" class="form-control" required/>
                        </div>
                      </div>

                    </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <div class="col-md-3 col-md-offset-4">
                      <a href="<?php echo base_url('admin/produk/stok_awal') ?>" class="btn btn-default">Cancel</a>
                      <button class="btn btn-info pull-right" type="submit">Save</button>
                    </div>
                  </div>
                  <!-- /.box-footer -->
                </form>
                <!-- /.box -->
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <?php echo form_close(); ?>
      <!-- /.row -->
      <!-- END CUSTOM TABS -->

<script type="text/javascript">
  $(document).ready(function(){

      // ambil data kabupaten ketika data memilih provinsi
      $('body').on("change","#kode_produk",function(){
        var id = $(this).val();
        $.ajax({
          url : "<?php echo base_url('admin/order/get_produk');?>",
          method : "POST",
          data : {id: id},
          dataType : 'json',
          success: function(data){
             var model = data[0].nama_produk;
              $('[name="nama_produk"]').val(data[0]['nama_produk']);
              $('[name="sisa_stok"]').val(data[0]['stok']);
          }
        });
      });
    });
</script>
