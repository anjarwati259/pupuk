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
    
    $("body").on("click","#input-pelanggan",function(){
      var nama_pelanggan = $("#nama_pelanggan").val();
      var no_hp = $("#no_hp").val();
      var alamat = $("#alamat").val();
      var id_marketing = $('#id_marketing option:selected').val();
      var jenis_pelanggan = $('#jenis_pelanggan option:selected').val();
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