<?php if($this->session->flashdata('sukses')) { ?>
  <script type="text/javascript">
    var pesan = '<?php echo $this->session->flashdata('sukses') ?>'
    toastr.success(pesan);
  </script>
<?php }else if($this->session->flashdata('error')){ ?>
  <script type="text/javascript">
    var pesan = '<?php echo $this->session->flashdata('error') ?>'
    toastr.error(pesan);
  </script>
<?php }; ?>
<script type="text/javascript">
  $(document).ready(function(){
    if(localStorage.getItem("sukses"))
    {
        toastr.success("Data Berhasil Ditambah");
        localStorage.clear();
    }else if(localStorage.getItem("edit")){
      toastr.success("Data Berhasil Diedit");
        localStorage.clear();
    }

    // ====================================== Pelanggan============================
    $("body").on("click","#input-pelanggan",function(){
      var nama_pelanggan = $("#nama_pelanggan").val();
      var no_hp = $("#no_hp").val();
      var alamat = $("#alamat").val();
      var id_marketing = $('#id_marketing option:selected').val();
      var jenis_pelanggan = $('#jenis_pelanggan').val();
      var status = $('#status option:selected').val();
      var provinsi = $('#form_prov option:selected').text();
      var kabupaten = $('#form_kab option:selected').text();
      var kecamatan = $('#form_kec option:selected').text();

      var data = {nama_pelanggan:nama_pelanggan,
            no_hp:no_hp,
            alamat:alamat,
            id_marketing:id_marketing,
            jenis_pelanggan:jenis_pelanggan,
            status:status,
            provinsi:provinsi,
            kabupaten:kabupaten,
            kecamatan : kecamatan
            }
      // console.log(data);
      $.ajax({
            type: 'POST',
            url: "<?php echo base_url('office/admin/add_pelanggan'); ?>",
            data:data,
            dataType : 'json',
            success: function(data) {
              console.log(data);
              if (data=='sukses') {
                localStorage.setItem("sukses",data)
                window.location.reload(); 
              }else if(data=='error'){
                $('#modal-input').modal('hide');
                toastr.error("Data Ada yg belum diisi, Silahkan lengkapi!!!");
              }
            }
        });
    });

    //set data pelanggan
    $("body").on("click",".btn-edit",function(){
      var id_pelanggan = $(this).data('id');

      $.ajax({
            type: 'POST',
            url: "<?php echo base_url('office/admin/detail_pelanggan'); ?>",
            data:{id_pelanggan:id_pelanggan},
            dataType : 'json',
            success: function(hasil) {
              $("#id_pelanggan_edit").val(hasil['pelanggan'].id_pelanggan);
              $("#nama_pelanggan_edit").val(hasil['pelanggan'].nama_pelanggan);
              $("#no_hp_edit").val(hasil['pelanggan'].no_hp);
              $("#alamat_edit").val(hasil['pelanggan'].alamat);
              $("#id_marketing_edit").val(hasil['pelanggan'].id_marketing);
              $("#jenis_pelanggan_edit").val(hasil['pelanggan'].jenis_pelanggan);
              $("#status_edit").val(hasil['pelanggan'].status);

              $("#form_prov_edit").val(hasil['prov'].kode).change();
              setTimeout(function () {
                $("#form_kab_edit").val(hasil['kab'].kode).change();
                }, 400);
              setTimeout(function () {
                $("#form_kec_edit").val(hasil['kec'].kode).change();
                }, 600);
              // alert(hasil);
              console.log(hasil);
            }
        });
    });

    // edit pelanggan
    $("body").on("click","#edit-pelanggan",function(){
      var id = $("#id_pelanggan_edit").val();
      var nama_pelanggan = $("#nama_pelanggan_edit").val();
      var no_hp = $("#no_hp_edit").val();
      var alamat = $("#alamat_edit").val();
      var id_marketing = $('#id_marketing_edit option:selected').val();
      var jenis_pelanggan = $('#jenis_pelanggan_edit').val();
      var status = $('#status_edit option:selected').text();
      var provinsi = $('#form_prov_edit option:selected').text();
      var kabupaten = $('#form_kab_edit option:selected').text();
      var kecamatan = $('#form_kec_edit option:selected').text();

      var data = {nama_pelanggan:nama_pelanggan,
            id:id,
            no_hp:no_hp,
            alamat:alamat,
            id_marketing:id_marketing,
            jenis_pelanggan:jenis_pelanggan,
            status:status,
            provinsi:provinsi,
            kabupaten:kabupaten,
            kecamatan : kecamatan
            }
      // console.log(data);
      $.ajax({
            type: 'POST',
            url: "<?php echo base_url('office/admin/edit_pelanggan'); ?>",
            data:data,
            dataType : 'json',
            success: function(data) {
              // console.log(data);
              if (data=='sukses') {
                localStorage.setItem("sukses",data)
                window.location.reload(); 
              }else if(data=='error'){
                $('#modal-input').modal('hide');
                toastr.error("Data Ada yg belum diisi, Silahkan lengkapi!!!");
              }
            }
        });
    });

    // ====================================== Calon Pelanggan ==========================
    $("body").on("click","#input-calon",function(){
      var nama_calon = $("#nama_calon").val();
      var no_hp = $("#no_hp").val();
      var alamat = $("#alamat").val();
      var id_marketing = $('#id_marketing option:selected').val();
      var komoditi = $('#komoditi').val();
      var keterangan = $('#keterangan').val();
      var tanggal = $('#tanggal').val();
      var status = $('#status option:selected').val();
      var provinsi = $('#form_prov option:selected').text();
      var kabupaten = $('#form_kab option:selected').text();
      var kecamatan = $('#form_kec option:selected').text();

      var data = {nama_calon:nama_calon,
            no_hp:no_hp,
            alamat:alamat,
            id_marketing:id_marketing,
            komoditi:komoditi,
            keterangan:keterangan,
            status:status,
            tanggal:tanggal,
            provinsi:provinsi,
            kabupaten:kabupaten,
            kecamatan : kecamatan
            }
      // console.log(data);
      $.ajax({
            type: 'POST',
            url: "<?php echo base_url('office/admin/add_calon'); ?>",
            data:data,
            dataType : 'json',
            success: function(data) {
              console.log(data);
              if (data=='sukses') {
                localStorage.setItem("sukses",data)
                window.location.reload(); 
              }else if(data=='error'){
                $('#modal-input').modal('hide');
                toastr.error("Data Ada yg belum diisi, Silahkan lengkapi!!!");
              }
            }
        });
    });

    //set data calon pelanggan
    $("body").on("click",".btn-calon",function(){
      var id_calon = $(this).data('calon');

      $.ajax({
            type: 'POST',
            url: "<?php echo base_url('office/admin/detail_calon'); ?>",
            data:{id_calon:id_calon},
            dataType : 'json',
            success: function(hasil) {
              $("#id_calon_edit").val(hasil['pelanggan'].id_calon);
              $("#nama_calon_edit").val(hasil['pelanggan'].nama_calon);
              $("#no_hp_edit").val(hasil['pelanggan'].no_hp);
              $("#alamat_edit").val(hasil['pelanggan'].alamat);
              $("#id_marketing_edit").val(hasil['pelanggan'].id_marketing);
              $("#komoditi_edit").val(hasil['pelanggan'].komoditi);
              $("#keterangan_edit").val(hasil['pelanggan'].keterangan);
              $("#status_edit").val(hasil['pelanggan'].status);

              $("#form_prov_edit").val(hasil['prov'].kode).change();
              setTimeout(function () {
                $("#form_kab_edit").val(hasil['kab'].kode).change();
                }, 400);
              setTimeout(function () {
                $("#form_kec_edit").val(hasil['kec'].kode).change();
                }, 600);
              // alert(hasil);
              console.log(hasil);
            }
        });
    });

    // edit pelanggan
    $("body").on("click","#edit-calon",function(){
      var id = $("#id_calon_edit").val();
      var nama_calon = $("#nama_calon_edit").val();
      var no_hp = $("#no_hp_edit").val();
      var alamat = $("#alamat_edit").val();
      var id_marketing = $('#id_marketing_edit option:selected').val();
      var komoditi = $('#komoditi_edit').val();
      var keterangan = $('#keterangan_edit').val();
      var tanggal = $('#tanggal_edit').val();
      var status = $('#status_edit option:selected').val();
      var provinsi = $('#form_prov_edit option:selected').text();
      var kabupaten = $('#form_kab_edit option:selected').text();
      var kecamatan = $('#form_kec_edit option:selected').text();

      var data = {nama_calon:nama_calon,
            id_calon: id,
            no_hp:no_hp,
            alamat:alamat,
            id_marketing:id_marketing,
            komoditi:komoditi,
            keterangan:keterangan,
            status:status,
            tanggal:tanggal,
            provinsi:provinsi,
            kabupaten:kabupaten,
            kecamatan : kecamatan
            }
      //console.log(data);
      $.ajax({
            type: 'POST',
            url: "<?php echo base_url('office/admin/edit_calon'); ?>",
            data:data,
            dataType : 'json',
            success: function(data) {
              // console.log(data);
              if (data=='sukses') {
                localStorage.setItem("sukses",data)
                window.location.reload(); 
              }else if(data=='error'){
                $('#modal-input').modal('hide');
                toastr.error("Data Ada yg belum diisi, Silahkan lengkapi!!!");
              }
            }
        });

    });

    // ======================================= expedisi ===========================
    //set data expedisi
    $("body").on("click",".btn-expedisi",function(){
      var id_expedisi = $(this).data('expedisi');
      //alert(id_expedisi);
      $.ajax({
            type: 'POST',
            url: "<?php echo base_url('office/admin/detail_expedisi'); ?>",
            data:{id:id_expedisi},
            dataType : 'json',
            success: function(hasil) {
              $("#id").val(hasil.id_expedisi);
              $("#ekspedisi").val(hasil.expedisi);
              $("#kode").val('edit');

              // alert(hasil);
              console.log(hasil);
            }
        });
    });

    // edit expedisi
    $("body").on("click","#btn_submit",function(){
      var id = $("#id").val();
      var expedisi = $("#ekspedisi").val();
      var kode = $("#kode").val();

      var data = {expedisi:expedisi,
            id: id,
            }
      // console.log(kode);
      if(kode==='tambah'){
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('office/admin/add_expedisi'); ?>",
            data:{expedisi:expedisi},
            dataType : 'json',
            success: function(data) {
              // console.log(data);
              if (data=='sukses') {
                localStorage.setItem("sukses",data)
                window.location.reload(); 
              }else if(data=='error'){
                $('#modal-input').modal('hide');
                toastr.error("Data Ada yg belum diisi, Silahkan lengkapi!!!");
              }
            }
        });
      }else{
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url('office/admin/edit_expedisi'); ?>",
            data:data,
            dataType : 'json',
            success: function(data) {
              // console.log(data);
              if (data=='sukses') {
                localStorage.setItem("sukses",data)
                window.location.reload(); 
              }else if(data=='error'){
                $('#modal-input').modal('hide');
                toastr.error("Data Ada yg belum diisi, Silahkan lengkapi!!!");
              }
            }
        });
      }
      
    });

    // ======================================== Marketing ===============================
    $("body").on("click","#input-marketing",function(){
      var nama_marketing = $("#nama_marketing").val();
      var no_hp = $("#no_hp").val();
      var alamat = $("#alamat").val();
      var status = $('#status option:selected').val();

      var data = {nama_marketing:nama_marketing,
            no_hp:no_hp,
            alamat:alamat,
            status:status
            }
      // console.log(data);
      $.ajax({
            type: 'POST',
            url: "<?php echo base_url('office/admin/add_marketing'); ?>",
            data:data,
            dataType : 'json',
            success: function(data) {
              // console.log(data);
              if (data=='sukses') {
                localStorage.setItem("sukses",data)
                window.location.reload(); 
              }else if(data=='error'){
                $('#modal-input').modal('hide');
                toastr.error("Data Ada yg belum diisi, Silahkan lengkapi!!!");
              }
            }
        });
    });

    //set data marketing
    $("body").on("click",".btn-market",function(){
      var id = $(this).data('market');
      $.ajax({
            type: 'POST',
            url: "<?php echo base_url('office/admin/detail_marketing'); ?>",
            data:{id:id},
            dataType : 'json',
            success: function(hasil) {
              $("#id_marketing_edit").val(hasil.id_marketing);
              $("#nama_marketing_edit").val(hasil.nama_marketing);
              $("#no_hp_edit").val(hasil.no_hp);
              $("#alamat_edit").val(hasil.alamat);
              $("#status_edit").val(hasil.status).change();

              // alert(hasil);
              console.log(hasil);
            }
        });
    });

    $("body").on("click","#edit-marketing",function(){
      var id_marketing = $("#id_marketing_edit").val();
      var nama_marketing = $("#nama_marketing_edit").val();
      var no_hp = $("#no_hp_edit").val();
      var alamat = $("#alamat_edit").val();
      var status = $('#status_edit option:selected').val();

      var data = {nama_marketing:nama_marketing,
            id:id_marketing,
            no_hp:no_hp,
            alamat:alamat,
            status:status
            }
      $.ajax({
            type: 'POST',
            url: "<?php echo base_url('office/admin/edit_marketing'); ?>",
            data:data,
            dataType : 'json',
            success: function(data) {
              // console.log(data);
              if (data=='sukses') {
                localStorage.setItem("sukses",data)
                window.location.reload(); 
              }else if(data=='error'){
                $('#modal-input').modal('hide');
                toastr.error("Data Ada yg belum diisi, Silahkan lengkapi!!!");
              }
            }
        });
    });

    $("body").on("click",".btn-aktif",function(){
      var id = $(this).data('market');
      $.ajax({
            type: 'POST',
            url: "<?php echo base_url('office/admin/aktif'); ?>",
            data:{id:id},
            dataType : 'json',
            success: function(hasil) {
              if (data=='sukses') {
                localStorage.setItem("sukses",data)
                window.location.reload(); 
              }else if(data=='error'){
                // $('#modal-input').modal('hide');
                toastr.error("Data Ada yg belum diisi, Silahkan lengkapi!!!");
              }
            }
        });
    });

// ===================================== konfigurasi wilayah =============================
    // ambil data kabupaten ketika data memilih provinsi input
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


    // edit
    $('body').on("change","#form_prov_edit",function(){
      var id = $(this).val();
      var data = "id="+id+"&data=kabupaten";
      $.ajax({
        type: 'POST',
        url: "<?php echo base_url('wilayah/get_wilayah'); ?>",
        data: data,
        success: function(hasil) {
           $("#form_kab_edit").html(hasil);
          //alert("sukses");
        }
      });
    });

    // ambil data kecamatan/kota ketika data memilih kabupaten
    $('body').on("change","#form_kab_edit",function(){
      var id = $(this).val();
      var data = "id="+id+"&data=kecamatan";
      $.ajax({
        type: 'POST',
        url: "<?php echo base_url('wilayah/get_wilayah'); ?>",
        data: data,
        success: function(hasil) {
          $("#form_kec_edit").html(hasil);
        }
      });
    });

     //get provinsi
    $('body').on("change","#form_prov_edit",function(){
      var id=$(this).val();
      $.ajax({
          type : "POST",
          url  : "<?php echo base_url('wilayah/getprov'); ?>",
          dataType : "JSON",
          data : {id: id},
          cache:false,
          success: function(data){
              $.each(data,function(nama){
                  $('[name="form_prov_edit"]').val(data.nama);
                   
              });
               
          }
      });
      return false; 
    });

    });
</script>