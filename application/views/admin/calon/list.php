  <?php 
    //error upload
    if(isset($error)){
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
      echo $error;
      echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
      echo '</div>';
    }
    //Notifikasi error
    echo validation_errors('<div class = "alert alert-warning">','</div>');
     ?>
     <div id="success-alert" style="display:none;" class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
      <?php echo $this->session->flashdata('sukses'); ?>
    </div>
<!-- START CUSTOM TABS -->
      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li><a href="<?php echo site_url('admin/pelanggan/add_calon');?>">Tambah Calon Customer</a></li>
              <li class="active"><a href="#tab_2" data-toggle="tab">Data Calon Customer</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_2">
                <div class="box">
                  <div class="box-header">
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="scrollmenu">
                      <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>
                        <th>Tanggal Gabung</th>
                        <th>Nama</th>
                        <th>No. Hp</th>
                        <th>Komoditi</th>
                        <th>Kabupaten</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <?php if($this->session->userdata('hak_akses')=='1'){ ?>
                        <th>Marketing</th>
                      <?php } ?>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php $no=1; foreach ($calon as $calon) { ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $calon->tanggal ?></td>
                          <td><?php echo $calon->nama_calon ?></td>
                          <td><?php echo $calon->no_hp ?></td>
                          <td><?php echo $calon->komoditi ?></td>
                          <td><?php echo $calon->kabupaten ?></td>
                          <td><?php echo $calon->keterangan ?></td>
                          <td><?php if($calon->status=='1'){ echo 'Adsense';}else{ echo 'Organik';} ?></td>
                          <?php if($this->session->userdata('hak_akses')=='1'){ ?>
                          <td></td>
                          <?php } ?>
                          <td>
                            <div class="btn-group">
                              <button type="button" class="btn btn-success">Action</button>
                              <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo base_url('admin/pelanggan/reminder/'.$calon->id_calon);?>">Reminder</a></li>
                                <li><a href="#">Ubah</a></li>
                                <li><a href="#">Edit</a></li>
                              </ul>
                            </div>
                          </td>
                        </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                    </div>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- END CUSTOM TABS -->
      <?php if($this->session->flashdata('sukses')) { ?>
      <script>
        $('#success-alert').slideDown('slow');
        setTimeout(function() {$('#success-alert').slideUp('slow');}, 3100);
      </script>
      <?php }; ?>