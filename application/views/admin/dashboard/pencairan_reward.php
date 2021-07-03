<div class="box">
  <!-- /.box-header -->
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>Tanggal</th>
        <th>Nama Pelanggan</th>
        <th>Reward</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
        <?php $no= 1;
        foreach ($pencairan_reward as $value) { ?>
      <tr>
        <td><?php echo $value->waktu_pencairan ?></td>
        <td><?php echo $value->nama_pelanggan ?></td>
        <td><?php echo $value->reward ?></td>
        <td>
          <?php if ($value->status==0){
              echo "Pengajuan";
          }else{
              echo "Disetujui";
          }
        ?></td>
        <td>
          <?php if($value->status==0){ ?>
          <a href="<?php echo base_url('admin/dashboard/konfir_reward/'.$value->id_pencairan_reward) ?>" class="btn btn-warning btn-md" >Verifikasi</a>
        <?php } ?>
        <a href="<?php echo base_url('admin/dashboard/detail_reward/'.$value->id_pelanggan) ?>" class="btn btn-success btn-md" >Detail</a>
        </td>
      </tr>
    <?php $no++; } ?>
  </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->