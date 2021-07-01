<div class="box">
  <div class="box-header">
    <h3 class="box-title">Data Point Mitra</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>ID</th>
        <th>Nama Pelanggan</th>
        <th>Total Point</th>
        <th>Tanggal</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
        <?php $no= 1;
        foreach ($reward as $reward) { ?>
      <tr>
        <td><?php echo $reward->id_pelanggan ?></td>
        <td><?php echo $reward->nama_pelanggan ?></td>
        <td><?php echo $reward->total_point ?></td>
        <td><?php echo $reward->tanggal ?></td>
        <td><a href="<?php echo base_url('admin/dashboard/detail_reward/'.$reward->id_pelanggan) ?>" class="btn btn-warning btn-xs" ><i class="fa fa-search"></i> Detail</a></td>
      </tr>
    <?php $no++; } ?>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->