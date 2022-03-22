<div class="content">
  <div class="container-fluid" style="padding: 0 50px 0 50px;">
    <div class="row">
      <div class="col-md-6">
        <div class="card card-outline card-primary">
          <div class="card-header">
            <h3 class="card-title">Form Expedisi</h3>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body pt-1">
            <div class="form-group">
                <label class="control-label" for="id_customer">Kode</label>
                <input type="text" id="id" class="form-control" disabled />
            </div>
            <div class="form-group">
                <label class="control-label" for="id_customer">Nama Ekspedisi</label>
                <input type="text" id="ekspedisi" class="form-control"/>
            </div>
            <input type="hidden" name="kode" id="kode" value="tambah">
          </div>
          <div class="modal-footer justify-content-right">
            <button type="button" class="btn btn-danger">Cancel</button>
            <button type="button" class="btn btn-info" id="btn_submit">Simpan</button>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
      <div class="col-md-6">
        <div class="card card-outline card-primary">
          <div class="card-header">
            <h3 class="card-title">Data Expedisi</h3>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body pt-1">
            <div class="scrollmenu">
              <table class="table" id="tabel1">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Ekspedisi</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no=1; foreach ($ekspedisi as $key => $value) {?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $value->expedisi; ?></td>
                    <td style="max-width: 50px;"><div class="btn-group">
                  <button type="button" class="btn btn-info">Action</button>
                  <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <div class="dropdown-menu" role="menu">
                    <button class="dropdown-item btn-expedisi" data-expedisi="<?php echo $value->id_expedisi ?>">Edit</button>
                    <a href="<?php echo base_url('/office/admin/del_expedisi/'.$value->id_expedisi)?>" class="dropdown-item" onclick="return confirm('Apakah anda yakin ingin membatalkan transaksi ini?')">Hapus</a>
                  </div>
                </div></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
      <!-- /.card -->
  </div>
</div>

