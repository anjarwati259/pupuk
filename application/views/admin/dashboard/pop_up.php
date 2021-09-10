
<div class="row">
  <div class="col-md-3">

    <div class="box box-solid">
      <div class="box-header with-border">
        <h3 class="box-title">Member</h3>

        <div class="box-tools">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="box-body no-padding">
        <ul class="nav nav-pills nav-stacked">
          <?php foreach ($member as $member) {?>
          <li><a href="#"><i class="fa fa-user"></i> <?php echo $member->nama_marketing ?></a></li>
        <?php } ?>
        </ul>
      </div>
      <!-- /.box-body -->
    </div>
  </div>

  <div class="col-md-9">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Pesan</h3>

        <div class="box-tools pull-right">
          <div class="has-feedback">
            <input type="text" class="form-control input-sm" placeholder="Search Mail">
            <span class="glyphicon glyphicon-search form-control-feedback"></span>
          </div>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body no-padding">
        <div class="direct-chat-messages showchat" style="height: 400px;">

        </div>
        <div class="box-footer">
          <form action="#" method="post">
            <div class="input-group">
              <textarea style="height: auto;" name="message" id="textsend" placeholder="Type Message ..." class="form-control"></textarea>
                  <span class="input-group-btn">
                    <button type="button" id="sendchat" class="btn btn-primary btn-flat">Send</button>
                  </span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
$(document).ready(function(){
  show_chat();
});
  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('195f2f8525152075f786', {
    cluster: 'ap1'
  });

  var channel = pusher.subscribe('my-channel');
  channel.bind('my-event', function(data) {
    //alert(JSON.stringify(data));
    show_chat();
  });

  function show_chat(){
    var id_user = "<?php echo $this->session->userdata('id_user')?>";
    //alert(id_user);
    $.ajax({
        url   : '<?php echo site_url("admin/dashboard/read_chat");?>',
        type  : 'GET',
        async : true,
        dataType : 'json',
        success : function(data){
            var html = '';
            var count = 1;
            var i;
            for(i=0; i<data.length; i++){
              if(data[i].id_user!= id_user){
                html += '<div class="direct-chat-msg"> <div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left" style="font-size: 15px;">'+data[i].nama_marketing+'</span><span class="direct-chat-timestamp pull-right"> 23 Jan 2:00 pm</span></div><div class="direct-chat-text" style="white-space: pre-wrap;"><span>'+data[i].chat+'</span></div></div>';
              }else{
                html += '<div class="direct-chat-msg right"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right" style="font-size: 15px;">'+data[i].nama_marketing+'</span><span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span></div><div class="direct-chat-text bg-green" style="white-space: pre-wrap;"><span>'+data[i].chat+'</span></div></div>';
              }
            }
            //alert(data.length);

            $('.showchat').html(html);
        }

    });
}

  $('#sendchat').on('click',function(){
      var textsend = $('#textsend').val();

      $.ajax({
          url    : '<?php echo site_url("admin/dashboard/add_chat");?>',
          method : 'POST',
          data   : {message: textsend},
          success: function(){
              $('#textsend').val("");
              $(".showchat").animate({ scrollTop: $(document).height() }, "slow");
          }
      });
  });  
</script>