  <?php 
    //error upload
    if(isset($error)){
      echo '<p class="alert alert-warning">';
      echo $error;
      echo '</p>';
    }
    //Notifikasi error
    echo validation_errors('<div class = "alert alert-warning">','</div>');
     ?>
<!-- START CUSTOM TABS -->
      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li><a href="#tab_1" data-toggle="tab">Tambah Data Pelanggan</a></li>
              <li class="active"><a href="#tab_2" data-toggle="tab">Data Mitra</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_2">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Data Table With Full Features</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body scrollmenu">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No</th>
                        <th>Tanggal Gabung</th>
                        <th>Nama</th>
                        <th>No. Hp</th>
                        <th>Kabupaten</th>
                        <?php if($this->session->userdata('hak_akses')=='1'){ ?>
                        <th>Marketing</th>
                      <?php } ?>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $no=1; foreach ($mitra as $mitra) { 
                        $nohp = $mitra->no_hp;
                      $hp = preg_replace("/[^0-9]/", "", $nohp);
                      $no1 = substr($hp,0,1);
                      $a = substr($hp,1);
                      
                      if($no1 == '0'){
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
                        $market_id = $mitra->id_marketing;
                      }
                        ?>
                      <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo tanggal(date('Y-m-d',strtotime($mitra->tanggal_daftar))); ?></td>
                        <td ><a href="<?php echo base_url('admin/pelanggan/detail/'.$mitra->id_pelanggan) ?>"><?php echo $mitra->nama_pelanggan ?></a></td>
                        <td><?php echo $mitra->no_hp ?></td>
                        <td><?php echo $mitra->kabupaten ?></td>
                        <?php if($this->session->userdata('hak_akses')=='1'){ ?>
                        <td><?php echo $mitra->nama_marketing ?></td>
                      <?php } ?>
                        
                        <?php if($this->session->userdata('hak_akses')=='1'){ ?>
                        <td>
                          <div class="input-group-btn">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Action
                              <span class="fa fa-caret-down"></span></button>
                            <ul class="dropdown-menu">
                              <li><a href="#" class="follow" data-toggle="modal" data-target="#follow-up" data-id="<?php echo $mitra->id_pelanggan; ?>" data-no="<?php echo $no_hp; ?>" data-market="<?php echo $market_id; ?>">Follow Up</a></li>
                              <li><a href="#" class="detail" data-toggle="modal" data-target="#ubah" data-id="<?php echo $mitra->id_pelanggan; ?>" data-nama="<?php echo $mitra->nama_pelanggan; ?>">Detail</a></li>
                              <li><a href="<?php echo base_url('admin/pelanggan/edit_customer/'.$mitra->id_pelanggan) ?>">Edit</a></li>
                              <li><a href="<?php echo base_url('admin/pelanggan/delete/'.$mitra->id_pelanggan) ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini? Dengan menghapus data ini, data order anda yang berkaitan dengan data ini juga akan ikut terhapus.')" > Hapus</a></li>
                            </ul>
                          </div>
                        </td>
                      <?php }else{ ?>
                        <td>
                          <div class="input-group-btn">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Action
                              <span class="fa fa-caret-down"></span></button>
                            <ul class="dropdown-menu">
                              <li><a href="#" class="follow" data-toggle="modal" data-target="#follow-up" data-id="<?php echo $mitra->id_pelanggan; ?>" data-no="<?php echo $no_hp; ?>" data-market="<?php echo $market_id; ?>">Follow Up</a></li>
                              <li><a href="#" class="detail" data-toggle="modal" data-target="#ubah" data-id="<?php echo $mitra->id_pelanggan; ?>" data-nama="<?php echo $mitra->nama_pelanggan; ?>">Detail</a></li>
                            </ul>
                          </div>
                        </td>
                      <?php } ?>
                      </tr>
                    <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_1">
                <?php 
                // Form open
              echo form_open_multipart(base_url('admin/pelanggan/add_mitra'), ' class="form-horizontal"');
                 ?>
                <form class="form-horizontal" method="POST">
                  <div class="box-body">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-sm-4 control-label" for="id_customer">ID</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" value="<?php echo $id ?>" disabled/>
                          <input type="hidden" name="id_pelanggan" class="form-control" value="<?php echo (isset($id))?$id:'';?>"/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label">Nama Mitra</label>
                        <div class="col-sm-8">
                          <input type="text" value="<?php echo set_value('nama_pelanggan') ?>" name="nama_pelanggan" placeholder="Nama Customer" class="form-control" required/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label" for="alamat">Alamat</label>
                        <div class="col-sm-8">
                          <textarea name="alamat" value="<?php echo set_value('alamat') ?>" placeholder="Alamat" class="form-control"/></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label">Provinsi</label>
                        <div class="col-sm-8">
                          <select class="form-control" id="form_prov" name="provinsi">
                            <?php foreach ($provinsi as $provinsi) { ?>
                            <option value="<?php echo $provinsi->kode ?>"><?php echo $provinsi->nama ?></option>
                          <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label">Kabupaten/Kota</label>
                        <div class="col-sm-8">
                          <select class="form-control" id="form_kab" name="kabupaten">
                            <option></option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label">Kecamatan</label>
                        <div class="col-sm-8">
                          <select class="form-control" id="form_kec" name="kecamatan">
                            <option></option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="col-sm-4 control-label">Tanggal Daftar</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" value="<?php echo date('Y-m-d'); ?>" disabled/>
                          <input type="hidden" name="tanggal_daftar" value="<?php echo date("Y-m-d");?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label" for="no_hp">No Telp</label>
                        <div class="col-sm-8">
                          <input type="text" value="<?php echo set_value('no_hp') ?>" name="no_hp" placeholder="No. HP" class="form-control"/>
                        </div>
                      </div>
                      <?php if($this->session->userdata('hak_akses')=='1'){ ?>
                      <div class="form-group">
                        <label class="col-sm-4 control-label" for="no_hp">Marketing</label>
                        <div class="col-sm-8">
                          <select class="form-control" name="id_marketing">
                            <?php foreach ($marketing as $market) { ?>
                            <option value="<?php echo $market->id_marketing ?>"> <?php echo $market->nama_marketing ?></option>
                          <?php } ?>
                          </select>
                        </div>
                      </div>
                    <?php }else{ ?>
                      <input type="hidden" name="id_marketing" value="<?php echo $market->id_marketing ?>">
                    <?php } ?>
                    <div class="form-group">
                      <label class="col-sm-4 control-label" for="no_hp">Jenis Pelanggan</label>
                      <div class="col-sm-8">
                        <select class="form-control" name="jenis_pelanggan">
                          <option value="Customer">Customer</option>
                          <option value="Mitra">Mitra</option>
                          <option value="Distributor">Distributor</option>
                        </select>
                      </div>
                    </div>

                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <div class="col-md-3 col-md-offset-4">
                      <a href="<?php echo base_url('admin/pelanggan/mitra') ?>" class="btn btn-default">Cancel</a>
                      <button class="btn btn-info pull-right" type="submit">Save</button>
                    </div>
                  </div>
                  <!-- /.box-footer -->
                  <input type="hidden" name="kab" id="kab">
                  <input type="hidden" name="kec" id="kec">
                  <input type="hidden" name="prov" id="prov">
                </form>
                <?php echo form_close(); ?>
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
<script type="text/javascript">
  $(document).ready(function(){

      // ambil data kabupaten ketika data memilih provinsi
      $('body').on("change","#form_prov",function(){
        var id = $(this).val();
        var data = "id="+id+"&data=kabupaten";
        $.ajax({
          type: 'POST',
          url: "<?php echo base_url('wilayah/get_wilayah'); ?>",
          data: data,
          success: function(hasil) {
             $("#form_kab").html(hasil);
            //alert("sukses");
          }
        });
      });

      // ambil data kecamatan/kota ketika data memilih kabupaten
      $('body').on("change","#form_kab",function(){
        var id = $(this).val();
        var data = "id="+id+"&data=kecamatan";
        $.ajax({
          type: 'POST',
          url: "<?php echo base_url('wilayah/get_wilayah'); ?>",
          data: data,
          success: function(hasil) {
            $("#form_kec").html(hasil);
          }
        });
      });

       //get provinsi
      $('body').on("change","#form_prov",function(){
        var id=$(this).val();
        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('wilayah/getprov'); ?>",
            dataType : "JSON",
            data : {id: id},
            cache:false,
            success: function(data){
                $.each(data,function(nama){
                    $('[name="prov"]').val(data.nama);
                     
                });
                 
            }
        });
        return false; 
      });

      //get kabupaten
    $('body').on("change","#form_kab",function(){
        var datakab = $("option:selected", this).attr('datakab');
          $("input[name=kab]").val(datakab);
      });
    //get kecamatan
    $('body').on("change","#form_kec",function(){
        var datakec = $("option:selected", this).attr('datakec');
          $("input[name=kec]").val(datakec); 
      });
    });
</script>

<?php include(APPPATH.'views/admin/customer/ajax.php'); ?>
