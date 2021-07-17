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
              <input type="number" class="form-control" name="ongkir" id="ongkir" value="<?php echo $detail->ongkir ?>" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label" for="kode">Total Item</label>
            <div class="col-sm-8">
              <input type="number" class="form-control" name="total_item" id="ongkir" value="<?php echo $detail->total_item ?>" />
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
                    <input type="number" id="jumlah" class="form-control prc" min="1" name="jumlah[]" value="<?php echo $order->jml_beli ?>"/>
                  </td>
                  <td width="120px">
                    <input type="number" id="harga<?php echo $i ?>" class="form-control harga" name="harga[]" min="0" value="<?php echo $order->harga ?>" readonly/>
                  </td>
                  <td width="105px">
                    <input type="number" id="potongan" class="form-control" name="potongan[]" min="0" value="<?php echo $order->potongan ?>" />
                  </td>
                  <td width="105px">
                    <input type="number" id="total" class="form-control" name="total[]" min="0" value="<?php echo $order->total_transaksi ?>" />
                  </td>
                </tr>

              <?php $i++; } ?>
              </tbody>
              <tfoot>
                <tr>
                  <td>Sub Total</td>
                  <td colspan="2"><input type="number" class="form-control" name="subtotal" value="<?php echo $detail->total_transaksi ?>"></td>
                </tr>
                <tr>
                  <td>Total Bayar</td>
                  <td colspan="2"><input type="number" class="form-control" name="total_bayar" value="<?php echo $detail->total_bayar ?>"></td>
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
  <!-- /.row -->
<!-- /.content -->

<script type="text/javascript">
  $(function(){
    var total = function(){
      var sum =0;
      var i =1;
      $('.prc').each(function(){
        var num = $(this).val().replace(',','');
        var harga = $("#harga"+i).val()
        alert(harga);
        i++;
      });
    }
    $('.prc').keyup(function(){
      total();
    });
  });
</script>