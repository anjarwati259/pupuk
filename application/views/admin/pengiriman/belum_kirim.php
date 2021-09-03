<style type="text/css">
  .label_filter{
    width: 50px;
  }
  .filter{
    width: 200px;
  }
  @media screen and (max-width: 640px) {
    .filter{
      margin-left: auto;
      margin-right: auto;
      top: 0px;
      width: 250px;
    }
    })
</style>
<div class="row">
  <div class="col-md-12">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Belum Dikirim</a></li>
        <li><a href="<?php echo site_url('pengiriman/sudah_dikirim');?>">Sudah Dikirim</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active scrollmenu" id="tab_1">
          <div class="filter_group" style="display: flex; margin-top: 20px; margin-bottom: 20px;">
              <!-- filter -->
              <!-- <div class="form-group" style="padding-right: 20px; display: flex;">
                <label class="control-label label_filter">Filter : </label>
                <div class="filter">
                  <select class="form-control" id="filter" name="filter">
                    <option value="">Semua</option>
                    <option value="Customer">Customer</option>
                    <option value="Mitra">Mitra</option>
                  </select>
                </div>
              </div> -->
            </div>
          <table id="example" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Kode Invoice</th>
              <th>Marketing</th>
              <th>Nama</th>
              <th>No. HP</th>
              <th>Ekspedisi</th>
              <th>Jumlah<br>Item</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
              <?php $no=1; foreach ($belum_kirim as $belum_kirim) { 
                  $nohp = $belum_kirim->no_hp;
                  $hp = preg_replace("/[^0-9]/", "", $nohp);
                  $no = substr($hp,0,1);
                  $a = substr($hp,1);
                  
                  if($no == '0'){
                    $no_hp = '62'.$a;
                  }else{
                    $no_hp = $hp;
                  }
                  $tgl = date('Y-m-d');
                ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo tanggal(date('Y-m-d',strtotime($belum_kirim->tanggal_transaksi)),FALSE) ?></td>
                <td><a href="<?php echo base_url('admin/order/detail/'.$belum_kirim->kode_transaksi) ?>"><?php echo $belum_kirim->kode_transaksi ?></a></td>
                <td><?php echo $belum_kirim->nama_marketing ?></td>
                <td><?php echo $belum_kirim->nama_pelanggan ?></td>
                <td><?php echo $no_hp ?></td>
                <td><?php echo $belum_kirim->expedisi ?></td>
                <td><?php echo $belum_kirim->total_item ?></td>
                <td>
                  <?php if($belum_kirim->metode_pembayaran==0){
                    echo "<span class='alert-danger'>COD</span>";
                  }else if($belum_kirim->metode_pembayaran==1){
                    echo "<span class='alert-warning'>Transfer Bank</span>";
                  }else{
                    echo "<span class='alert-success'>Cash</span>";
                  } ?>
                </td>

                <?php
                 if($this->session->userdata('hak_akses')=='1' || $this->session->userdata('hak_akses')=='6'){ 
                  $id_user = $this->session->userdata('id_user');
                  $this->db->select('id_marketing');
                  $this->db->where('id_user', $id_user);
                  $this->db->from('tb_marketing');
                  $id = $this->db->get()->row();
                  $id_marketing = $id->id_marketing;
                }else{
                  $id_marketing = $belum_kirim->id_marketing;
                }
                ?>
                <td>
                  <div class="input-group-btn">
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Action
                      <span class="fa fa-caret-down"></span></button>
                    <ul class="dropdown-menu">
                      <li><a href="#" class="edit_button"
                        data-toggle="modal" data-target="#myModal"
                        data-id="<?php echo $belum_kirim->kode_transaksi; ?>"
                        data-nama="<?php echo $belum_kirim->nama_pelanggan; ?>"
                        data-kab="<?php echo $belum_kirim->kabupaten; ?>"
                        data-resi="<?php echo $belum_kirim->no_resi; ?>">
                      Input Resi</a></li>
                      <li><a href="#" class="follow_button"
                        data-toggle="modal" data-target="#follow"
                        data-ekspedisi="<?php echo $belum_kirim->expedisi; ?>"
                        data-id="<?php echo $belum_kirim->kode_transaksi; ?>"
                        data-nama="<?php echo $belum_kirim->nama_pelanggan; ?>"
                        data-hp="<?php echo $no_hp; ?>"
                        data-market="<?php echo $id_marketing; ?>"
                        data-pelanggan="<?php echo $belum_kirim->id_pelanggan; ?>"
                        data-resi="<?php echo $belum_kirim->no_resi; ?>">Follow Up</a></li>
                    </ul>
                  </div>
                </td>
              </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->
  </div>
  <!-- /.col -->

<!-- input resi -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #F0F8FF;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><label id="nama"></label> <label>-</label> <label id="kab"></label></h4>
        </div>
        <div class="modal-body">
          <?php echo form_open(base_url('pengiriman/input_resi')); ?>
          <form role="form">
            <div class="box-body">
              <div class="form-group">
                <label style="text-align: center; display: block;">Nomor Resi Pengiriman</label>
                <input type="text" name="no_resi" id="no_resi" class="form-control" placeholder="No Resi">
                <input type="hidden" name="kode_transaksi" id="kode_transaksi">
                <!-- /.input group -->
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
  </div>

  <!-- follow up -->
  <div class="modal fade" id="follow">
    <div class="modal-dialog" style="width: 400px;">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #F0F8FF;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><label>Clossing</label></h4>
        </div>
        <div class="modal-body">
          <!-- <?php echo form_open(base_url('pengiriman/follow')); ?> -->
          <form role="form">
            <div class="box-body">
              <label style="margin-bottom: 20px;">Nama : <label id="nama_pelanggan"></label></label>
              <div class="form-group">
                <label>No. Telp</label>
                <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="No Telp" style="font-size: 18px;">
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <label>Text</label>
                <textarea class="form-control" style="height: 180px; font-size: 18px;" id="text"></textarea>
                <!-- /.input group -->
              </div>
            </div>

            <input type="hidden" name="id_pelanggan" id="id_pelanggan" class="form-control">

            <input type="hidden" name="id_marketing" id="id_marketing" class="form-control">
                <!-- /.input group -->
              </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right" id="btn-submit">Kirim</button>
            </div>
          </form>
          <!-- <?php echo form_close() ?> -->
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <script type="text/javascript">
    $(document).on( "click", '.edit_button',function(e) {
      var id = $(this).data('id');
      var nama = $(this).data('nama');
      var kab = $(this).data('kab');
      var resi = $(this).data('resi');
      //alert(resi);
      $("#nama").text(nama);
      $("#kab").text(kab);
      $("#kode_transaksi").val(id);
      $("#no_resi").val(resi); 
    });
    $(document).on( "click", '.follow_button',function(e) {
      var id = $(this).data('id');
      var nama = $(this).data('nama');
      var no_hp = $(this).data('hp');
      var resi = $(this).data('resi');
      var id_marketing = $(this).data('market');
      var id_pelanggan = $(this).data('pelanggan');
      var ekspedisi = $(this).data('ekspedisi');

      var text = 'Selamat sore Bapak/ibu '+nama+ ' dengan saya Namira dari PT Agrikultur Gemilang Indonesia..\n\n'+'Terimakasih '+nama+ ' Telah Belanja di toko kami\n' + 'Berikut Nomor Resinya : '+resi+'\n'+'Menggunakan Ekspedisi : '+ekspedisi+'\n\n'+'Kami tunggu kabar baiknya, semoga pupuk kilat bisa membantu menyuburkan tanaman bapak/ibu '+nama;

      $('#text').text(text);
      //alert(id_marketing);
      $("#nama_pelanggan").text(nama);
      $("#kab").text(kab);
      $("#no_hp").val(no_hp);
      $("#no_resi").val(resi); 
      $("#id_marketing").val(id_marketing);
      $("#id_pelanggan").val(id_pelanggan);
    });

    $(document).ready(function() {
    $('#btn-submit').on('click', function() {
      var id_Pelanggan = $('#id_pelanggan').val();
      var id_marketing = $('#id_marketing').val();
      var no_hp = $('#no_hp').val();
      var text = $('#text').val();
      var text2 = encodeURI(text);

      var url =  'https://api.whatsapp.com/send?phone='+no_hp+'&text='+text2;
      window.open(url);
      location.reload();

    });
  });
  </script>