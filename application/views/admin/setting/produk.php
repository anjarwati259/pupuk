<style type="text/css">
  th{
    text-align: center;
  }
  td{
    text-align: center;
    vertical-align: middle;
  }
  .bottom-tap{
    padding-top: 10px;
    display: flex;
  }
</style>
<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title">Data Produk</h3>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <br>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th colspan="2">Nama Produk</th>
          <th>Harga Customer</th>
          <th>Harga Mitra</th>
          <th>Harga Distributor</th>
          <th>Action</th>
        </tr> 
        <tbody>
          <?php foreach ($produk as $produk) { ?>
          <tr>
            <td><img src="<?php echo base_url('assets/img/produk/'.$produk->gambar) ?>" class="img img-responsive img-thumbnail" width="80"></td>
            <td><?php echo $produk->nama_produk ?></td>
            <td> Rp. <?php echo number_format($produk->harga_customer, '0',',','.') ?></td>
            <td> Rp. <?php echo number_format($produk->harga_mitra, '0',',','.') ?></td>
            <td>Rp. <?php echo number_format($produk->harga_distributor, '0',',','.') ?></td>
            <td><button class="btn btn-danger btn-md" data-toggle="modal" data-target="#follow<?php echo $produk->kode_produk?>"><i class="fa fa-cogs" aria-hidden="true"></i> &nbsp;Follow Up</button></td>
          </tr>
        <?php } ?>
        </tbody>
      </thead>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
<?php $i=1; foreach ($follow as $follow) { ?>
<div class="modal fade" id="follow<?php echo $follow->kode_produk?>">
  <div class="modal-dialog" style="width: 1100px;">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #F0F8FF;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Follow Up Text</h4>
      </div>
      <div class="modal-body">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1<?php echo $i; ?>" data-toggle="tab">Welcome</a></li>
            <li><a href="#tab_2<?php echo $i; ?>" data-toggle="tab">Order Detail</a></li>
            <li><a href="#tab_3<?php echo $i; ?>" data-toggle="tab">Follow Up 1</a></li>
            <li><a href="#tab_4<?php echo $i; ?>" data-toggle="tab">Follow Up 2</a></li>
            <li><a href="#tab_5<?php echo $i; ?>" data-toggle="tab">Follow Up 3</a></li>
            <li><a href="#tab_6<?php echo $i; ?>" data-toggle="tab">Follow Up 4</a></li>
            <li><a href="#tab_7<?php echo $i; ?>" data-toggle="tab">Proses</a></li>
            <li><a href="#tab_8<?php echo $i; ?>" data-toggle="tab">Complate</a></li>
            <li><a href="#tab_9<?php echo $i; ?>" data-toggle="tab">Up Selling</a></li>
            <li><a href="#tab_10<?php echo $i; ?>" data-toggle="tab">Redirect</a></li>
          </ul>
          <?php echo form_open(base_url('admin/dashboard/save_follow/'.$follow->kode_produk)); ?>
          <div class="tab-content">
            <br>
            <div class="tab-pane active" id="tab_1<?php echo $i; ?>">
              <textarea name="text_follow1" id="text_follow1<?php echo $i ?>" style="height: 230px;" placeholder="Isikan Text" class="form-control"/><?php
              $text = $follow->welcome;
              $breaks = array("<br />","<br>","<br/>");
              //$text = str_ireplace($breaks, "\r\n", $text);  
               echo !empty($follow) ? $text : '';?></textarea>
              <div class="bottom-tap">
                <div class="input-group margin">
                  <select class="form-control" id="insert_text" name="insert_text1<?php echo $i ?>">
                    <option>Select Auto Text</option>
                    <option value="{nama_produk}">Nama Produk</option>
                    <option value="{harga}">Harga Produk</option>
                    <option value="{ongkir}">Ongkir</option>
                    <option value="{metode_bayar}">Metode Bayar</option>
                    <option value="{total_bayar}">Total Bayar</option>
                    <option value="{alamat}">Alamat</option>
                    <option value="{metode_bayar}">Metode Bayar</option>
                    <option value="{nama_pelanggan}">Nama Pelanggan</option>
                    <option value="{no_hp}">No. Telp</option>
                    <option value="{ekspedisi}">Ekspedisi</option>
                    <option value="{nama_pelanggan}">Nama Pelanggan</option>
                    <option value="{no_resi}">No Resi</option>
                  </select>
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-flat" id="tap_1<?php echo $i ?>">Insert</button>
                    <!-- <button class="btn btn-default btn-md" style="margin-left: 20px;">Icon</button> -->
                  </span>
                </div>
              </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_2<?php echo $i; ?>">
              <textarea name="text_follow2" id="text_follow2<?php echo $i ?>" style="height: 230px;" placeholder="Isikan Text" class="form-control"/><?php echo !empty($follow) ? $follow->order_detail : '';?></textarea>
              <div class="bottom-tap">
                <div class="input-group margin">
                  <select class="form-control" id="insert_text" name="insert_text2<?php echo $i ?>">
                    <option>Select Auto Text</option>
                    <option value="{nama_produk}">Nama Produk</option>
                    <option value="{harga}">Harga Produk</option>
                    <option value="{ongkir}">Ongkir</option>
                    <option value="{metode_bayar}">Metode Bayar</option>
                    <option value="{total_bayar}">Total Bayar</option>
                    <option value="{alamat}">Alamat</option>
                    <option value="{metode_bayar}">Metode Bayar</option>
                    <option value="{nama_pelanggan}">Nama Pelanggan</option>
                    <option value="{no_hp}">No. Telp</option>
                    <option value="{ekspedisi}">Ekspedisi</option>
                    <option value="{nama_pelanggan}">Nama Pelanggan</option>
                    <option value="{no_resi}">No Resi</option>
                  </select>
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-flat" id="tap_2<?php echo $i ?>">Insert</button>
                    <!-- <button class="btn btn-default btn-md" style="margin-left: 20px;">Icon</button> -->
                  </span>
                </div>
              </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_3<?php echo $i; ?>">
              <textarea name="text_follow3" id="text_follow3<?php echo $i ?>" style="height: 230px;" placeholder="Isikan Text" class="form-control"/><?php echo !empty($follow) ? $follow->follow_up1 : '';?></textarea>
              <div class="bottom-tap">
                <div class="input-group margin">
                  <select class="form-control" id="insert_text" name="insert_text3<?php echo $i ?>">
                    <option>Select Auto Text</option>
                    <option value="{nama_produk}">Nama Produk</option>
                    <option value="{harga}">Harga Produk</option>
                    <option value="{ongkir}">Ongkir</option>
                    <option value="{metode_bayar}">Metode Bayar</option>
                    <option value="{total_bayar}">Total Bayar</option>
                    <option value="{alamat}">Alamat</option>
                    <option value="{metode_bayar}">Metode Bayar</option>
                    <option value="{nama_pelanggan}">Nama Pelanggan</option>
                    <option value="{no_hp}">No. Telp</option>
                    <option value="{ekspedisi}">Ekspedisi</option>
                    <option value="{nama_pelanggan}">Nama Pelanggan</option>
                    <option value="{no_resi}">No Resi</option>
                  </select>
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-flat" id="tap_3<?php echo $i ?>">Insert</button>
                    <!-- <button class="btn btn-default btn-md" style="margin-left: 20px;">Icon</button> -->
                  </span>
                </div>
              </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_4<?php echo $i; ?>">
              <textarea name="text_follow4" id="text_follow4<?php echo $i ?>" style="height: 230px;" placeholder="Isikan Text" class="form-control"/><?php echo !empty($follow) ? $follow->follow_up2 : '';?></textarea>
              <div class="bottom-tap">
                <div class="input-group margin">
                  <select class="form-control" id="insert_text" name="insert_text4<?php echo $i ?>">
                    <option>Select Auto Text</option>
                    <option value="{nama_produk}">Nama Produk</option>
                    <option value="{harga}">Harga Produk</option>
                    <option value="{ongkir}">Ongkir</option>
                    <option value="{metode_bayar}">Metode Bayar</option>
                    <option value="{total_bayar}">Total Bayar</option>
                    <option value="{alamat}">Alamat</option>
                    <option value="{metode_bayar}">Metode Bayar</option>
                    <option value="{nama_pelanggan}">Nama Pelanggan</option>
                    <option value="{no_hp}">No. Telp</option>
                    <option value="{ekspedisi}">Ekspedisi</option>
                    <option value="{nama_pelanggan}">Nama Pelanggan</option>
                    <option value="{no_resi}">No Resi</option>
                  </select>
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-flat" id="tap_4<?php echo $i ?>">Insert</button>
                    <!-- <button class="btn btn-default btn-md" style="margin-left: 20px;">Icon</button> -->
                  </span>
                </div>
              </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_5<?php echo $i; ?>">
              <textarea name="text_follow5" id="text_follow5<?php echo $i ?>" style="height: 230px;" placeholder="Isikan Text" class="form-control"/><?php echo !empty($follow) ? $follow->follow_up3 : '';?></textarea>
              <div class="bottom-tap">
                <div class="input-group margin">
                  <select class="form-control" id="insert_text" name="insert_text5<?php echo $i ?>">
                    <option>Select Auto Text</option>
                    <option value="{nama_produk}">Nama Produk</option>
                    <option value="{harga}">Harga Produk</option>
                    <option value="{ongkir}">Ongkir</option>
                    <option value="{metode_bayar}">Metode Bayar</option>
                    <option value="{total_bayar}">Total Bayar</option>
                    <option value="{alamat}">Alamat</option>
                    <option value="{metode_bayar}">Metode Bayar</option>
                    <option value="{nama_pelanggan}">Nama Pelanggan</option>
                    <option value="{no_hp}">No. Telp</option>
                    <option value="{ekspedisi}">Ekspedisi</option>
                    <option value="{nama_pelanggan}">Nama Pelanggan</option>
                    <option value="{no_resi}">No Resi</option>
                  </select>
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-flat" id="tap_5<?php echo $i ?>">Insert</button>
                    <!-- <button class="btn btn-default btn-md" style="margin-left: 20px;">Icon</button> -->
                  </span>
                </div>
              </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_6<?php echo $i; ?>">
              <textarea name="text_follow6" id="text_follow6<?php echo $i ?>" style="height: 230px;" placeholder="Isikan Text" class="form-control"/><?php echo !empty($follow) ? $follow->follow_up4 : '';?></textarea>
              <div class="bottom-tap">
                <div class="input-group margin">
                  <select class="form-control" id="insert_text" name="insert_text6<?php echo $i ?>">
                    <option>Select Auto Text</option>
                    <option value="{nama_produk}">Nama Produk</option>
                    <option value="{harga}">Harga Produk</option>
                    <option value="{ongkir}">Ongkir</option>
                    <option value="{metode_bayar}">Metode Bayar</option>
                    <option value="{total_bayar}">Total Bayar</option>
                    <option value="{alamat}">Alamat</option>
                    <option value="{metode_bayar}">Metode Bayar</option>
                    <option value="{nama_pelanggan}">Nama Pelanggan</option>
                    <option value="{no_hp}">No. Telp</option>
                    <option value="{ekspedisi}">Ekspedisi</option>
                    <option value="{nama_pelanggan}">Nama Pelanggan</option>
                    <option value="{no_resi}">No Resi</option>
                  </select>
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-flat" id="tap_6<?php echo $i ?>">Insert</button>
                    <!-- <button class="btn btn-default btn-md" style="margin-left: 20px;">Icon</button> -->
                  </span>
                </div>
              </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_7<?php echo $i; ?>">
              <textarea name="text_follow7" id="text_follow7<?php echo $i ?>" style="height: 230px;" placeholder="Isikan Text" class="form-control"/><?php echo !empty($follow) ? $follow->proses : '';?></textarea>
              <div class="bottom-tap">
                <div class="input-group margin">
                  <select class="form-control" id="insert_text" name="insert_text7<?php echo $i ?>">
                    <option>Select Auto Text</option>
                    <option value="{nama_produk}">Nama Produk</option>
                    <option value="{harga}">Harga Produk</option>
                    <option value="{ongkir}">Ongkir</option>
                    <option value="{metode_bayar}">Metode Bayar</option>
                    <option value="{total_bayar}">Total Bayar</option>
                    <option value="{alamat}">Alamat</option>
                    <option value="{metode_bayar}">Metode Bayar</option>
                    <option value="{nama_pelanggan}">Nama Pelanggan</option>
                    <option value="{no_hp}">No. Telp</option>
                    <option value="{ekspedisi}">Ekspedisi</option>
                    <option value="{nama_pelanggan}">Nama Pelanggan</option>
                    <option value="{no_resi}">No Resi</option>
                  </select>
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-flat" id="tap_7<?php echo $i ?>">Insert</button>
                    <!-- <button class="btn btn-default btn-md" style="margin-left: 20px;">Icon</button> -->
                  </span>
                </div>
              </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_8<?php echo $i; ?>">
              <textarea name="text_follow8" id="text_follow8<?php echo $i ?>" style="height: 230px;" placeholder="Isikan Text" class="form-control"/><?php echo !empty($follow) ? $follow->complate : '';?></textarea>
              <div class="bottom-tap">
                <div class="input-group margin">
                  <select class="form-control" id="insert_text" name="insert_text8<?php echo $i ?>">
                    <option>Select Auto Text</option>
                    <option value="{nama_produk}">Nama Produk</option>
                    <option value="{harga}">Harga Produk</option>
                    <option value="{ongkir}">Ongkir</option>
                    <option value="{metode_bayar}">Metode Bayar</option>
                    <option value="{total_bayar}">Total Bayar</option>
                    <option value="{alamat}">Alamat</option>
                    <option value="{metode_bayar}">Metode Bayar</option>
                    <option value="{nama_pelanggan}">Nama Pelanggan</option>
                    <option value="{no_hp}">No. Telp</option>
                    <option value="{ekspedisi}">Ekspedisi</option>
                    <option value="{nama_pelanggan}">Nama Pelanggan</option>
                    <option value="{no_resi}">No Resi</option>
                  </select>
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-flat" id="tap_8<?php echo $i ?>">Insert</button>
                    <!-- <button class="btn btn-default btn-md" style="margin-left: 20px;">Icon</button> -->
                  </span>
                </div>
              </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_9<?php echo $i; ?>">
              <textarea name="text_follow9" id="text_follow9<?php echo $i ?>" style="height: 230px;" placeholder="Isikan Text" class="form-control"/><?php echo !empty($follow) ? $follow->up_selling : '';?></textarea>
              <div class="bottom-tap">
                <div class="input-group margin">
                  <select class="form-control" id="insert_text" name="insert_text9<?php echo $i ?>">
                    <option>Select Auto Text</option>
                    <option value="{nama_produk}">Nama Produk</option>
                    <option value="{harga}">Harga Produk</option>
                    <option value="{ongkir}">Ongkir</option>
                    <option value="{metode_bayar}">Metode Bayar</option>
                    <option value="{total_bayar}">Total Bayar</option>
                    <option value="{alamat}">Alamat</option>
                    <option value="{metode_bayar}">Metode Bayar</option>
                    <option value="{nama_pelanggan}">Nama Pelanggan</option>
                    <option value="{no_hp}">No. Telp</option>
                    <option value="{ekspedisi}">Ekspedisi</option>
                    <option value="{nama_pelanggan}">Nama Pelanggan</option>
                    <option value="{no_resi}">No Resi</option>
                  </select>
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-flat" id="tap_9<?php echo $i ?>">Insert</button>
                    <!-- <button class="btn btn-default btn-md" style="margin-left: 20px;">Icon</button> -->
                  </span>
                </div>
              </div>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_10<?php echo $i; ?>">
              <textarea name="text_follow10" id="text_follow10<?php echo $i ?>" style="height: 230px;" placeholder="Isikan Text" class="form-control"/><?php echo !empty($follow) ? $follow->redirect : '';?></textarea>
              <div class="bottom-tap">
                <div class="input-group margin">
                  <select class="form-control" id="insert_text" name="insert_text10<?php echo $i ?>">
                    <option>Select Auto Text</option>
                    <option value="{nama_produk}">Nama Produk</option>
                    <option value="{harga}">Harga Produk</option>
                    <option value="{ongkir}">Ongkir</option>
                    <option value="{metode_bayar}">Metode Bayar</option>
                    <option value="{total_bayar}">Total Bayar</option>
                    <option value="{alamat}">Alamat</option>
                    <option value="{metode_bayar}">Metode Bayar</option>
                    <option value="{nama_pelanggan}">Nama Pelanggan</option>
                    <option value="{no_hp}">No. Telp</option>
                    <option value="{ekspedisi}">Ekspedisi</option>
                    <option value="{nama_pelanggan}">Nama Pelanggan</option>
                    <option value="{no_resi}">No Resi</option>
                  </select>
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default btn-flat" id="tap_10<?php echo $i ?>">Insert</button>
                    <!-- <button class="btn btn-default btn-md" style="margin-left: 20px;">Icon</button> -->
                  </span>
                </div>
              </div>
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->
      </div>
      <div class="modal-footer" style="background-color: #f7fbff;">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      <?php echo form_close(); ?>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
  $(document).ready(function(){
    //tap 1
    $('body').on("click","#tap_1<?php echo $i; ?>",function(){
      var text = $('select[name=insert_text1<?php echo $i; ?>] option').filter(':selected').val()
      var textareaid = 'text_follow1'+<?php echo $i; ?>;
      insertAtCaret(textareaid, text);
    });

    //tap 2
    $('body').on("click","#tap_2<?php echo $i; ?>",function(){
      var text = $('select[name=insert_text2<?php echo $i; ?>] option').filter(':selected').val()
      var textareaid = 'text_follow2'+<?php echo $i; ?>;
      insertAtCaret(textareaid, text);
    });
    
    //tap 3
    $('body').on("click","#tap_3<?php echo $i; ?>",function(){
      var text = $('select[name=insert_text3<?php echo $i; ?>] option').filter(':selected').val()
      var textareaid = 'text_follow3'+<?php echo $i; ?>;
      insertAtCaret(textareaid, text);
    });

    //tap 4
    $('body').on("click","#tap_4<?php echo $i; ?>",function(){
      var text = $('select[name=insert_text4<?php echo $i; ?>] option').filter(':selected').val()
      var textareaid = 'text_follow4'+<?php echo $i; ?>;
      insertAtCaret(textareaid, text);
    });

    //tap 5
    $('body').on("click","#tap_5<?php echo $i; ?>",function(){
      var text = $('select[name=insert_text5<?php echo $i; ?>] option').filter(':selected').val()
      var textareaid = 'text_follow5'+<?php echo $i; ?>;
      insertAtCaret(textareaid, text);
    });

    //tap 6
    $('body').on("click","#tap_6<?php echo $i; ?>",function(){
      var text = $('select[name=insert_text6<?php echo $i; ?>] option').filter(':selected').val()
      var textareaid = 'text_follow6'+<?php echo $i; ?>;
      insertAtCaret(textareaid, text);
    });

    //tap 7
    $('body').on("click","#tap_7<?php echo $i; ?>",function(){
      var text = $('select[name=insert_text7<?php echo $i; ?>] option').filter(':selected').val()
      var textareaid = 'text_follow7'+<?php echo $i; ?>;
      insertAtCaret(textareaid, text);
    });

    //tap 8
    $('body').on("click","#tap_8<?php echo $i; ?>",function(){
      var text = $('select[name=insert_text8<?php echo $i; ?>] option').filter(':selected').val()
      var textareaid = 'text_follow8'+<?php echo $i; ?>;
      insertAtCaret(textareaid, text);
    });

    //tap 9
    $('body').on("click","#tap_9<?php echo $i; ?>",function(){
      var text = $('select[name=insert_text9<?php echo $i; ?>] option').filter(':selected').val()
      var textareaid = 'text_follow9'+<?php echo $i; ?>;
      insertAtCaret(textareaid, text);
    });

    //tap 10
    $('body').on("click","#tap_10<?php echo $i; ?>",function(){
      var text = $('select[name=insert_text10<?php echo $i; ?>] option').filter(':selected').val()
      var textareaid = 'text_follow10'+<?php echo $i; ?>;
      insertAtCaret(textareaid, text);
    });


  });

  function insertAtCaret(areaId,text) {
    var txtarea = document.getElementById(areaId);
    var scrollPos = txtarea.scrollTop;
    var strPos = 0;
    var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ? 
      "ff" : (document.selection ? "ie" : false ) );
    if (br == "ie") { 
      txtarea.focus();
      var range = document.selection.createRange();
      range.moveStart ('character', -txtarea.value.length);
      strPos = range.text.length;
    }
    else if (br == "ff") strPos = txtarea.selectionStart;
    
    var front = (txtarea.value).substring(0,strPos);  
    var back = (txtarea.value).substring(strPos,txtarea.value.length); 
    txtarea.value=front+text+back;
    strPos = strPos + text.length;
    if (br == "ie") { 
      txtarea.focus();
      var range = document.selection.createRange();
      range.moveStart ('character', -txtarea.value.length);
      range.moveStart ('character', strPos);
      range.moveEnd ('character', 0);
      range.select();
    }
    else if (br == "ff") {
      txtarea.selectionStart = strPos;
      txtarea.selectionEnd = strPos;
      txtarea.focus();
    }
    txtarea.scrollTop = scrollPos;
  }

</script>
<?php $i++; } ?>

