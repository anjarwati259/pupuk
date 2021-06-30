<style type="text/css">
     td,th{
    color: #121212;
    text-align: center;
  }
</style>
<!-- Begin Page Content -->
<div class="container">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Reward Mitra</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jumlah Point</th>
                            <th>Target Point</th>
                            <th>Reward</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1;
                        if(isset($point->total_point)){ 
                            $total_point = $point->total_point;
                        }else{
                            $total_point = 0;
                        }
                        foreach ($reward as $reward) { ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td>
                                <?php 
                                echo $total_point
                                    ?>  
                            </td>
                            <td><?php echo $reward->pencapaian ?></td>
                            <td><?php echo $reward->reward ?></td>
                            <td>
                                <?php if($total_point >= $reward->pencapaian){ ?>
                                <a href="<?php echo base_url('mitra/tukar_reward/'.$reward->id_reward) ?>" type="submit" class="btn btn-primary check">Tukarkan</a>
                            <?php }else{ ?>
                                <a href="#" type="submit" class="btn btn-primary check disabled">Tukarkan</a>
                            <?php } ?>
                            </td>
                        </tr>

                        <?php $no++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Begin Page Content -->
<div class="container">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Riwayat Penukaran</h6>
        </div>
        <div class="card-body">
           <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jumlah Point</th>
                            <th>Reward</th>
                            <th>Tanggal</th>
                            <th>status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1;
                        foreach ($pencairan as $pencairan) { ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $pencairan->pencapaian ?></td>
                            <td><?php echo $pencairan->reward ?></td>
                            <td><?php echo $pencairan->waktu_pencairan ?></td>
                            <td>
                                <?php if($pencairan->status==0){
                                    echo "<span style='color:orange;'>Diproses</span>";
                                }else{
                                    echo "<span style='color:orange;'>Berhasil</span>";
                                }
                                  ?>
                            </td>
                        </tr>
                        <?php $no++; } ?>
                    </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="sukses">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="alert alert-success" role="alert">
          <h4 class="alert-heading">Selamat Anda Telah Menukarkan Point Anda</h4>
          <p>Penukaran Anda Telah Diterima, Tim kami Akan Segera Memproses Penukaran Anda </p>
          <hr>
          <p class="mb-0">Jika Masih Ada Pertanyaan Silahkan Hubungi Kami Di Nomor WatsApp Berikut (081335005334) atau bisa Klik Tombol Dibawah Ini</p>
        </div>
      </div>
      <div class="modal-footer">
        <a href="https://wa.me/6281335005334" class="btn btn-success"><i class="fab fa-whatsapp"></i> Hubungi Kami</button>
        <a href="<?php echo base_url('mitra/reward') ?>" class="btn btn-danger"><i class="fa fa-times"></i> Close</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<?php
    if($this->session->flashdata('sukses')){
        echo "
            <script type=\"text/javascript\">
                $(window).on('load', function() {
                    $('#sukses').modal('show');
                });
            </script>
        ";
     }
  ?>