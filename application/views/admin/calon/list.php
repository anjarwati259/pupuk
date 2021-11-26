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
              <?php if($this->session->userdata('hak_akses')=='1'){ ?>
              <div class="form-group" style="padding-right: 20px; display: flex;">
                <label class="control-label label_filter">Marketing : </label>
                <div class="filter">
                  <select class="form-control" id="filter" name="filter">
                    <option value="">Semua</option>
                    <?php foreach ($marketing as $marketing) { ?>
                    <option value="<?php echo $marketing->nama_marketing ?>"><?php echo $marketing->nama_marketing ?></option>
                  <?php } ?>
                  </select>
                </div>
              </div>
            <?php } ?>
            <div class="form-group filter-2" style="padding-right: 20px;">
              <div class="filter">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Filter
                    <span class="fa fa-caret-down"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="#" data-toggle="modal" data-target="#tanggal1">Tanggal</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#bulan">Bulan</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#tahun">Tahun</a></li>
                  </ul>
                </div>
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
                        <?php $n=1; foreach ($calon as $calon) { 
                          $nohp = $calon->no_hp;
                      $hp = preg_replace("/[^0-9]/", "", $nohp);
                      $no = substr($hp,0,1);
                      $a = substr($hp,1);
                      
                      if($no == '0'){
                        $no_hp = '62'.$a;
                      }else{
                        $no_hp = $hp;
                      }

                       if($this->session->userdata('hak_akses')=='1'){ 
                        $id_user = $this->session->userdata('id_user');
                        $this->db->select('id_marketing');
                        $this->db->where('id_user', $id_user);
                        $this->db->from('tb_marketing');
                        $data_market = $this->db->get()->row();

                        $market_id = $data_market->id_marketing;
                      }else{
                        $market_id = $calon->id_marketing;
                      }
                          ?>
                        <tr>
                          <td><?php echo $n++; ?></td>
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
      <!-- detail follow up -->
      <div class="modal fade" id="ubah">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #F0F8FF;">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Aktifitas Follow Up</h4>
            </div>
            <div class="modal-body">

               <!-- row -->
                <div class="row">
                  <div class="col-md-12">
                    <!-- The time line -->
                    <ul class="timeline">
                      <!-- timeline time label -->
                      <li class="time-label">
                        <span class="bg-green">
                          Aktivitas Follow Up
                        </span>
                      </li>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <li class="foll-up">
                        <i class="fa fa-envelope bg-blue"></i>

                        <div class="timeline-item">
                          <span class="time" id="time"><i class="fa fa-clock-o"></i> 08 Nov 2021, 3:02</span>

                          <h3 class="timeline-header"><a href="#">Raisa Bani</a> Mengirim Pesan WhatsApp ke <a href="#">Hendro</a></h3>

                          <div class="timeline-body">
                            Ok            
                          </div>
                        </div>
                      </li>
                      <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                        <div class="timeline-item">
                          <h3 class="timeline-header no-border"><a href="#" class="nama_pelanggan"></a> Belum Pernah Di follow Up</h3>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- modal follow up -->
      <div class="modal fade" id="follow-up">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #F0F8FF;">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Follow Up</h4>
            </div>
            <div class="modal-body">
              <div class="group" style="padding: 10px;">
                <div class="form-group">
                  <label for="exampleInputEmail1">Tanggal</label>
                  <input type="text" class="form-control" value="<?php echo tanggal(date('Y-m-d',strtotime(date('Y-m-d'))),FALSE); ?>" id="tanggal" readonly>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1" style="padding-right: 2%;">Follow Up Ke:</label><span class="badge bg-blue total"><!-- <?php $tot = $total->total + 1;
                  echo $tot ?> --></span>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">No WhatsApp</label>
                  <input type="text" class="form-control" id="no_hp">
                </div>
                <div class="form-group">
                  <label>Follow Up Text</label>
                  <textarea style="height: 190px;" class="form-control" rows="3" placeholder="Enter ..." id="text-follow"></textarea>
                </div>
              </div>
              <input type="hidden" name="id_Pelanggan" id="id_pelanggan">
              <input type="hidden" name="id_marketing" id="id_marketing">
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" id="btn-submit" class="btn btn-primary pull-right"><i class="fa fa-paper-plane"></i> &nbsp;&nbsp;Kirim</button>
              </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <!-- filter -->
      <!-- Modal filter tanggal -->
      <div class="modal fade" id="tanggal1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #F0F8FF;">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Filter By Tanggal</h4>
            </div>
            <div class="modal-body">
              <?php echo form_open(base_url('admin/pelanggan/lap_tgl_calon')); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Mulai Tanggal</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="tgl_awal" class="form-control pull-right" id="datepicker3" required>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Sampai Tanggal</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="tgl_akhir" class="form-control pull-right" id="datepicker2" required>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>
              </div>
              
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-defaul" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Filter</button>
            </div>
            <?php echo form_close(); ?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- Modal filter Tahun -->
      <div class="modal fade" id="tahun">
        <div class="modal-dialog" style="width: 350px;">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #F0F8FF;">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Filter By Tahun</h4>
            </div>
            <div class="modal-body">
              <?php echo form_open(base_url('admin/pelanggan/lap_thn_calon')); ?>
              <div class="form-group">
                <label>Tahun</label>

                <select class="form-control" id="tahun2" name="tahun2">
                  <option value="">-- Pilih Tahun --</option>
                  <option value="2021">2021</option>
                  <option value="2022">2022</option>
                  <option value="2023">2023</option>
                  <option value="2024">2024</option>
                  <option value="2025">2025</option>
                </select>
                <!-- /.input group -->
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-defaul" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Filter</button>
            </div>
          </div>
          <?php echo form_close(); ?>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- Modal filter bulan -->
      <div class="modal fade" id="bulan">
        <div class="modal-dialog" style="max-width: 450px;">
          <div class="modal-content">
            <div class="modal-header" style="background-color: #F0F8FF;">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Filter By Bulan</h4>
            </div>
            <div class="modal-body">
              <?php echo form_open(base_url('admin/pelanggan/lap_bln_calon')); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Tahun</label>

                    <select class="form-control" id="tahun" name="tahun" style="width: 180px;">
                      <option value="">-- Pilih Tahun --</option>
                      <option value="2021">2021</option>
                      <option value="2022">2022</option>
                      <option value="2023">2023</option>
                      <option value="2024">2024</option>
                      <option value="2025">2025</option>
                    </select>
                    <!-- /.input group -->
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Bulan</label>

                    <select class="form-control" id="bulan" name="bulan" style="width: 180px;">
                      <option value="">-- Pilih Bulan --</option>
                      <option value="01">Januari</option>
                      <option value="02">Februari</option>
                      <option value="03">Maret</option>
                      <option value="04">April</option>
                      <option value="05">Mei</option>
                      <option value="06">Juni</option>
                      <option value="07">Juli</option>
                      <option value="08">Agustus</option>
                      <option value="09">September</option>
                      <option value="10">Oktober</option>
                      <option value="11">November</option>
                      <option value="12">Desember</option>
                    </select>
                  </div>
                </div>
              </div>
              
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-defaul" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Filter</button>
            </div>
            <?php echo form_close(); ?>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <?php include 'ajax.php'; ?>
      <?php if($this->session->flashdata('sukses')) { ?>
      <script>
        $('#success-alert').slideDown('slow');
        setTimeout(function() {$('#success-alert').slideUp('slow');}, 3100);
      </script>
      <?php }; ?>

