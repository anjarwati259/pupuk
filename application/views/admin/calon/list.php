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
                <div class="filter_group" style="display: flex; margin-top: 20px; margin-bottom: 20px;">
              <!-- filter -->
              <div class="form-group" style="padding-right: 20px; display: flex;">
                <label class="control-label label_filter">Filter : </label>
                <div class="filter">
                  <select class="form-control" id="filter" name="filter">
                    <option value="">Semua</option>
                    <option value="Tunggul">Tunggul</option>
                    <option value="Raisa Bani">Raisa Bani</option>
                    <option value="Ardhino Okta">Ardhino Okta</option>
                    <option value="Poppy">Poppy</option>
                    <option value="Frendi Junaidi">Frendi Junaidi</option>
                  </select>
                </div>
              </div>
            </div>
                <div class="box">
                  <div class="box-header">
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="scrollmenu">
                      <table id="example" class="table table-bordered table-striped">
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
                        <th style="width: 120px;">Action</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php $no=1; foreach ($calon as $calon) { ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo tanggal(date('Y-m-d',strtotime($calon->tanggal)),FALSE); ?></td>
                          <td><a href="<?php echo base_url('admin/pelanggan/detail_calon/'.$calon->id_calon) ?>"><?php echo $calon->nama_calon ?></a></td>
                          <td><?php echo $calon->no_hp ?></td>
                          <td><?php echo $calon->komoditi ?></td>
                          <td><?php echo $calon->kabupaten ?></td>
                          <td><?php echo $calon->keterangan ?></td>
                          <td><?php if($calon->status=='1'){ echo 'Adsense';}else{ echo 'Organik';} ?></td>
                          <?php if($this->session->userdata('hak_akses')=='1'){ ?>
                          <td><?php echo $calon->nama_marketing ?></td>
                          <?php } ?>
                          <td><?php include "action.php"; ?></td>
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

      <?php if($this->session->flashdata('sukses')) { ?>
      <script>
        $('#success-alert').slideDown('slow');
        setTimeout(function() {$('#success-alert').slideUp('slow');}, 3100);
      </script>
      <?php }; ?>

