<!-- START CUSTOM TABS -->
      <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li role="presentation" class="active"><a href="#tab_1">Tambah Order</a></li>
              <li role="presentation"><a href="<?php echo site_url('admin/order');?>">Belum Bayar</a></li>
              <li role="presentation"><a href="<?php echo site_url('admin/order/sudah_bayar');?>">Sudah Bayar</a></li>
            </ul>
            <div class="tab-content">
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="tab_1">
                <form id="transaction-form" class="form-horizontal" method="POST" action="<?php echo base_url('admin/order/add_process');?>">
                <div class="box-body">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-sm-4 control-label" for="kode">Kode Invoice</label>
                      <div class="col-sm-8">
                        <input type="hidden" name="kode_transaksi" id="kode_transaksi" value="<?php echo $kode_transaksi?>"/>
                        <input type="text" name="kode" id="kode_transaksi" class="form-control" value="<?php echo $kode_transaksi ?>" disabled/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label" for="category_id">Nama</label>
                      <div class="col-sm-8">
                        <input type="text" name="nama_pelanggan" value="<?php echo set_value('nama_pelanggan') ?>" class="form-control" id="nama_pelanggan" placeholder="Nama Pelanggan"> 
                        <input type="hidden" class="form-control" name="id_pelanggan" value="<?php echo set_value('id_pelanggan') ?>" id="id_pelanggan" placeholder="id_pelanggan">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-4"></div>
                      <div class="col-sm-8">
                        <input type="radio" name="code" id="code" value="0" checked> <label> Lama</label>
                        <input type="radio" name="code" id="code" value="1"> <label> Baru</label>
                    </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-4 control-label" for="category_id">No. Hp</label>
                      <div class="col-sm-4">
                        <input type="text" name="no_hp" id="no_hp" value="<?php echo set_value('no_hp') ?>" class="form-control" placeholder="No. Hp">
                      </div>
                      <div class="col-sm-4">
                        <input type="text" name="komoditi" id="komoditi" value="<?php echo set_value('komoditi') ?>" class="form-control" placeholder="Komoditi">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label" for="category_id">Alamat</label>
                      <div class="col-sm-8">
                        <textarea type="text" name="alamat" id="alamat" value="<?php echo set_value('alamat') ?>" class="form-control"></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label" for="category_id">Provinsi</label>
                      <div class="col-sm-8">
                        <input type="text" name="provinsi" id="provinsi" value="<?php echo set_value('provinsi') ?>" class="form-control"/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label" for="category_id">Kabupaten</label>
                      <div class="col-sm-8">
                        <input type="text" name="kabupaten" id="kabupaten" value="<?php echo set_value('kabupaten') ?>" class="form-control"/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label" for="category_id">Kecamatan</label>
                      <div class="col-sm-8">
                        <input type="text" name="kecamatan" id="kecamatan" value="<?php echo set_value('kecamatan') ?>" class="form-control"/>
                      </div>
                    </div>
                    <input type="hidden" class="form-control" name="no_hp" id="no_hp" value="<?php echo set_value('no_hp') ?>" />
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="col-sm-4 control-label" for="date">Tanggal</label>
                      <div class="col-sm-8">
                        <input type="text" value="<?php echo date('Y-m-d H:i:s');?>" id="date" class="form-control" disabled/>
                        <input type="hidden" id="tanggal_transaksi" name="tanggal_transaksi" value="<?php echo date('Y-m-d H:i:s');?>" id="tanggal_transaksi" class="form-control"/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label" for="category_id">Ekspedisi</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" name="ekspedisi" id="ekspedisi"/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label" for="category_id">Ongkos Kirim</label>
                      <div class="col-sm-8">
                        <input type="number" class="form-control" name="ongkir" id="ongkir"/>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-4 control-label" for="category_id">Metode Bayar</label>
                      <div class="col-sm-8">
                        <select name='metode_pembayaran' class="form-control" id="metode_pembayaran">
                          <option value='1'>Transfer Bank</option>
                          <option value='0'>COD</option>
                        </select>
                      </div>
                    </div>
                  </div> 
                  <div class="col-md-11 col-md-offset-1">
                    <h3 class="content-title">Informasi Barang</h3>
                    <div class="content-process">
                      <table class="table">
                        <thead>
                          <tr>
                            <td>Pilih Paket</td>
                            <td>Nama Barang</td>
                            <td>Jumlah</td>
                            <td>Bonus</td>
                            <td>Harga Beli</td>
                            <td>Input Barang</td>
                          </tr>
                        </thead>
                        <tbody id="transaksi-item">
                          <tr>
                            <td>
                              <select class="form-control" id="pilih" name="kode_produk">
                                <option value="0">
                                  Please select one
                                </option>
                                    <option value="1">Satuan</option>
                                    <option value="2">Promo</option>
                              </select>
                            </td>

                            <td>
                              <!-- paket -->
                              <select class="form-control" id="0">
                              </select>

                              <!-- paket -->
                              <select class="form-control" id="paket" name="kode_produk">
                                <option value="0">
                                  Please select one
                                </option>
                                <?php if(isset($promo) && is_array($promo)){?>
                                  <?php foreach($promo as $item){?>
                                    <option value="<?php echo $item->kode_produk;?>" dataid="<?php echo $item->id_promo;?>">
                                      <?php echo $item->nama_promo;?>
                                    </option>
                                  <?php }?>
                                <?php }?>
                              </select>
                              <!-- satuan -->
                              <select class="form-control" id="produk" name="kode_produk">
                                <option value="0">
                                  Please select one
                                </option>
                                <?php if(isset($produk) && is_array($produk)){?>
                                  <?php foreach($produk as $item){?>
                                    <option value="<?php echo $item->kode_produk;?>">
                                      <?php echo $item->nama_produk;?>
                                    </option>
                                  <?php }?>
                                <?php }?>
                              </select>
                            </td>

                            <td width="15%">
                              <input type="number" id="jumlah" class="form-control" name="jumlah" min="1" value="1"/>
                            </td>
                            <td width="15%">
                              <input type="number" id="bonus" class="form-control" name="bonus"/>
                            </td>
                            <td>
                              <select class="form-control" id="sale_price" name="sale_price">
                                
                              </select>
                            </td>
                            <td>
                              <a href="#" class="btn btn-primary" id="tambah-barang">Input Barang</a>
                            </td>
                          </tr>
                          <?php if(!empty($carts) && is_array($carts)){?>
                              <?php foreach($carts['data'] as $k => $cart){?>
                                <tr id="<?php echo $k;?>" class="cart-value">
                                  <td><?php echo $cart['name'];?></td>
                                  <td><?php echo $cart['qty'];?></td>
                                  <td>Rp<?php echo number_format($cart['price']);?></td>
                                  <td><span class="btn btn-danger btn-sm transaksi-delete-item" data-cart="<?php echo $k;?>">x</span></td>
                                </tr>
                              <?php }?>
                          <?php }?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <td>Total Penjualan</td>
                            <td id="total-pembelian"><?php echo !empty($carts) ? 'Rp'.number_format($carts['total_price']) : '';?></td>
                          </tr>
                        </tfoot>
                        </tbody>
                       
                      </table>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <div class="col-md-3 col-md-offset-4">
                    <a class="btn btn-default" href="<?php echo base_url('order');?>">Cancel</a>
                    <a class="btn btn-info pull-right" href="#" id="submit-transaksi">Submit</a>
                  </div>
                </div>
                <!-- /.box-footer -->
              </form>
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

<!-- javascript -->
<script type="text/javascript">
  $(document).ready(function(){
    $("#0").show();
    $("#paket").hide();
    $("#produk").hide();
    // ambil data kabupaten ketika data memilih provinsi
      $('body').on("change","#pilih",function(){
        var id_paket = $(this).val();
        //alert(id_paket);
        //$("#id_paket").val(id_paket);
          if(id_paket==2){
            $("#paket").show();
            $("#produk").hide();
            $("#0").hide();
          }else{
            $("#paket").hide();
            $("#produk").show();
            $("#0").hide();
          }
         
      });

      // ambil data produk dan harga
      $('body').on("change","#produk",function(){
        var url =  '<?php echo base_url(); ?>' + 'admin/order/check_product/' + this.value;
        //alert(url);
        var type1 = '';
        var type2 = '';
        var type3 = '';
        $("#sale_price").text("");
        $.get(url, function(data, status) {
            if(status == 'success' && data != 'false') {
                var value = $.parseJSON(data);
                var val = value[0];
                var sale_value = '<option value="' + val.harga_customer + '">' + 'Rp. '+ parseInt(val.harga_customer) + '</option>';
                if(val.harga_mitra != "0"){
                    var type1 = '<option value="' + val.harga_mitra + '">' + 'Rp. '+ parseInt(val.harga_mitra) + '</option>';
                }
                if(val.harga_distributor != "0"){
                    var type2 = '<option value="' + val.harga_distributor + '">' + 'Rp. '+ parseInt(val.harga_distributor) + '</option>';
                }
                $("#bonus").val('0');
                $('#sale_price').append(sale_value+type1+type2);
            }
        });
      });

      // ambil promo
      $('body').on("change","#paket",function(){
        var id = $(this).find(':selected').attr('dataid');
        
        var data = "id="+id;
        //alert(data);
        $.ajax({
          type: 'POST',
          url: "<?php echo base_url('admin/order/get_promo'); ?>",
          data: data,
          success: function(hasil) {
            var response = $.parseJSON(hasil);
            var jumlah = response[0].jumlah;
            var bonus = response[0].bonus;
            //console.log(jumlah);
            $("#jumlah").val(jumlah);
            $("#bonus").val(bonus);
            if(hasil != 'false') {
              var harga = '<option value="' + response[0].harga+ '">' + 'Rp. '+ parseInt(response[0].harga) + '</option>';
              $("#sale_price").empty();
            $('#sale_price').append(harga);
            }


          }
        });
      });

      //tambah chart
      $('body').on("click","#tambah-barang",function(){
        // alert("hai");
        var paket = $("#pilih").val();
        //alert(id_produk);
        if(paket==1){
          var id_produk = $("#produk").val();
          var sale_price = $("#sale_price").val();
        }else{
          var id_produk = $("#paket").val();
          var sale_price = 170000;
        }
        var bonus = $("#bonus").val();
        var quantity = $("#jumlah").val();

        if($('#harga_satuan_net').length){
            sale_price = $('#harga_satuan_net').unmask();
        }
        if(id_produk !== null && sale_price !== null){
            $.ajax({
                url: '<?php echo base_url(); ?>' + 'admin/order/add_item',
                data: {
                    'id_produk' : id_produk,
                    'quantity' : quantity,
                    'sale_price' : sale_price,
                    'bonus' : bonus
                },
                type: 'POST',
                beforeSend : function(){
                    //$("body").faLoading();
                },
                success: function(data){
                    var res = $.parseJSON(data);
                    $(".cart-value").remove();
                    $.each(res.data, function(key,value) {
                        var row_2 = "";
                        if($('#harga_satuan_net').length){
                            //row_2 = "colspan='2'";
                        }
                        var display = '<tr class="cart-value" id="'+ key +'">' +
                                    '<td>'+ value.name +'</td>' +
                                    '<td>'+ value.qty +'</td>' +
                                    '<th '+row_2+'>Rp'+ value.subtotal +'</th>' +
                                    '<td><span class="btn btn-danger btn-sm transaksi-delete-item" data-cart="'+ key +'">x</span></td>' +
                                    '</tr>';
                        $("#transaksi-item tr:last").after(display);
                    });
                    $("#total-pembelian").text('Rp'+res.total_price);
                    $("#transaksi-item").find("input[type=text], input[type=number]").val("0");
                    //$("body").faLoading(false);
                    console.log(res);
                },
                // error: function(){
                //     alert('Something Error');
                // }
            });
        }else{
            alert("Silahkan isi semua box");
        }
        });
      //delete chart
      $(document).on("click",".transaksi-delete-item",function(e){
        var rowid = $(this).attr("data-cart");
        //$el.faLoading();
        $.get('<?php echo base_url(); ?>' + 'admin/order/delete_item/'+rowid,
            function(data,status){
                if(status == 'success'  && data != 'false'){
                    $("#"+rowid).remove();
                    console.log(data);
                    $("#total-pembelian").text('Rp'+data);
                    //$el.faLoading(false);
                }                
            }
        );
    });
      //add order
      $("#submit-transaksi").on('click',function(e){
        e.preventDefault();
        var status = false;
        var method = null;
        var arr = null;

        var kode_transaksi = $("#kode_transaksi").val();
        var supplier_id = $("#supplier_id").val();
        var status_id = $("#kode_transaksi").attr("data-attr");

        // Penjualan
        var penjualan = penjualan_status();
        if(penjualan[0] == true){
            status = penjualan[0];
            method = penjualan[1];
            arr = penjualan[2];
        }

        if(status == true) {
            $.ajax({
                url: $("#transaction-form").attr("action"),
                data: arr,
                type: 'POST',
                beforeSend: function () {
                    //$el.faLoading();
                },
                success: function (data) {
                    var response = $.parseJSON(data);
                    //$el.faLoading(false);
                    if(response.status == "ok"){
                        alert("sukses");
                        window.location.href = '<?php echo base_url('admin/order'); ?>';
                    }else if(response.status == "limit"){
                        alert("Stok jumlah produk yang anda pilih sudah habis");
                    }else{
                        alert("Data Ada yg belum diisi, Silahkan lengkapi!!!");
                    }
                }
            });
        }else{
            alert("Silahkan periksa kode transaksi atau supplier anda!");
        }
    });
      function penjualan_status(){
        var data = false;
        var kode_transaksi = $("#kode_transaksi").val();
        var id_pelanggan = $("#id_pelanggan").val();
        var nama_pelanggan = $("#nama_pelanggan").val();
        var alamat = $("#alamat").val();
        var provinsi = $("#provinsi").val();
        var kabupaten = $("#kabupaten").val();
        var kecamatan = $("#kecamatan").val();
        var ekspedisi = $("#ekspedisi").val();
        var nama_pelanggan = $("#nama_pelanggan").val();
        var ongkir = $("#ongkir").val();
        var code = $("input[name='code']:checked").val();
        var no_hp = $("#no_hp").val();
        var komoditi = $("#komoditi").val();
        var metode_pembayaran = $("#metode_pembayaran").val();
        var tanggal_transaksi = $("#tanggal_transaksi").val();
        if(typeof kode_transaksi !== "undefined" && kode_transaksi != ""){
            var status = true;
            var method = "penjualan";
            var arr = {
                'kode_transaksi': kode_transaksi,
                'id_pelanggan': id_pelanggan,
                'nama_pelanggan': nama_pelanggan,
                'alamat': alamat,
                'provinsi': provinsi,
                'kabupaten': kabupaten,
                'kecamatan': kecamatan,
                'ekspedisi': ekspedisi,
                'ongkir': ongkir,
                'no_hp': no_hp,
                'komoditi':komoditi,
                'metode_pembayaran' : metode_pembayaran,
                'code': code,
                'tanggal_transaksi' : tanggal_transaksi
            };
            data = [status,method,arr];
        }
        return data;
    }
    $( "#nama_pelanggan" ).autocomplete({
        source: "<?php echo base_url('admin/order/get_nama');?>",

        select: function (event, ui) {
                    $('[name="nama_pelanggan"]').val(ui.item.label); 
                    $('[name="id_pelanggan"]').val(ui.item.id);
                    $('[name="alamat"]').val(ui.item.alamat);
                    $('[name="no_hp"]').val(ui.item.no_hp);
                    $('[name="komoditi"]').val(ui.item.komoditi);
                    $('[name="kecamatan"]').val(ui.item.kecamatan);
                    $('[name="kabupaten"]').val(ui.item.kabupaten);
                    $('[name="provinsi"]').val(ui.item.provinsi);
                }
      });
    });
</script>