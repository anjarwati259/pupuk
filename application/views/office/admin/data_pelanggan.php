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
            <table class="table" id="tb_customer">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Tanggal Daftar</th>
                  <th>Marketing</th>
                  <th>Nama</th>
                  <th>No. Telpon</th>
                  <th style="max-width: 150px;">Kabupaten</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
  </div>
</div>

<!-- modal edit pelanggan -->
<div class="modal fade" id="modal-edit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit <?php echo $jenis ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
                    <label class="control-label" for="id_customer">ID</label>
                    <input type="text" id="id_pelanggan_edit" value="<?php echo $id_pelanggan ?>" class="form-control" disabled/>
                </div>
                <div class="form-group">
                    <label class="control-label" for="id_customer">Nama Pelanggan</label>
                    <input type="text" id="nama_pelanggan_edit" class="form-control"/>
                </div>
                <div class="form-group">
                    <label class="control-label" for="id_customer">No. HP</label>
                    <input type="text" id="no_hp_edit" class="form-control"/>
                </div>
                <div class="form-group">
                    <label class="control-label" for="no_hp">Status</label>
                    <select class="form-control" id="status">
                      <option value="0">Organik</option>
                      <option value="1">Adsense</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label" for="id_customer">Marketing</label>
                    <select class="form-control" id="id_marketing_edit">
                        <?php foreach ($marketing as $market) { ?>
                        <option value="<?php echo $market->id_marketing ?>"> <?php echo $market->nama_marketing ?></option>
                      <?php } ?>
                    </select>
                </div>
                <!-- <div class="form-group">
                    <label class="control-label" for="id_customer">Jenis Pelanggan</label>
                    <input type="text" id="jenis_pelanggan" value="<?php echo $jenis ?>" class="form-control" disabled/>
                </div> -->
                <div class="form-group">
                    <label class="control-label" for="jenis_pelanggan_edit">Jenis Pelanggan</label>
                    <select class="form-control" id="jenis_pelanggan">
                      <option value="Customer">Customer</option>
                      <option value="Mitra">Mitra</option>
                      <option value="Distributor">Distributor</option>
                    </select>
                </div>
          </div>
          <div class="col-md-1"></div>
          <div class="col-md-5">
            <div class="form-group">
                    <label class="control-label">Tanggal Daftar</label>
                    <input type="text" class="form-control" id="tanggal_daftar_edit" value="<?php echo date("Y-m-d");?>" disabled>
                </div>
                <div class="form-group">
                    <label class="control-label" for="alamat">Alamat</label>
                    <textarea style="min-height: 120px;" id="alamat_edit" placeholder="Alamat" class="form-control"/></textarea>
                </div>
                <div class="form-group">
                    <label class="control-label">Provinsi</label>
                    <select class="form-control" id="form_prov_edit" name="provinsi">
                        <?php foreach ($prov as $provinsi) { ?>
                        <option value="<?php echo $provinsi->kode ?>"><?php echo $provinsi->nama ?></option>
                      <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Kabupaten/Kota</label>
                    <select class="form-control" id="form_kab_edit" name="kabupaten">
                        <option></option>
                    </select>
                </div>
                  <div class="form-group">
                    <label class="control-label">Kecamatan</label>
                    <select class="form-control" id="form_kec_edit" name="kecamatan">
                        <option></option>
                    </select>
                </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-primary" id="edit-pelanggan">Simpan</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>