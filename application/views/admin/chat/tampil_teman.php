<div class="row teman-list" id="group"> 
    <div class="col-3 col-sm-3 col-xs-3 teman-avatar">
        <div class="avatar-icon">
                <img class="avatar-icon" src="<?php echo base_url() ?>assets/chat/gambar/default/user.png">
        </div>
    </div>
    <div class="col-9 col-sm-9 col-xs-9 teman-main">
        <div class="row">
            <div class="col-sm-9 col-xs-8 teman-data">
                <span class="nama-meta font-weight-bold">Kilat Office</span>
                <span class="chat-meta text-muted">Sedang mengetik ..</span>
            </div>
            <div class="col-sm-3 col-xs-4 pull-right teman-time">

                <span class="time-meta pull-right">
                    <!-- 12:00 -->
                    <!-- <br> -->
                    <div class="badge badge-danger count-group">1</div>
                </span>
            </div>
        </div>
    </div>
</div>

<?php foreach ($member as $member) { ?>
<div class="row teman-list" id="<?php echo $member->id_user; ?>"> 
    <div class="col-3 col-sm-3 col-xs-3 teman-avatar">
        <div class="avatar-icon">
                <img class="avatar-icon" src="<?php echo base_url() ?>assets/chat/gambar/default/user.png">
        </div>
    </div>
    <div class="col-9 col-sm-9 col-xs-9 teman-main">
        <div class="row">
            <div class="col-sm-9 col-xs-8 teman-data">
                <span class="nama-meta font-weight-bold"><?php echo $member->nama_marketing ?></span>
                <span class="chat-meta text-muted">Sedang mengetik ..</span>
            </div>
            <div class="col-sm-3 col-xs-4 pull-right teman-time">

                <span class="time-meta pull-right">
                    <!-- 12:00 -->
                    <!-- <br> -->
                    <div class="badge badge-danger">1</div>
                </span>
            </div>
        </div>
    </div>
</div>
<?php } ?>