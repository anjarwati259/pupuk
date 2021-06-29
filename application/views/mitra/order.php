<!-- Begin Page Content -->
<div class="container">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pembelian Mitra</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Tanggal Transaksi</th>
                            <th>Total Pembayaran</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; 
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
              foreach ($order as $order) { ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td>#<a href="<?php echo base_url('order/detail/'.$order->kode_transaksi) ?>"><?php echo $order->kode_transaksi ?></td>
                            <td><?php echo tanggal_indo(date('Y-m-d',strtotime($order->tanggal_transaksi)),true); ?></td>
                            <td>Rp. <?php echo number_format($order->total_bayar,'0',',','.') ?></td>
                            <td><?php 
                              $status = $order->status_bayar;
                              if($status==0){
                                echo "<span style='color:red;'>Belum Bayar</span>";
                              }else{
                                echo "<span style='color:green;'>Sudah Bayar</span>";
                              } ?></td>
                            <td>
                                <a href="#" class="btn btn-success btn-sm">
                                    <span class="text">Konfirmasi Pembayaran</span>
                                </a>
                                <?php include('batal.php') ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<!-- Modal -->