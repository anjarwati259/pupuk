
<!-- START CUSTOM TABS -->
      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="box">
                  <div class="box-header">
                    
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="scrollmenu">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Sisa Stok</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $no=1; foreach ($stok as $stok) { ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo tanggal(date('Y-m-d',strtotime($stok->tanggal)),FALSE); ?></td>
                        <td><?php if($stok->status == 'in'){
                          echo "Pabrik";
                        }else if($stok->status != 'in' && $stok->id_pelanggan == null){
                          echo "-";
                        }else{
                          echo $stok->nama_pelanggan;
                        } ?></td>
                        <td><?php echo $stok->nama_produk ?></td>
                        <td><?php echo $stok->qty ?></td>
                        <td><?php echo $stok->status ?></td>
                        <td><?php echo $stok->sisa ?></td>
                      </tr>
                    <?php } ?>
                      </tbody>
                    </table>
                  </div>
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