<!-- START CUSTOM TABS -->
<div class="row">
  <div class="col-md-12">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li><a href="<?php echo site_url('marketing/order');?>">Tambah Order</a></li>
      <li role="presentation"><a href="<?php echo site_url('marketing/belum_bayar');?>">Belum Bayar</a></li>
      <li role="presentation" class="active"><a href="<?php echo site_url('marketing/sudah_bayar');?>">Sudah Bayar</a></li>
      </ul>
      <?php
      //notifikasi
      if($this->session->flashdata('sukses')){
        echo '<p class="alert alert-success">';
        echo $this->session->flashdata('sukses');
        echo '</div>';
       }
       ?>
      <div class="tab-content">
        <!-- /.tab-pane -->
        <div class="tab-pane active scrollmenu" id="tab_1">
          <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Kode Invoice</th>
                <th>Nama</th>
                <th>No. HP</th>
                <th>Tanggal</th>
                <th>Jumlah Item</th>
                <th>Jumlah Belanja</th>
                <th>Jumlah Bayar</th>
                <th>Status</th>
                <th>Follow Up</th>
              </tr>
              </thead>
              <tbody>
                <?php
                foreach ($sudah_bayar as $sudah_bayar) { ?>
                    <tr>
                      <td><a href="<?php echo base_url('admin/order/detail/'.$sudah_bayar->kode_transaksi) ?>"><?php echo $sudah_bayar->kode_transaksi ?></a></td>
                      <td><?php echo $sudah_bayar->nama_pelanggan ?></td>
                      <td><?php echo $sudah_bayar->no_hp ?></td>
                      <td><?php echo tanggal(date('Y-m-d',strtotime($sudah_bayar->tanggal_transaksi)),FALSE); ?></td>
                      <td><?php echo $sudah_bayar->total_item ?></td>
                      <td>Rp. <?php echo number_format($sudah_bayar->total_bayar,'0',',','.') ?></td>
                      <td>Rp. <?php echo number_format($sudah_bayar->jumlah_bayar,'0',',','.') ?></td>
                      <td><?php if($sudah_bayar->status_bayar==1 && $sudah_bayar->metode_pembayaran ==1){
                          echo "<span class='alert-success'>Transfer Bank</span>";
                        }else{
                          echo "<span class='alert-success'>COD</span>";
                        }
                    ?></td>
                    <td><button id="follow" class="btn btn-info" style="border-radius: 50%;" data-toggle="modal" data-target="#follow<?= $sudah_bayar->kode_transaksi?>" type="button" role="button">1</button></td>
                    </tr>
              <?php } ?>
              </tbody>
            </table>
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

<!-- Modal Follow Up 1 -->
<?php $i=1; foreach ($follow as $follow) {
$this->db->select('*');
$this->db->where('kode_transaksi', $follow->kode_transaksi);
$this->db->from('tb_order');
$this->db->join('tb_produk', 'tb_produk.kode_produk = tb_order.id_produk', 'left');
$getdataorder= $this->db->get()->result();
 ?>
<div class="modal fade" id="follow<?= $follow->kode_transaksi?>">
  <div class="modal-dialog" style="max-width: 450px;">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #F0F8FF;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">&nbsp; <strong>Welcome <?php echo $i ?></strong></h4>
      </div> 
      <div class="modal-body">
        <!-- <?php echo form_open('admin/order/follow_up') ?> -->
        <div class="form-group">
          <label>Nama :&nbsp; <?php echo $follow->nama_pelanggan ?></label>
        </div>
        <?php 
        $nohp = $follow->no_hp;
        $hp = preg_replace("/[^0-9]/", "", $nohp);
        $no = substr($hp,0,1);
        $a = substr($hp,1);
        
        if($no == '0'){
          $no_hp = '62'.$a;
        }else{
          $no_hp = $hp;
        }
        ?>
        <div class="form-group">
          <label>No Handphone (WhatsApp)</label>
          <input type="text" name="no_hp" class="form-control" value="<?php echo $no_hp ?>" placeholder="Masukkan Password Lama Anda" required>
        </div>
        <div class="form-group">
          <label>Text</label>
          <textarea style="height: 100px;white-space: pre-line;" name="text_wa" id="text_wa<?php echo $i; ?>" placeholder="Isikan Text" class="form-control text"/> <?php

           if ($follow->metode_pembayaran=='1') {
            echo "Transfer Bank";

           }
           if ($follow->metode_pembayaran=='0') {
            echo "COD";

           }
           ?> welcome
            <?php foreach ($getdataorder as $key => $value): ?>
              
              <?php echo $value->nama_produk; ?> jumlah <?php echo $value->jml_beli; ?> X <?php echo rupiah($value->harga); ?> = <?php echo rupiah(($value->jml_beli*$value->harga)); ?>,
            <?php endforeach ?>
yeayyy yuhuuu  <?php echo $follow->no_hp; ?></textarea>
          <input type="text" name="url" id="url">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button class="btn btn-info">Follow Up</button>
      </div>
      <!-- <?php echo form_close() ?> -->
    </div>
  </div>
</div>

<script type="text/javascript">
  var text = $("#text_wa1<?php echo $i; ?>").val();
  var php = '<'+'?'+'php echo $follow->nama_pelanggan'+'?>';
  var rep = text.replaceAll('{',php);
  //var html = php.html();
  var dom_nodes = $($.parseHTML('<div><input type="text" value="val" /></div>'));
  //alert(dom_nodes);
  $('#text_wa<?php echo $i; ?>').val(dom_nodes);
  //alert(text);
</script>
<?php $i++; } ?>
<!-- Modal Follow Up 2 -->

