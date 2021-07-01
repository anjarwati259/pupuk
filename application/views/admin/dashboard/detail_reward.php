
  <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Data Mitra</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <tbody>
              <tr>
                <td width="40%">ID Member</td>
                <th><?php echo $pelanggan->id_pelanggan ?></th>
              </tr>
              <tr>
                <td width="40%">Nama Mitra</td>
                <th><?php echo $pelanggan->nama_pelanggan ?></th>
              </tr>
              <tr>
                <td width="40%">No. Hp</td>
                <th><?php echo $pelanggan->no_hp ?></th>
              </tr>
              <tr>
                <td width="40%">Alamat</td>
                <th><?php echo $pelanggan->alamat ?></th>
              </tr>
              <tr>
                <td width="40%">Tanggal Gabung</td>
                <th><?php echo $pelanggan->tanggal_daftar ?></th>
              </tr>
              <tr>
                <td width="40%">Total Pembelian</td>
                <th><?php echo $total->total ?> Botol</th>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Riward Mitra</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Pencapaian</th>
              <th>Reward</th>
              <!-- <th>Total Point</th> -->
            </tr>
            </thead>
            <tbody>
              <?php $no= 1;
              foreach ($reward as $reward) { ?>
            <tr>
              <td><?php echo $no ?></td>
              <td><?php echo $reward->pencapaian ?></td>
              <td><?php echo $reward->reward ?></td>
              <!-- <td>
                <?php if($get_point->total_point >= $reward->pencapaian){ ?>
                <a href="<?php echo base_url('admin/dashboard/detail_reward/') ?>" class="btn btn-warning btn-xs"> Tukarkan</a>
              <?php }else{ ?>
                <a href="#" class="btn btn-warning btn-xs disabled"> Tukarkan</a>
              <?php } ?>
              </td> -->
            </tr>
          <?php $no++; } ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Riwayat Point</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Tanggal</th>
              <th>Invoice</th>
              <th>Point</th>
              <th>Status</th>
              <th>Total</th>
            </tr>
            </thead>
            <tbody>
              <?php $no= 1;
              foreach ($point as $point) { ?>
            <tr>
              <td><?php echo $point->tanggal ?></td>
              <td><?php if($point->kode_transaksi == '-'){
                  echo "<span class='alert-success'>Pencairan</span>";
               }else{
                  echo $point->kode_transaksi;
               } ?></td>
              <td><?php echo $point->point ?></td>
              <td><?php echo $point->status ?></td>
              <td><?php echo $point->total_point ?></td>
            </tr>
          <?php $no++; } ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
    <!-- end col -->
  </div>

<!-- /.container -->