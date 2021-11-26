<script type="text/javascript">
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
    //get follow
    $('body').on("click",".detail",function(){
      var id = $(this).data('id');
      var nama = $(this).data('nama');
      $('#nama_pelanggan').html(nama);
      var data = "id="+id;
      //alert(id);
      //var html = '<i class="fa fa-clock-o"></i> &nbsp'+tgl;
      //$('#time').html(html);
      $.ajax({
          url   : '<?php echo base_url("admin/pelanggan/detail_follow");?>',
          type  : 'POST',
          async : true,
          data  : {id:id},
          dataType : 'json',
          success : function(data){
            var i;
            var html2 = '';
            for(i=0; i<data.length; i++){
              var html = '<i class="fa fa-clock-o"></i> &nbsp'+data[i].last_kontak;
              html2 += '<i class="fa fa-envelope bg-blue"></i> <div class="timeline-item"><span class="time" id="time"><i class="fa fa-clock-o"></i> '+data[i].last_kontak+'</span><h3 class="timeline-header"><a href="#">'+data[i].nama_marketing+'</a> Mengirim Pesan WhatsApp ke <a href="#">'+data[i].nama_pelanggan+'</a></h3><div class="timeline-body">'+data[i].text+'</div></div>'
            }
            $('.foll-up').html(html2);
          }
      });
    });

    $('body').on("click",".follow",function(){
      var id = $(this).data('id');
      var no_hp = $(this).data('no');
      var id_marketing = $(this).data('market');
      var data = "id="+id;
      $('#no_hp').val(no_hp);
      $('#id_marketing').val(id_marketing);
      $('#id_pelanggan').val(id);
      //alert(no_hp);

      //var html = '<i class="fa fa-clock-o"></i> &nbsp'+tgl;
      //$('#time').html(html);
      $.ajax({
          url   : '<?php echo base_url("admin/pelanggan/count_follow");?>',
          type  : 'POST',
          async : true,
          data  : {id:id},
          dataType : 'json',
          success : function(data){
            var tot = data.total;
            var total = parseInt(tot)+1;
            //alert(total);
            $('.total').html(total);
          }
      });
    });

    $('#btn-submit').on('click', function() {
      var id_Pelanggan = $('#id_pelanggan').val();
      var id_marketing = $('#id_marketing').val();
      var no_hp = $('#no_hp').val();
      var text = $('#text-follow').val();
      var text2 = encodeURI(text);
      
      //alert(url);

      $.ajax({
        url: "<?php echo base_url('admin/pelanggan/follow') ?>",
        type: "POST",
        data: {
          id_pelanggan: id_Pelanggan,
          id_marketing: id_marketing,
          text_follow: text,
          status: 1,     
        },
        cache: false,
        success: function(dataResult){
          var dataResult = JSON.parse(dataResult);
          if(dataResult.statusCode==200){
            var url =  'https://api.whatsapp.com/send?phone='+no_hp+'&text='+text2;
            window.open(url);
            location.reload();         
          }
          else{
             alert("Text Belum Diisi");
          }
          
        }
      });

    });
  });
</script>