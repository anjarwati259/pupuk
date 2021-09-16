<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        show_data();
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
          //count_chat();
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
                        $(".balas").removeClass('d-none')
                    }
                });
                }
                count_group();
            });
        }
        function show_chat(){
            var id = $(".avatar-lawan").attr("id");
            //alert(x);
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
            }
        }

        //kirim chat group
        $("body").on("click",".balas-kirim",function(){
            var ketik = $("#balas-ketik").val();
            if(ketik.length > 0){
                //var lawan = $(".avatar-lawan").attr('id');
                var data = "ketik="+ketik;
                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('admin/chat/add_group') ?>",
                    data: data,
                    success: function(html) {
                        // $("#balas-ketik").val("");
                        // $(".pesan").append(html);
                        var x = $(".pesan").height()+221000;
                        $(".pesan").scrollTop(x);
                    }
                });
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

      });
</script>