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
                        <th>Alamat</th>
                        <th>Kabupaten</th>
                        <th>Provinsi</th>
                        <?php if($this->session->userdata('hak_akses')=='1'){ ?>
                        <th>Marketing</th>
                      <?php } ?>
                        <?php if($this->session->userdata('hak_akses')=='1'){ ?>
                        <th>Action</th>
                      <?php } ?>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      $no=1; foreach ($mitra as $mitra) { ?>
                      <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo tanggal(date('Y-m-d',strtotime($mitra->tanggal_daftar))); ?></td>
                        <td ><a href="<?php echo base_url('admin/pelanggan/detail/'.$mitra->id_pelanggan) ?>"><?php echo $mitra->nama_pelanggan ?></a></td>
                        <td><?php echo $mitra->no_hp ?></td>
                        <td>
                          <?php echo $mitra->alamat ?><br>  
                        </td>
                        <td><?php echo $mitra->kabupaten ?></td>
                        <td><?php echo $mitra->provinsi ?></td>
                        <?php if($this->session->userdata('hak_akses')=='1'){ ?>
                        <td><?php echo $mitra->nama_marketing ?></td>
                      <?php } ?>
                        
                        <?php if($this->session->userdata('hak_akses')=='1'){ ?>
                        <td>
                          <a href="<?php echo base_url('admin/pelanggan/edit_mitra/'.$mitra->id_pelanggan) ?>" class="btn btn-warning btn-xs" ><i class="fa fa-edit"></i> Edit</a>
                          <a href="<?php echo base_url('admin/pelanggan/delete_mitra/'.$mitra->id_pelanggan) ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?Dengan menghapus data ini, data order anda yang berkaitan dengan data ini juga akan ikut terhapus.')" ><i class="fa fa-trash"></i> Hapus</a>
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
