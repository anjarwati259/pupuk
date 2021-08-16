
<!-- START CUSTOM TABS -->
<div class="row">
  <div class="col-md-12">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="#tab_1">Data Stok</a></li>
      <li role="presentation"><a href="<?php echo site_url('admin/order/tambah_stok');?>">Tambah Stok</a></li>
      <li role="presentation"><a href="<?php echo site_url('admin/order/stok_keluar');?>">Stok Keluar</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1">
          <div class="box">
            <div class="box-header">
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Produk</th>
                  <th>Nama Produk</th>
                  <th>Stok</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach ($produk as $produk) { ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?php echo $produk->kode_produk ?></td>
                  <td><?php echo $produk->nama_produk ?></td>
                  <td><?php echo $produk->stok ?></td>
                </tr>
              <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->
<!-- END CUSTOM TABS -->