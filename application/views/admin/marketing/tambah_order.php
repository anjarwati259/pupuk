<!-- START CUSTOM TABS -->
<div class="row">
  <div class="col-md-12">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="#tab_1">Tambah Order</a></li>
        <li role="presentation"><a href="<?php echo site_url('admin/order');?>">Belum Bayar</a></li>
        <li role="presentation"><a href="<?php echo site_url('admin/order/sudah_bayar');?>">Sudah Bayar</a></li>
      </ul>
      <div class="tab-content">
        <!-- /.tab-pane -->
        <div class="tab-pane active" id="tab_1">
          <div class="row">
            <form id="transaction-form" class="form-horizontal" method="POST" action="<?php echo base_url('admin/order/add_process');?>">
            <div class="col-sm-5">
              <div class="box box-primary box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Informasi Order</h3>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="kode">Kode Invoice</label>
                    <div class="col-sm-8">
                      <input type="hidden" name="kode_transaksi" id="kode_transaksi" value=""/>
                      <input type="text" name="kode" id="kode_transaksi" class="form-control" value="" disabled/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="kode">Tanggal</label>
                    <div class="col-sm-8">
                      <input type="hidden" name="kode_transaksi" id="kode_transaksi" value=""/>
                      <input type="text" name="kode" id="kode_transaksi" class="form-control" value="" disabled/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="kode">Marketing</label>
                    <div class="col-sm-8">
                      <input type="hidden" name="kode_transaksi" id="kode_transaksi" value=""/>
                      <input type="text" name="kode" id="kode_transaksi" class="form-control" value="" disabled/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="kode">Jenis Order</label>
                    <div class="col-sm-8">
                      <input type="hidden" name="kode_transaksi" id="kode_transaksi" value=""/>
                      <input type="text" name="kode" id="kode_transaksi" class="form-control" value="" disabled/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="kode">Metode Bayar</label>
                    <div class="col-sm-8">
                      <input type="hidden" name="kode_transaksi" id="kode_transaksi" value=""/>
                      <input type="text" name="kode" id="kode_transaksi" class="form-control" value="" disabled/>
                    </div>
                  </div>
                  
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
              <div class="box box-primary box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Informasi Order</h3>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="kode">Nama Pelanggan</label>
                    <div class="col-sm-8">
                      <input type="hidden" name="kode_transaksi" id="kode_transaksi" value=""/>
                      <input type="text" name="kode" id="kode_transaksi" class="form-control" value="" disabled/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="kode">Kode Invoice</label>
                    <div class="col-sm-8">
                      <input type="hidden" name="kode_transaksi" id="kode_transaksi" value=""/>
                      <input type="text" name="kode" id="kode_transaksi" class="form-control" value="" disabled/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="kode">Kode Invoice</label>
                    <div class="col-sm-8">
                      <input type="hidden" name="kode_transaksi" id="kode_transaksi" value=""/>
                      <input type="text" name="kode" id="kode_transaksi" class="form-control" value="" disabled/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="kode">Kode Invoice</label>
                    <div class="col-sm-8">
                      <input type="hidden" name="kode_transaksi" id="kode_transaksi" value=""/>
                      <input type="text" name="kode" id="kode_transaksi" class="form-control" value="" disabled/>
                    </div>
                  </div>
                  
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-sm-7">
              <div class="box box-primary box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Informasi Barang</h3>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table class="table">
                        <thead>
                          <tr>
                            <td>Pilih Paket</td>
                            <td>Nama Barang</td>
                            <td>Jumlah</td>
                            <td>Bonus</td>
                            <td>Harga Beli</td>
                            <td>Input Barang</td>
                          </tr>
                        </thead>
                        <tbody id="transaksi-item">
                          
                        </tbody>
                      </table>
                </div>
              </div>
            </div>
            </form>
          </div>
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