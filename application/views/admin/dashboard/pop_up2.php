
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
          <li class="active"><a href="#"><i class="fa fa-inbox"></i> Inbox
            <span class="label label-primary pull-right">12</span></a></li>
          <li><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
          <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
          <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a>
          </li>
          <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
        </ul>
      </div>
      <!-- /.box-body -->
    </div>
  </div>

  <div class="col-md-9">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Inbox</h3>

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
        <div class="direct-chat-messages">
          <!-- from -->
          <?php foreach ($chat as $chat) { 
            $id_user = $this->session->userdata('id_user');
            $this->db->select('id_marketing');
            $this->db->where('id_user', $id_user);
            $this->db->from('tb_marketing');
            $id = $this->db->get()->row();
          ?>
          <?php if($id->id_marketing != $chat->id_marketing){ ?>
          <div class="direct-chat-msg" >
            <div class="direct-chat-info clearfix">
              <span class="direct-chat-name pull-left" style="font-size: 15px;"><?php echo $chat->nama_marketing ?></span>
              <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
            </div>
            <!-- /.direct-chat-info -->
            <!-- <img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="Message User Image"> --><!-- /.direct-chat-img -->
            <div class="direct-chat-text">
              <span><?php echo $chat->chat ?></span>
            </div>
            <!-- /.direct-chat-text -->
          </div>
          <!-- to -->
        <?php }else{ ?>
          <div class="direct-chat-msg right">
            <div class="direct-chat-info clearfix">
              <span class="direct-chat-name pull-right" style="font-size: 15px;"><?php echo $chat->nama_marketing ?></span>
              <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
            </div>
            <!-- /.direct-chat-info -->
            <!-- <img class="direct-chat-img" src="../dist/img/user3-128x128.jpg" alt="Message User Image"> --><!-- /.direct-chat-img -->
            <div class="direct-chat-text bg-green">
              <span id="fromchat"><?php echo $chat->chat ?></span>
            </div>
          </div>
        <?php }} ?>
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

  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('195f2f8525152075f786', {
    cluster: 'ap1'
  });

  var channel = pusher.subscribe('my-channel');
  channel.bind('my-event', function(data) {
    //alert(JSON.stringify(data));
    
  });

  $('#sendchat').on('click',function(){
      var textsend = $('#textsend').val();
      $.ajax({
          url    : '<?php echo site_url("admin/dashboard/add_chat");?>',
          method : 'POST',
          data   : {message: textsend},
          success: function(){
              $('#textsend').val("");
          }
      });
  });
</script>