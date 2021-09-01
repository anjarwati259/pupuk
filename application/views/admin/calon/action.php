<?php if($calon->status==2){ ?>
  <div class="input-group-btn">
    <button type="button" class="btn btn-success dropdown-toggle disabled" data-toggle="dropdown">Action
      <span class="fa fa-caret-down"></span></button>
    <ul class="dropdown-menu">
      <li><a href="#">Ubah</a></li>
      <li><a href="#">Edit</a></li>
    </ul>
  </div>
<?php }else{ ?>
<div class="input-group-btn">
    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Action
      <span class="fa fa-caret-down"></span></button>
    <ul class="dropdown-menu">
      <li><a href="#" data-toggle="modal" data-target="#ubah<?php echo $calon->id_calon ?>">Ubah</a></li>
      <li><a href="<?php echo base_url('admin/pelanggan/edit_calon/'.$calon->id_calon) ?>">Edit</a></li>
    </ul>
  </div>
<?php } ?>

<div class="modal fade" id="ubah<?php echo $calon->id_calon ?>">
  <div class="modal-dialog" style="width: 250px;">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #F0F8FF;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ubah Calon Pelanggan</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open(base_url('admin/pelanggan/ubah/'.$calon->id_calon)); ?>
        <form role="form">
          <div class="box-body">
            <div class="form-group">
              <label>Ubah Sebagai : </label>
              <select class="form-control" name="jenis_pelanggan">
                <option value="Customer">Customer</option>
                <option value="Mitra">Mitra</option>
                <option value="Distributor">Distributor</option>
              </select>
              <!-- /.input group -->
            </div>
          </div>
          <input type="hidden" name="id_marketing" value="<?php echo $calon->id_marketing ?>">
          <input type="hidden" name="nama_pelanggan" value="<?php echo $calon->nama_calon ?>">
          <input type="hidden" name="no_hp" value="<?php echo $calon->no_hp ?>">
          <input type="hidden" name="alamat" value="<?php echo $calon->alamat ?>">
          <input type="hidden" name="kecamatan" value="<?php echo $calon->kecamatan ?>">
          <input type="hidden" name="kabupaten" value="<?php echo $calon->kabupaten ?>">
          <input type="hidden" name="provinsi" value="<?php echo $calon->provinsi ?>">
          <input type="hidden" name="komiditi" value="<?php echo $calon->komoditi ?>">

          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right">Save</button>
          </div>
        </form>
        <?php echo form_close() ?>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!-- reminder -->
<div class="modal fade" id="reminder<?php echo $calon->id_calon ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #F0F8FF;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Reminder</strong></h4>
      </div>
      <div class="modal-body">
        <?php echo form_open(base_url('admin/pelanggan/reminder/'.$calon->id_calon)); ?>
        <form role="form">
          <div class="box-body">
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Tanggal Bayar</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="tanggal" class="form-control pull-right" id="datepicker" value="<?php echo date("Y-m-d") ?>">
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>
                <div class="col-md-6">
                   <label >Judul</label>
                    <input type="text" name="judul" value="Reminder Calon Pelanggan <?php echo $calon->nama_calon ?>" placeholder="Judul" class="form-control">
                </div>
              </div>
              <div class="form-group">
                  <label>Deskripsi</label>
                  <textarea style="height: 150px;" name="deskripsi" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right">Save</button>
          </div>
        </form>
        <?php echo form_close() ?>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>