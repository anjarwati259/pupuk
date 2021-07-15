<div class="col-md-4">
    <div class="box box-widget widget-user">
      <div class="widget-user-header bg-aqua-active">
        
      </div>

      <div class="widget-user-image">
        <img class="img-circle" src="<?php echo base_url() ?>assets/img/logo/logo_2.png" alt="User Avatar">
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-sm-4 border-right">
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-4 ">
            <div class="description-block">
              <h5 class="description-header"></h5>
              <span style="font-size: 20px;"><b>Melina</b></span>
            </div>
            <form>
              <div class="form-group">
                <input type="file" class="form-control-file" id="exampleFormControlFile1">
              </div>
            </form>
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
          <div class="col-sm-4">
            <!-- /.description-block -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    </div>
  </div>
<div class="col-md-8">
    <div class="box box-primary box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Edit Profil</h3>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label>Nama Lengkap</label>
                  <input type="text" class="form-control" value="<?php echo $marketing->nama_marketing ?>">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control" value="<?php echo $marketing->email ?>">
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-6">
            <form role="form">
              <div class="box-body">
                <div class="form-group">
                  <label>Alamat</label>
                  <input type="text" class="form-control" value="<?php echo $marketing->alamat ?>">
                </div>
                <div class="form-group">
                  <label>No. Hp</label>
                  <input type="text" class="form-control" value="<?php echo $marketing->no_hp ?>">
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <!-- <button class="btn btn-block btn-default"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Ubah Password</button> -->
            <a type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#modal-default"><i class="fa fa-unlock-alt" aria-hidden="true"></i>
              Ubah Password
            </a>
            <button type="submit" class="btn btn-block btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan Perubahan</button>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
    </div>
  </div>

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Default Modal</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>