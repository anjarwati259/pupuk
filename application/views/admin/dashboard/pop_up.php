<style>
    #textsend {
        display: block;
        overflow: hidden;
        resize: none;
    }
</style>
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
        <div class="direct-chat-messages showchat" style="height: 100%;">

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
  $(".showchat").animate({ scrollTop: $(document).height() }, "slow");
  
  var textarea = document.querySelector("#textsend");
      textarea.addEventListener('input', autoResize, false);
      
        function autoResize() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
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