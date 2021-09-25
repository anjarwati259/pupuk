<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        show_data();
        //show_chat();
        count_user();
        //end_chat();
        count_group();

        // realtime chat
        Pusher.logToConsole = true;

        var pusher = new Pusher('195f2f8525152075f786', {
          cluster: 'ap1'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
          //alert(JSON.stringify(data));
          show_chat();
          count_group();
          count_user();
        });
        //tampil chat
        function show_data(){
            $("body").on("click",".teman-list",function(){
                var id_user = $(this).attr('id');
                var data = "&id="+id_user;
                //alert(data);
                if(id_user=='group'){
                    $.ajax({
                        type: 'POST', 
                        url: "<?php echo base_url('admin/chat/read_group') ?>",
                        data: data,
                        success: function(html) {
                            //alert(html);
                            $(".pesan").html(html);
                            //$(".balas").removeClass('d-none');
                            // $(".avatar-lawan").attr("id",id_user);
                             var x = $(".pesan").height()+221000000000;
                             $(".pesan").scrollTop(x);
                            // $("#balas-ketik").val("");
                            // $(".kotak-kiri-mobile").removeClass("d-block");
                        }
                    });

                    $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('admin/chat/tampil_lawan') ?>",
                    data: data,
                    success: function(html2) {
                        $(".lawan").html(html2);
                        $(".balas").removeClass('d-none');
                    }
                });
                    count_group();
                }else{
                    var id_user = $(this).attr('id');
                    var data = "&id="+id_user;
                   $.ajax({
                        type: 'POST', 
                        url: "<?php echo base_url('admin/chat/read_chat') ?>",
                        data: data,
                        success: function(html) {
                            //alert(html);
                            $(".pesan").html(html);
                            //$(".balas").removeClass('d-none');
                            //$(".avatar-lawan").attr("id",id_user);
                             var x = $(".pesan").height()+221000000000;
                             $(".pesan").scrollTop(x);
                            // $("#balas-ketik").val("");
                            // $(".kotak-kiri-mobile").removeClass("d-block");
                        }
                    });

                   $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('admin/chat/tampil_lawan') ?>",
                    data: data,
                    success: function(html2) {
                        $(".lawan").html(html2);
                        $(".balas").removeClass('d-none');
                        }
                    });
                   count_user();
                }

            });
        }
        function show_chat(){
            var id = $(".avatar-lawan").attr("id");
            //alert(id);
            if(id=='group'){
                $.ajax({
                    type: 'POST', 
                    url: "<?php echo base_url('admin/chat/read_group') ?>",
                    success: function(html) {
                        //alert(html);
                        $(".pesan").html(html);
                        //$(".balas").removeClass('d-none');
                        // $(".avatar-lawan").attr("id",id_user);
                        var x = $(".pesan").height()+221000000000;
                        $(".pesan").scrollTop(x);
                        $("#balas-ketik").val("");
                        // $(".kotak-kiri-mobile").removeClass("d-block");
                    }
                });
            }else{
                var id = $(".avatar-lawan").attr("id");
                var data = "&id="+id;
                $.ajax({
                    type: 'POST',
                    data: data,
                    url: "<?php echo base_url('admin/chat/read_chat') ?>",
                    success: function(html) {
                        //alert(html);
                        $(".pesan").html(html);
                        //$(".balas").removeClass('d-none');
                        // $(".avatar-lawan").attr("id",id_user);
                        var x = $(".pesan").height()+221000000000;
                        $(".pesan").scrollTop(x);
                        $("#balas-ketik").val("");
                        // $(".kotak-kiri-mobile").removeClass("d-block");
                    }
                });
            }
        }

        //kirim chat group
        $("body").on("click","#balas-kirim",function(){
            var id = $(".avatar-lawan").attr("id");
            var ketik = $("#balas-ketik").val();
            //alert(id);
            if(id=='group'){
                if(ketik.length > 0){
                    //var lawan = $(".avatar-lawan").attr('id');
                    var data = "ketik="+ketik;
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url('admin/chat/add_group') ?>",
                        data: {ketik:ketik},
                        success: function(html) {
                            //alert(html)
                            // $("#balas-ketik").val("");
                            // $(".pesan").append(html);
                            var x = $(".pesan").height()+221000;
                            $(".pesan").scrollTop(x);
                        }
                    });
                }
            }else{
                if(ketik.length > 0){
                    //var lawan = $(".avatar-lawan").attr('id');
                    var data = "ketik="+ketik+"&lawan="+id;

                    //alert(data);
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url('admin/chat/add_chat') ?>",
                        data: data,
                        success: function(html) {
                            // $("#balas-ketik").val("");
                            // $(".pesan").append(html);
                            var x = $(".pesan").height()+221000;
                            $(".pesan").scrollTop(x);
                        }
                    });
                }
            }

        });

        //enter kirim chat 
        var input = document.getElementById("balas-ketik");
        input.addEventListener("keyup", function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                document.getElementById("balas-kirim").click();
            }
        });

        //hitung jumlah chat group
        function count_group(){
            var id = $(".avatar-lawan").attr("id");
          //alert(id_user);
              $.ajax({
                  url   : '<?php echo base_url("admin/chat/count_group");?>',
                  type  : 'GET',
                  async : true,
                  dataType : 'json',
                  success : function(data){
                    var total = data.total_chat;
                    var read = data.read_chat;
                    var total_chat = parseInt(total-read);
                    $('.count-group').html(total_chat);
                  }

              });
        }
        //hitung jumlah chat group
        function count_user(){
            var id = $(".avatar-lawan").attr("id");
            var data = "&id="+id;

            //alert(id);
            //$('.count-user').html(id);
              $.ajax({
                  url   : '<?php echo base_url("admin/chat/count_user");?>',
                  type  : 'GET',
                  async : true,
                  data  : data,
                  dataType : 'json',
                  success : function(data){
                    //alert(data.length);
                    var i;
                    for(i=0; i<data.length; i++){
                        var total = data[i].total;
                        var read = data[i].read;
                        var total_chat = parseInt(total-read);
                        $('.count-user-'+data[i].user2).html(total_chat);
                    }
                  }
              });
        }

        function end_chat(){
            var id = $(".avatar-lawan").attr("id");
            var data = "&id="+id;
            alert(data);
            // $.ajax({
            //       url   : '<?php echo base_url("admin/chat/end_chat");?>',
            //       type  : 'GET',
            //       async : true,
            //       data  : data,
            //       dataType : 'json',
            //       success : function(data){
            //         alert(data);
            //       }
            //   });

        }
      });

$(document).on( "click", '.tarik',function(e) {
    var id = $(this).data('id');
    var data = '&id='+id;
    if(confirm('apakah anda yakin akan menarik pesan ini? ?')) {
        $.ajax({
            type: 'POST', 
            data: data,
            url: "<?php echo base_url('admin/chat/tarik_pesan') ?>",
            success: function(html) {
                //alert(html);
            }
        });
    }

})
</script>