
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
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
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
                      //format tanggal
              function tanggal_indo($tanggal, $cetak_hari = false)
                  {
                    $hari = array ( 1 =>    'Senin',
                          'Selasa',
                          'Rabu',
                          'Kamis',
                          'Jumat',
                          'Sabtu',
                          'Minggu'
                        );
                        
                    $bulan = array (1 =>   'Januari',
                          'Februari',
                          'Maret',
                          'April',
                          'Mei',
                          'Juni',
                          'Juli',
                          'Agustus',
                          'September',
                          'Oktober',
                          'November',
                          'Desember'
                        );
                    $split    = explode('-', $tanggal);
                    $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
                    
                    if ($cetak_hari) {
                      $num = date('N', strtotime($tanggal));
                      return $hari[$num] . ', ' . $tgl_indo;
                    }
                    return $tgl_indo;
                  }
                      $no=1; foreach ($stok as $stok) { ?>
                      <tr>
                        <td><?php echo tanggal_indo(date('Y-m-d',strtotime($stok->tanggal)),FALSE); ?></td>
                        <td><?php if($stok->status == 'in'){
                          echo "Pabrik";
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