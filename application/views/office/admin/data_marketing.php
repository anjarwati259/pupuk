<div class="content">
  <div class="container-fluid" style="padding: 0 50px 0 50px;">
      <div class="card card-outline card-primary">
        <div class="card-header">
          <!-- <h3 class="card-title">Success Outline</h3> -->
          <!-- /.card-tools -->
          <div class="">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-input">
              Tambah
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body pt-1">
          <div class="scrollmenu">
            <table class="table" id="tabel1">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama</th>
                  <th>No.Telpon</th>
                  <th style="max-width: 100px;">Alamat</th>
                  <!-- <th>Foto</th> -->
                  <th>Status</th>
                  <th>Username</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($marketing as $key => $value) {?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $value->nama_marketing ?></td>
                  <td><?php echo $value->no_hp ?></td>
                  <td style="width: 200px;"><?php echo $value->alamat ?></td>
                  <!-- <td><?php echo $value->foto ?></td> -->
                  <td><?php if($value->status==1){
                        echo "Marketing";
                      }else{
                        echo "Freelance";
                      } ?>
                  </td>
                  <td><?php echo $value->username ?></td>
                  <td>
                    <button type="button" class="btn btn-info btn-sm btn-market" data-market="<?php echo $value->id_marketing; ?>" data-toggle="modal" data-target="#modal-edit">Edit</button>
                    <?php if ($value->status==1) { ?>
                      <a href="<?php echo base_url('/office/admin/nonaktif/'.$value->id_marketing)?>" class="btn btn-success btn-sm" onclick="return confirm('Apakah anda yakin ingin menonaktifkan akun mareketing ini?')">Aktif</a>
                  <?php }else{ ?>
                    <button type="button" class="btn btn-default btn-sm btn-aktif" data-toggle="modal" data-target="#modal-setting" data-market="<?php echo $value->id_marketing; ?>" data-kode="nonaktif">NonAktif</button>
                  <?php } ?>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
  </div>
</div>

<!-- modal input pelanggan -->
<div class="modal fade" id="modal-input">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Marketing</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
                    <label class="control-label" for="id_customer">ID</label>
                    <input type="text" id="id_marketing" value="<?php echo $id_marketing ?>" class="form-control" disabled/>
                </div>
                <div class="form-group">
                    <label class="control-label" for="id_customer">Nama Marketing</label>
                    <input type="text" id="nama_marketing" class="form-control"/>
                </div>
                <div class="form-group">
                    <label class="control-label" for="id_customer">No. HP</label>
                    <input type="text" id="no_hp" class="form-control"/>
                </div>

                <div class="form-group">
                    <label class="control-label">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="1">Marketing</option>
                        <option value="0">Freelance</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label" for="id_customer">Alamat</label>
                    <textarea style="min-height: 100px;" id="alamat" placeholder="Alamat" class="form-control"/></textarea>
                </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-primary" id="input-marketing">Simpan</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- modal edit pelanggan -->
<div class="modal fade" id="modal-edit">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Marketing</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
                    <label class="control-label" for="id_customer">ID</label>
                    <input type="text" id="id_marketing_edit" class="form-control" disabled/>
                </div>
                <div class="form-group">
                    <label class="control-label" for="id_customer">Nama Marketing</label>
                    <input type="text" id="nama_marketing_edit" class="form-control"/>
                </div>
                <div class="form-group">
                    <label class="control-label" for="id_customer">No. HP</label>
                    <input type="text" id="no_hp_edit" class="form-control"/>
                </div>

                <div class="form-group">
                    <label class="control-label">Status</label>
                    <select class="form-control" id="status_edit" name="status_edit">
                        <option value="1">Marketing</option>
                        <option value="0">Freelance</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label" for="id_customer">Alamat</label>
                    <textarea style="min-height: 100px;" id="alamat_edit" placeholder="Alamat" class="form-control"/></textarea>
                </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-primary" id="edit-marketing">Simpan</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- modal edit pelanggan -->
<div class="modal fade" id="modal-setting">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Konfigurasi User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
                <label class="control-label" for="id_marketingcustomer">Username</label>
                <input type="text" id="username" class="form-control"/>
            </div>
            <div class="form-group">
                <label class="control-label" for="id_customer">Password</label>
                <input type="text" id="password" class="form-control"/>
            </div>
            <input type="text" id="kode">
            <input type="text" id="id_market">
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-primary" id="submit">Simpan</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>