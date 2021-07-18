<!-- Main content -->
 <?php if($this->session->flashdata('sukses')){
    echo '<div class="alert alert-warning">';
    echo $this->session->flashdata('sukses');
    echo '</div>';
  } ?>
  <style type="text/css">
    .button{
      margin: 10px;
      text-align: right;
    }
  </style>
  <div class="row">
    <!-- left column -->
    <div class="col-md-5">
      <div class="box box-primary box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Informasi Order</h3>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php echo form_open_multipart(base_url('admin/order/edit2/'.$kode_transaksi), ' class="form-horizontal"'); ?>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="kode">Marketing</label>
            <div class="col-sm-8">
              <select class="form-control" id="id_marketing" name="id_marketing">
              <?php foreach ($marketing as $market) { ?>
              <option value="<?php echo $market->id_marketing ?>" <?php if($detail->id_marketing==$market->id_marketing){ echo "selected"; } ?>> <?php echo $market->nama_marketing ?></option>
            <?php } ?>
            </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="kode">Jenis Order</label>
            <div class="col-sm-8">
              <select name='jenis_order' class="form-control" id="jenis_order">
                <?php if($detail->jenis_order==1){ ?>
                  <option value='1'>Adsense</option>
                  <option value='2'>Organik</option>
                <?php }else{ ?>
                  <option value='2'>Organik</option>
                  <option value='1'>Adsense</option>
                <?php } ?>
                </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="kode">Ekspedisi</label>
            <div class="col-sm-8">
              <select name='ekspedisi' class="form-control" id="ekspedisi">
                <?php foreach ($expedisi as $expedisi) { ?>
                  <option value='<?php echo $expedisi->expedisi ?>' <?php if($detail->expedisi==$expedisi->expedisi){ echo "selected"; } ?>><?php echo $expedisi->expedisi ?></option>
                <?php } ?>
                </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="kode">Ongkos Kirim</label>
            <div class="col-sm-8">
              <input type="number" class="form-control ong" name="ongkir" id="ongkir" value="<?php echo $detail->ongkir ?>" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="kode">Total Item</label>
            <div class="col-sm-8">
              <input type="number" class="form-control" name="total_item" id="total_item" value="<?php echo $detail->total_item ?>" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="kode">Metode Bayar</label>
            <div class="col-sm-8">
              <select name='metode_pembayaran' class="form-control" id="metode_pembayaran">
                <?php if($detail->metode_pembayaran==1){ ?>
                  <option value='1'>Transfer Bank</option>
                  <option value='0'>COD</option>
                  <option value='2'>Cash</option>
                <?php }else if($detail->metode_pembayaran==2){ ?>
                  <option value='2'>Cash</option>
                  <option value='1'>Transfer Bank</option>
                  <option value='0'>COD</option>
                <?php }else{ ?>
                  <option value='0'>COD</option>
                  <option value='2'>Cash</option>
                  <option value='1'>Transfer Bank</option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
    <div class="col-sm-7">
      <div class="box box-primary box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Informasi Barang</h3>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="scrollmenu">
            <table class="table" id="mytable">
              <thead>
                <tr>
                  <td>Nama Barang</td>
                  <td>Jumlah</td>
                  <td>Harga Beli</td>
                  <td>Potongan</td>
                  <td>Total</td>
                </tr>
              </thead>
              <tbody id="transaksi-item">
                <?php $i=1;
                foreach ($order as $order) { ?>
                <tr>
                  <td>
                    <input type="text" id="kode" class="form-control" value="<?php echo $order->nama_produk ?>" readonly/>
                    <input type="hidden" id="kode_produk" class="form-control" value="<?php echo $order->id_produk ?>" name="kode_produk[]"/>
                    <input type="hidden" id="id_order" class="form-control" value="<?php echo $order->id_order ?>" name="id_order[]"/>
                  </td>
                  <td width="100px">
                    <input type="number" id="jumlah<?php echo $i ?>" class="form-control prc" min="1" name="jumlah[]" value="<?php echo $order->jml_beli ?>"/>
                  </td>
                  <td width="120px">
                    <input type="number" id="harga<?php echo $i ?>" class="form-control harga" name="harga[]" min="0" value="<?php echo $order->harga ?>" readonly/>
                  </td>
                  <td width="105px">
                    <input type="number" id="potongan<?php echo $i ?>" class="form-control pt" name="potongan[]" min="0" value="<?php echo $order->potongan ?>" />
                  </td>
                  <td width="105px">
                    <input type="number" id="total<?php echo $i ?>" class="form-control" name="total[]" min="0" value="<?php echo $order->total_transaksi ?>" />
                  </td>
                </tr>

              <?php $i++; } ?>
              </tbody>
              <tfoot>
                <tr>
                  <td>Sub Total</td>
                  <td colspan="2"><input type="number" id="subtotal"class="form-control" name="subtotal" value="<?php echo $detail->total_transaksi ?>"></td>
                </tr>
                <tr>
                  <td>Total Bayar</td>
                  <td colspan="2"><input type="number" id="total_bayar" class="form-control" name="total_bayar" value="<?php echo $detail->total_bayar ?>"></td>
                </tr>
              </tfoot>
              </tbody>
            </table>
            <button class="btn btn-info pull-right" type="submit">Save</button>
          </div>
        </div>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="box box-primary collapsed-box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Data Pengiriman</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
            </button>
          </div>
          <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php echo form_open_multipart(base_url('admin/order/edit_penerima/'.$kode_transaksi), ' class="form-horizontal"'); ?>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="kode">Nama Pelanggan</label>
            <div class="col-sm-8">
              <input type="text" name="nama_pelanggan" value="<?php echo $detail->nama_pelanggan ?>" class="form-control" id="nama_pelanggan" placeholder="Nama Pelanggan">
              <input type="hidden" class="form-control" name="id_pelanggan" value="<?php echo $detail->id_pelanggan ?>" id="id_pelanggan" placeholder="id_pelanggan">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="kode">No. Handphone</label>
            <div class="col-sm-8">
              <input type="text" name="no_hp" id="no_hp" value="<?php echo $detail->no_hp ?>" class="form-control" placeholder="No. Hp">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="kode">Alamat Lengkap</label>
            <div class="col-sm-8">
              <textarea type="text" name="alamat" id="alamat" value="<?php echo set_value('alamat') ?>" class="form-control" placeholder="Alamat Lengkap"><?php echo $detail->alamat ?></textarea>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="kode">Provinsi</label>
            <div class="col-sm-8">
              <select class="form-control" id="form_prov" name="provinsi">
                <?php foreach ($provinsi as $provinsi) { ?>
                <option value="<?php echo $provinsi->kode ?>"<?php if($detail->provinsi==$provinsi->nama){ echo "selected"; } ?>>
                 <?php echo $provinsi->nama ?> 
                </option>
              <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="kode">Kabupaten</label>
            <div class="col-sm-8">
             <select class="form-control" id="form_kab" name="kabupaten">
              <option><?php echo $detail->kabupaten ?></option>
             </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="kode">Kecamatan</label>
            <div class="col-sm-8">
              <select class="form-control" id="form_kec" name="kecamatan">
                <option><?php echo $detail->kecamatan ?></option>
              </select>
            </div>
          </div>
          <input type="hidden" name="kab" id="kab">
          <input type="hidden" name="kec" id="kec">
          <input type="hidden" name="prov" id="prov">
          <button class="btn btn-info pull-right" type="submit">Save</button>
          <?php echo form_close(); ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
<!-- /.content -->

<script type="text/javascript">
  $(function(){
    var total = function(){
      var sum =0;
      var item = 0;
      var i =1;
      $('.prc').each(function(){
        var num = $(this).val();
        var potongan = $("#potongan"+i).val();
        var harga = $("#harga"+i).val();
        var tot = (parseInt(num) * parseInt(harga)) - parseInt(potongan);
        //alert(subtotal);
        $("#total"+i).val(tot);

        //sub total
        var subtotal1 = $("#total"+i).val();
        sum += parseInt(subtotal1);
        item +=parseInt(num);
        i++;
      });
      $("#subtotal").val(sum); 
      //grand total
      var ongkir = $("#ongkir").val();
      var sub = $("#subtotal").val();
      var grandtotal = parseInt(ongkir) + parseInt(sub);
      $("#total_bayar").val(grandtotal);
      $("#total_item").val(item);
    }
    //potongan
    var potongan = function(){
      var sum =0;
      var i =1;
      $('.pt').each(function(){
        var potongan = $("#potongan"+i).val();
        var jml = $("#jumlah"+i).val();
        var harga = $("#harga"+i).val();
        var total_pot = (parseInt(harga) * parseInt(jml)) - parseInt(potongan);
        $("#total"+i).val(total_pot);

        //subtotal
        var subtotal1 = $("#total"+i).val();
        sum += parseInt(subtotal1);
        i++;
      });
      $("#subtotal").val(sum); 
      //grand total
      var ongkir = $("#ongkir").val();
      var sub = $("#subtotal").val();
      var grandtotal = parseInt(ongkir) + parseInt(sub);
      $("#total_bayar").val(grandtotal);
    }

    //ongkir
    var ongkir = function(){
      $('.ong').each(function(){
        var ongkir = $("#ongkir").val();
        var sub = $("#subtotal").val();
        var grandtotal = parseInt(ongkir) + parseInt(sub);
        $("#total_bayar").val(grandtotal);
      });
    }

    $('.prc').keyup(function(){
      total();
    });
    $('.pt').keyup(function(){
      potongan();
    });
    $('.ong').keyup(function(){
      ongkir();
    });
  });

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