<style type="text/css">
  .foot{
    display: flex;
  }
  .foot .excel{
    margin-left: 5px;
  }
</style>
<div class="col-md-12">
  <!-- Box Comment -->
  <div class="box box-widget">
    <div class="box-header with-border">
     <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Form Filter</h3>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <form role="form">
            <div class="box-body">
              <div class="form-group">
                  <label for="exampleInputEmail1">Filter Laporan By</label>
                  <select name='filter' class="form-control" id="filter">
                    <option>--- Pilih ---</option>
                    <option value="1">Tanggal</option>
                    <option value="2">Bulan</option>
                    <option value="3">Tahun</option>
                  </select>
                </div>
            </div>
          </form>
          <div class="box-footer">
            <button type="submit" class="btn btn-success" id="proses">Proses</button>
            <button type="submit" class="btn btn-danger" onclick="location.reload();">Reset</button>
          </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-7">
          <div class="form-filter">
            <!-- Tanggal -->
            <div class="box box-primary box-solid" id="tanggal">
              <div class="box-header with-border">
                <h3 class="box-title">Laporan Berdasarkan Tanggal</h3>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <?php echo form_open(base_url('admin/order/lap_tanggal')); ?>
              <!-- <form role="form"> -->
                <div class="box-body">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Mulai Tanggal</label>

                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="tgl_awal" class="form-control pull-right" id="datepicker" required>
                      </div>
                      <!-- /.input group -->
                    </div>
                  </div>
                  <div class="col-sm-6">
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
                  <!-- /.form group -->
                </div>
              <!-- </form> -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info">Proses</button>
                <?php echo form_close(); ?>
                <!-- <button type="submit" class="btn btn-success">Print</button> -->
              </div>
            </div>
            <!-- /.box-body -->

            <!-- bulan -->
            <div class="box box-primary box-solid" id="bulan">
              <div class="box-header with-border">
                <h3 class="box-title">Laporan Berdasarkan Bulan</h3>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
                <div class="box-body">
                  <?php echo form_open(base_url('admin/order/lap_bulan')); ?>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Pilih Tahun</label>

                      <div class="form-group">
                        <select name='tahun' class="form-control" id="tahun">
                          <option>--- Pilih ---</option>
                          <option value="2021">2021</option>
                          <option value="2022">2022</option>
                          <option value="2023">2023</option>
                          <option value="2024">2024</option>
                          <option value="2025">2025</option>
                        </select>
                      </div>
                      <!-- /.input group -->
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Mulai Bulan</label>

                      <div class="form-group">
                        <select name='bln_awal' class="form-control" id="awal">
                          <option>--- Pilih ---</option>
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
                      <!-- /.input group -->
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Sampai Bulan</label>

                      <div class="form-group">
                        <select name='bln_akhir' class="form-control" id="akhir">
                          <option>--- Pilih ---</option>
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
                      <!-- /.input group -->
                    </div>
                  </div>
                  <!-- /.form group -->
                </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-info">Proses</button>
                <?php echo form_close() ?>
                <!-- <button type="submit" class="btn btn-success">Print</button> -->
              </div>
            </div>
            <!-- /.box-body -->

            <!-- Tahun -->
            <div class="box box-primary box-solid" id="year">
              <div class="box-header with-border">
                <h3 class="box-title">Laporan Berdasarkan Tahun</h3>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="col-sm-12">
                  <?php echo form_open(base_url('admin/order/lap_tahun')); ?>
                  <div class="form-group">
                    <label>Mulai Tanggal</label>
                    <div class="form-group">
                      <select name='tahun2' class="form-control" id="tahun2">
                        <option>--- Pilih Tahun---</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                      </select>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>
                <!-- /.form group -->
              </div>
              <div class="box-footer foot">
                <button type="submit" class="btn btn-info">Proses</button>
                <?php echo form_close() ?>

                <!-- <?php echo form_open('admin/order/excel') ?>
                <input type="text" name="year" id="year">
                <button type="submit" class="btn btn-success excel">Export Excel</button>
                <?php echo form_close(); ?> -->
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
    </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $("#tanggal").hide();
  $("#year").hide();
  $("#bulan").hide();
  $(document).ready(function(){

    $('body').on("click","#proses",function(){
      var id = $('#filter option:selected').val();
      if(id == 1){
      $("#tanggal").show();
      $("#bulan").hide();
      $("#year").hide();
      }else if(id == 2){
      $("#bulan").show();
      $("#tanggal").hide();
      $("#year").hide();
      }else if(id == 3){
      $("#year").show();
      $("#tanggal").hide();
      $("#bulan").hide();
      }
    });
  });
</script>