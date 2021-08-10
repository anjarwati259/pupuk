<div id="success-alert" style="display:none;" class="alert alert-success alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
  <?php echo $this->session->flashdata('sukses'); ?>
</div>

<div class="box box-primary box-solid">
  <div class="box-header with-border">
    <h3 class="box-title">Data Produk</h3>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <?php $i=1; ?>
  <div class="box-body">
  	<br>
  	<div class="nav-tabs-custom">
	  <ul class="nav nav-tabs">
	    <li class="active" style="font-size: 15px;"><a href="#tab_1" data-toggle="tab">Welcome</a></li>
	    <li style="font-size: 15.04px;"><a href="#tab_2" data-toggle="tab">Order Detail</a></li>
	    <li style="font-size: 15.04px;"><a href="#tab_3" data-toggle="tab">Follow Up 1</a></li>
	    <li style="font-size: 15.04px;"><a href="#tab_4" data-toggle="tab">Follow Up 2</a></li>
	    <li style="font-size: 15.04px;"><a href="#tab_5" data-toggle="tab">Follow Up 3</a></li>
	    <li style="font-size: 15.04px;"><a href="#tab_6" data-toggle="tab">Follow Up 4</a></li>
	    <li style="font-size: 15.04px;"><a href="#tab_7" data-toggle="tab">Proses</a></li>
	    <li style="font-size: 15.04px;"><a href="#tab_8" data-toggle="tab">Complate</a></li>
	    <li style="font-size: 15.04px;"><a href="#tab_9" data-toggle="tab">Up Selling</a></li>
	    <li style="font-size: 15.04px;"><a href="#tab_10" data-toggle="tab">Redirect</a></li>
	  </ul>
	  <?php echo form_open(base_url('admin/dashboard/save_follow/')); ?>
	  <div class="tab-content">
	    <br>
	    <div class="tab-pane active" id="tab_1">
	      <textarea name="text_follow1" id="text_follow1" style="height: 230px;" placeholder="Isikan Text" class="form-control"/><?php echo !empty($welcome) ? $welcome->text : '';?></textarea>
	      <input type="hidden" name="kode1" value="<?php echo $welcome->id_follow_up ?>">
	      <div class="bottom-tap">
	      	<div class="row">
	      		<div class="col-md-6">
	      			<div class="input-group margin" style="width: 50%;">
			          <select class="form-control" id="insert_text" name="insert_text1">
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
			            <button type="button" class="btn btn-default btn-flat" id="tap_1">Insert</button>
			          </span>
			        </div>
	      		</div>
	      	</div>
	      </div>
	    </div>
	    <!-- /.tab-pane -->
	    <div class="tab-pane" id="tab_2">
	      <textarea name="text_follow2" id="text_follow2" style="height: 230px;" placeholder="Isikan Text" class="form-control"/><?php echo !empty($order_detail) ? $order_detail->text : '';?></textarea>
	      <input type="hidden" name="kode2" value="<?php echo $order_detail->id_follow_up ?>">
	      <div class="bottom-tap">
	        <div class="row">
	      		<div class="col-md-6">
	      			<div class="input-group margin" style="width: 50%;">
			          <select class="form-control" id="insert_text" name="insert_text2">
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
			            <button type="button" class="btn btn-default btn-flat" id="tap_2">Insert</button>
			            <!-- <button class="btn btn-default btn-md" style="margin-left: 20px;">Icon</button> -->
			          </span>
			        </div>
			    </div>
			</div>
	      </div>
	    </div>
	    <!-- /.tab-pane -->
	    <div class="tab-pane" id="tab_3">
	      <textarea name="text_follow3" id="text_follow3" style="height: 230px;" placeholder="Isikan Text" class="form-control"/><?php echo !empty($follow1) ? $follow1->text : '';?></textarea>
	      <input type="hidden" name="kode3" value="<?php echo $follow1->id_follow_up ?>">
	      <div class="bottom-tap">
	        <div class="row">
	      		<div class="col-md-6">
	      			<div class="input-group margin" style="width: 50%;">
			          <select class="form-control" id="insert_text" name="insert_text3">
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
			            <button type="button" class="btn btn-default btn-flat" id="tap_3">Insert</button>
			            <!-- <button class="btn btn-default btn-md" style="margin-left: 20px;">Icon</button> -->
			          </span>
			        </div>
			    </div>
			</div>
	      </div>
	    </div>
	    <!-- /.tab-pane -->
	    <div class="tab-pane" id="tab_4">
	      <textarea name="text_follow4" id="text_follow4" style="height: 230px;" placeholder="Isikan Text" class="form-control"/><?php echo !empty($follow2) ? $follow2->text : '';?></textarea>
	      <input type="hidden" name="kode4" value="<?php echo $follow2->id_follow_up ?>">
	      <div class="bottom-tap">
	        <div class="row">
	      		<div class="col-md-6">
	      			<div class="input-group margin" style="width: 50%;">
			          <select class="form-control" id="insert_text" name="insert_text4">
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
			            <button type="button" class="btn btn-default btn-flat" id="tap_4">Insert</button>
			            <!-- <button class="btn btn-default btn-md" style="margin-left: 20px;">Icon</button> -->
			          </span>
			        </div>
			    </div>
			</div>
	      </div>
	    </div>
	    <!-- /.tab-pane -->
	    <div class="tab-pane" id="tab_5">
	      <textarea name="text_follow5" id="text_follow5" style="height: 230px;" placeholder="Isikan Text" class="form-control"/><?php echo !empty($follow3) ? $follow3->text : '';?></textarea>
	      <input type="hidden" name="kode5" value="<?php echo $follow3->id_follow_up ?>">
	      <div class="bottom-tap">
	        <div class="row">
	      		<div class="col-md-6">
	      			<div class="input-group margin" style="width: 50%;">
			          <select class="form-control" id="insert_text" name="insert_text5">
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
			            <button type="button" class="btn btn-default btn-flat" id="tap_5">Insert</button>
			            <!-- <button class="btn btn-default btn-md" style="margin-left: 20px;">Icon</button> -->
			          </span>
			        </div>
			    </div>
			</div>
	      </div>
	    </div>
	    <!-- /.tab-pane -->
	    <div class="tab-pane" id="tab_6">
	      <textarea name="text_follow6" id="text_follow6" style="height: 230px;" placeholder="Isikan Text" class="form-control"/><?php echo !empty($follow4) ? $follow4->text : '';?></textarea>
	      <input type="hidden" name="kode6" value="<?php echo $follow4->id_follow_up ?>">
	      <div class="bottom-tap">
	        <div class="row">
	      		<div class="col-md-6">
	      			<div class="input-group margin" style="width: 50%;">
			          <select class="form-control" id="insert_text" name="insert_text6">
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
			            <button type="button" class="btn btn-default btn-flat" id="tap_6">Insert</button>
			            <!-- <button class="btn btn-default btn-md" style="margin-left: 20px;">Icon</button> -->
			          </span>
			        </div>
			    </div>
			</div>
	      </div>
	    </div>
	    <!-- /.tab-pane -->
	    <div class="tab-pane" id="tab_7">
	      <textarea name="text_follow7" id="text_follow7" style="height: 230px;" placeholder="Isikan Text" class="form-control"/><?php echo !empty($proses) ? $proses->text : '';?></textarea>
	      <input type="hidden" name="kode7" value="<?php echo $proses->id_follow_up ?>">
	      <div class="bottom-tap">
	        <div class="row">
	      		<div class="col-md-6">
	      			<div class="input-group margin" style="width: 50%;">
			          <select class="form-control" id="insert_text" name="insert_text7">
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
			            <button type="button" class="btn btn-default btn-flat" id="tap_7">Insert</button>
			            <!-- <button class="btn btn-default btn-md" style="margin-left: 20px;">Icon</button> -->
			          </span>
			        </div>
			    </div>
			</div>
	      </div>
	    </div>
	    <!-- /.tab-pane -->
	    <div class="tab-pane" id="tab_8">
	      <textarea name="text_follow8" id="text_follow8" style="height: 230px;" placeholder="Isikan Text" class="form-control"/><?php echo !empty($complate) ? $complate->text : '';?></textarea>
	      <input type="hidden" name="kode8" value="<?php echo $complate->id_follow_up ?>">
	      <div class="bottom-tap">
	        <div class="row">
	      		<div class="col-md-6">
	      			<div class="input-group margin" style="width: 50%;">
			          <select class="form-control" id="insert_text" name="insert_text8">
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
			            <button type="button" class="btn btn-default btn-flat" id="tap_8">Insert</button>
			            <!-- <button class="btn btn-default btn-md" style="margin-left: 20px;">Icon</button> -->
			          </span>
			        </div>
			    </div>
			</div>
	      </div>
	    </div>
	    <!-- /.tab-pane -->
	    <div class="tab-pane" id="tab_9">
	      <textarea name="text_follow9" id="text_follow9" style="height: 230px;" placeholder="Isikan Text" class="form-control"/><?php echo !empty($up_selling) ? $up_selling->text : '';?></textarea>
	      <input type="hidden" name="kode9" value="<?php echo $up_selling->id_follow_up ?>">
	      <div class="bottom-tap">
	        <div class="row">
	      		<div class="col-md-6">
	      			<div class="input-group margin" style="width: 50%;">
			          <select class="form-control" id="insert_text" name="insert_text9">
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
			            <button type="button" class="btn btn-default btn-flat" id="tap_9">Insert</button>
			            <!-- <button class="btn btn-default btn-md" style="margin-left: 20px;">Icon</button> -->
			          </span>
			        </div>
			    </div>
			</div>
	      </div>
	    </div>
	    <!-- /.tab-pane -->
	    <div class="tab-pane" id="tab_10">
	      <textarea name="text_follow10" id="text_follow10" style="height: 230px;" placeholder="Isikan Text" class="form-control"/><?php echo !empty($redirect) ? $redirect->text : '';?></textarea>
	      <input type="hidden" name="kode10" value="<?php echo $redirect->id_follow_up ?>">
	      <div class="bottom-tap">
	        <div class="row">
	      		<div class="col-md-6">
	      			<div class="input-group margin" style="width: 50%;">
			          <select class="form-control" id="insert_text" name="insert_text10">
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
			            <button type="button" class="btn btn-default btn-flat" id="tap_10">Insert</button>
			            <!-- <button class="btn btn-default btn-md" style="margin-left: 20px;">Icon</button> -->
			          </span>
			        </div>
			    </div>
			</div>
	      </div>
	    </div>
	    <!-- /.tab-pane -->
	  </div>
	  <!-- /.tab-content -->
	</div>

	<div class="input-group margin" style="float: right;">
		<button type="submit" class="btn btn-primary btn-md" style="margin-left: 20px;">Save</button>
	</div>
	<?php echo form_close(); ?>
	<!-- nav-tabs-custom -->
  </div>
</div>
<?php if($this->session->flashdata('sukses')) { ?>
	<script>
		$('#success-alert').slideDown('slow');
		setTimeout(function() {$('#success-alert').slideUp('slow');}, 3100);
	</script>
<?php }; ?>

<script type="text/javascript">
  $(document).ready(function(){
    //tap 1
    $('body').on("click","#tap_1",function(){
      var text = $('select[name=insert_text1] option').filter(':selected').val()
      var textareaid = 'text_follow1';
      insertAtCaret(textareaid, text);
    });

    //tap 2
    $('body').on("click","#tap_2",function(){
      var text = $('select[name=insert_text2] option').filter(':selected').val()
      var textareaid = 'text_follow2';
      insertAtCaret(textareaid, text);
    });
    
    //tap 3
    $('body').on("click","#tap_3",function(){
      var text = $('select[name=insert_text3] option').filter(':selected').val()
      var textareaid = 'text_follow3';
      insertAtCaret(textareaid, text);
    });

    //tap 4
    $('body').on("click","#tap_4",function(){
      var text = $('select[name=insert_text4] option').filter(':selected').val()
      var textareaid = 'text_follow4';
      insertAtCaret(textareaid, text);
    });

    //tap 5
    $('body').on("click","#tap_5",function(){
      var text = $('select[name=insert_text5] option').filter(':selected').val()
      var textareaid = 'text_follow5';
      insertAtCaret(textareaid, text);
    });

    //tap 6
    $('body').on("click","#tap_6",function(){
      var text = $('select[name=insert_text6] option').filter(':selected').val()
      var textareaid = 'text_follow6';
      insertAtCaret(textareaid, text);
    });

    //tap 7
    $('body').on("click","#tap_7",function(){
      var text = $('select[name=insert_text7] option').filter(':selected').val()
      var textareaid = 'text_follow7';
      insertAtCaret(textareaid, text);
    });

    //tap 8
    $('body').on("click","#tap_8",function(){
      var text = $('select[name=insert_text8] option').filter(':selected').val()
      var textareaid = 'text_follow8';
      insertAtCaret(textareaid, text);
    });

    //tap 9
    $('body').on("click","#tap_9",function(){
      var text = $('select[name=insert_text9] option').filter(':selected').val()
      var textareaid = 'text_follow9';
      insertAtCaret(textareaid, text);
    });

    //tap 10
    $('body').on("click","#tap_10",function(){
      var text = $('select[name=insert_text10] option').filter(':selected').val()
      var textareaid = 'text_follow10';
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