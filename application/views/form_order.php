<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/font-awesome.min.css">

    <title>PT AGI - Official</title>
    <style type="text/css">
      .gradient-custom {
        /* fallback for old browsers */
        background: #D9F5D3;

      }
      .card-registration .select-input.form-control[readonly]:not([disabled]) {
        font-size: 1rem;
        line-height: 2.15;
        padding-left: .75em;
        padding-right: .75em;
      }
      .card-registration .select-arrow {
        top: 13px;
      }
    </style>
  </head>
  <body>
    <section class="vh-200 gradient-custom">
      <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
          <div class="col-12 col-lg-10 col-xl-8">
            <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
              <div class="card-body p-4 p-md-5">
                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5" style="text-align: center;">PESAN SEKARANG, BISA DAPAT FREE ONGKIR 20K!</h3>
                <form>
                  <h5 class="mb-2 pb-1">Data Penerima</h5>
                  <div class="row">
                    <div class="col-md-6 mb-4 d-flex align-items-center">

                      <div class="form-outline datepicker w-100">
                        <input type="text" class="form-control" id="nama" placeholder="Nama Anda" />
                      </div>
                    </div>

                    <div class="col-md-6 mb-4 d-flex align-items-center">

                      <div class="form-outline datepicker w-100">
                        <input type="number" class="form-control" id="no_hp" placeholder="No WhatsApp Anda" />
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 mb-4 pb-2">

                      <div class="form-outline">
                        <input style="height: 50px;" type="text" id="alamat" class="form-control form-control-lg" placeholder="Alamat Lengkap anda" />
                      </div>

                    </div>
                  </div>

                  <div class="row">
                    <div class="col-4">

                      <select class="select form-control" id="form_prov" name="provinsi">
                        <option>Pilih Provinsi</option>
                        <?php foreach ($provinsi as $key => $value) {?>
                        	<option value="<?php echo $value->kode ?>"><?php echo $value->nama ?></option>
                    	<?php } ?>
                      </select>

                    </div>
                    <div class="col-4">

                      <select class="select form-control" id="form_kab" name="kabupaten">
                        <option>Pilih Kabupaten</option>
                      </select>

                    </div>
                    <div class="col-4">

                      <select class="select form-control" id="form_kec" name="kecamatan">
                        <option>Pilih Kecamatan</option>
                      </select>

                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 mt-4">
                      <h5 class="mb-2 pb-1">Pilih Produk</h5>
                      <form id="formProduk">
                        <select class="select form-control select2" id="produk">
                        <option disabled="">Pilih Produk</option>
                        <?php foreach ($produk as $key => $value) {?>
                        	<option value="<?php echo $value->kode_produk ?>"><?php echo $value->nama_produk ?></option>
                    	<?php } ?>
                      </select>
                      </form>
                    </div>
                  </div>
                  <div class="row">
                  	<?php
		              $this->db->select('*');
		              $this->db->from('tb_produk');
		              $this->db->where('kode_produk','PK001');
		              $data = $this->db->get()->row();
		             ?>
                    <div class="col-md-12 mt-4">
                      <h5 class="pb-1">Rincian Order</h5>
                      <div class="mb-2 row">
                        <label class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control prc" id="jml" value="1">
                        </div>
                      </div>
                      <div class="mb-2 row">
                        <label class="col-sm-3 col-form-label">Harga</label>
                        <div class="col-sm-4">
                          <!-- <input type="text" class="form-control" id="harga1" value="<?php echo rupiah($data->harga_customer) ?>" readonly> -->
                          <input type="text" class="form-control" id="harga" value="<?php echo $data->harga_customer ?>" readonly>
                        </div>
                      </div>
                      <div class="mb-2 row">
                        <label class="col-sm-3 col-form-label">Total Harga</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="total" value="<?php echo "170000" ?>" readonly>
                        </div>
                      </div>
                      <label class="form-label" style="color: red;">*Total Harga Belum Termasuk Ongkir, Ongkir akan Di beritahukan Via WhatsApp</label>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 mt-4">

                      <h5 class="pb-1">Metode Pembayaran</h5>
                      <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="metode_bayar" id="metode_bayar" value="1"
                            checked
                          />
                          <label class="form-check-label" for="femaleGender">Transfer Bank</label>
                        </div>

                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="metode_bayar" id="metode_bayar" value="0"
                            checked
                          />
                          <label class="form-check-label" for="femaleGender">COD (Bayar di Tempat)</label>
                        </div>
                  	</div>
                  </div>

                  <div class="mt-4 pt-2">
                    <button class="btn btn-success btn-lg" id="btn-submit" type="submit" value="Submit">Kirim Data Order</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript">

    	$(document).ready(function() {
    		$("body").on("change",".select2",function(){
				var id = $('#produk option:selected').val();
				// alert('bisa');
				$.ajax({
			        type: 'POST',
			        url: "<?php echo base_url('home/get_produk'); ?>",
			        data:{id:id},
			        dataType : 'json',
			        success: function(hasil) {
			           // alert(hasil.kode_produk);
			          var jml = $('#jml').val();
			          var total = parseInt(jml)*parseInt(hasil.harga_customer);
			          $("#harga").val(hasil.harga_customer);
			          $("#total").val(total);
			        }
			    });
			});

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

		    //save order
		    $("body").on("click","#btn-submit",function(){
				var nama = $('#nama').val();
				var no_hp = $('#no_hp').val();
				var alamat = $('#alamat').val();
				var jml = $('#jml').val();
				var harga = $('#harga').val();
				var total = $('#total').val();
				var prov = $('#form_prov option:selected').text();
				var kab = $('#form_kab option:selected').text();
				var kec = $('#form_kec option:selected').text();
				var produk = $('#produk option:selected').val();
				var metode_bayar = $("input[name='metode_bayar']:checked").val();
				console.log(metode_bayar);				
				var data = {nama:nama,
					no_hp:no_hp,
					alamat:alamat,
					jml:jml,
					harga:harga,
					total:total,
					prov:prov,
					kab:kab,
					kec : kec,
					produk:produk,
					metode_bayar:metode_bayar
					}
				$.ajax({
			        type: 'POST',
			        url: "<?php echo base_url('home/add_order'); ?>",
			        data:data,
			        dataType : 'json',
			        success: function(hasil) {
			          // toastr.error("sukses");
			        }
			    });
			});
    	});

    	$(function(){
			var total = function(){
				$('.prc').each(function(){
		        var harga = $("#harga").val();
		        var jml = $("#jml").val();
		        var total = parseInt(jml) * parseInt(harga);
		        $("#total").val(total);
		      });
			}
			$('.prc').keyup(function(){
		      total();
		    });
		});
    </script>

  </body>
</html>