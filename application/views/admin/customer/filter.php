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
        <?php echo form_open(base_url('admin/pelanggan/lap_tahun')); ?>
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

<!-- Modal filter tanggal -->
<div class="modal fade" id="tanggal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #F0F8FF;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Filter By Tanggal</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open(base_url('admin/pelanggan/lap_tanggal')); ?>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Mulai Tanggal</label>

              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="tgl_awal" class="form-control pull-right" id="datepicker2" required>
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
                <input type="text" name="tgl_akhir" class="form-control pull-right" id="datepicker" required>
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
        <?php echo form_open(base_url('admin/pelanggan/lap_bulan')); ?>
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