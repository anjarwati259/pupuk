<?php 
//error upload
if(isset($error)){
  echo '<p class="alert alert-warning">';
  echo $error;
  echo '</p>';
}
//Notifikasi error
echo validation_errors('<div class = "alert alert-warning">','</div>');

// Form open
echo form_open_multipart(base_url('admin/pelanggan/add_calon'), ' class="form-horizontal"');
 ?>
<!-- START CUSTOM TABS -->
      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li role="presentation" class="active"><a href="#tab_1">Tambah Calon Customer</a></li>
            <li role="presentation"><a href="<?php echo site_url('admin/pelanggan/calon_customer');?>">Data Calon Customer</a></li>
            </ul>
            <div class="tab-content">
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="tab_1">
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
                        <label class="col-sm-4 control-label">Nama Customer</label>
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
                      <div class="form-group">
                        <label class="col-sm-4 control-label">Komoditi</label>
                        <div class="col-sm-8">
                          <input type="text" value="<?php echo set_value('komoditi') ?>" name="komoditi" placeholder="Komoditi" class="form-control" required/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label" for="alamat">Keterangan</label>
                        <div class="col-sm-8">
                          <textarea style="height: 100px;" name="keterangan" value="<?php echo set_value('keterangan') ?>" placeholder="Keterangan" class="form-control"/></textarea>
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
                      <label class="col-sm-4 control-label" for="no_hp">Sumber</label>
                      <div class="col-sm-8">
                        <select class="form-control" name="status">
                          <option value="0">Organik</option>
                          <option value="1">Adsense</option>
                        </select>
                      </div>
                    </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <div class="col-md-3 col-md-offset-4">
                      <a href="<?php echo base_url('admin/pelanggan/customer') ?>" class="btn btn-default">Cancel</a>
                      <button class="btn btn-info pull-right" type="submit">Save</button>
                    </div>
                  </div>
                  <!-- /.box-footer -->
                  <input type="hidden" name="kab" id="kab">
                  <input type="hidden" name="kec" id="kec">
                  <input type="hidden" name="prov" id="prov">
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <?php echo form_close(); ?>
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
