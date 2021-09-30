<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/chat/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/chat/css/sapateman.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <script type="text/javascript" src="<?php echo base_url() ?>assets/chat/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/chat/js/popper.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>assets/chat/js/bootstrap.js"></script>

    <style type="text/css">
        #balas-ketik{
            display: block;
            overflow: hidden;
            resize: none;
        }
    </style>
    <title>Gi-Chat</title>

</head>
<body>
    <div class="container-fluid p-0">
        
        <div class="row kotak">

            <div class="col-12 col-md-3 kotak-kiri d-none d-sm-none d-md-block">

                <div class="kotak-kiri-sidebar">

                    <nav class="navbar navbar-expand-lg navbar-light bg-light">

                        <div>
                            <div class="avatar-saya">
                                <?php 
                                $id_user = $this->session->userdata('id_user');
                                $this->db->select('*');
                                $this->db->from('tb_marketing');
                                $this->db->where('id_user', $this->session->userdata('id_user'));
                                $getchat= $this->db->get()->row();  ?>
                                <img src="<?php echo base_url() ?>assets/img/team/<?php echo $getchat->foto ?>">
                                <span><strong><?php echo $this->session->userdata('nama_user'); ?></strong></span>
                            </div>
                        </div>
                    </nav>

                    <div class="pencarian">
                        <div class="pencarian-inner">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                                </div>
                                <input type="text" class="form-control ketik-pencarian" placeholder="Masukkan Pencarian .." aria-label="Masukkan Pencarian .." aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>

                    <div class="teman">
                        <div class="row teman-list" id="group"> 
                            <div class="col-3 col-sm-3 col-xs-3 teman-avatar">
                                <div class="avatar-icon">
                                        <img class="avatar-icon" src="<?php echo base_url() ?>assets/img/team/group.webp">
                                </div>
                            </div>
                            <div class="col-9 col-sm-9 col-xs-9 teman-main">
                                <div class="row">
                                    <div class="col-sm-9 col-xs-8 teman-data">
                                        <span class="nama-meta font-weight-bold">Kilat Office</span>
                                        <!-- <span class="chat-meta text-muted">Sedang mengetik ..</span> -->
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

                        <?php 
                        $id_user = $this->session->userdata('id_user');
                        foreach ($member as $member) { 
                            if($member->id_user!=$id_user){
                            ?>

                        <div class="row teman-list" id="<?php echo $member->id_user; ?>"> 
                            <div class="col-3 col-sm-3 col-xs-3 teman-avatar">
                                <div class="avatar-icon">
                                        <img class="avatar-icon" src="<?php echo base_url() ?>assets/img/team/<?php echo $member->foto;?>">
                                </div>
                            </div>
                            <div class="col-9 col-sm-9 col-xs-9 teman-main">
                                <div class="row">
                                    <div class="col-sm-9 col-xs-8 teman-data">
                                        <span class="nama-meta font-weight-bold"><?php echo $member->nama_marketing ?></span>
                                        <!-- <span class="chat-meta text-muted chat-<?php echo $member->id_user; ?>">Sedang mengetik ..</span> -->
                                    </div>
                                    <div class="col-sm-3 col-xs-4 pull-right teman-time">

                                        <span class="time-meta pull-right">
                                            <!-- 12:00 -->
                                            <!-- <br> -->
                                            <div class="badge badge-danger count-user-<?php echo $member->id_user?>">1</div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }} ?>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-12 conversation">

              <nav class="navbar navbar-expand-lg navbar-light bg-light" style="min-height: 70px">
                  <div class="lawan" href="#">

                  </div>
              </nav>

              <div class="pesan" id="conversation">

              </div>

              <div class="row balas py-2 d-none">

                <div class="col-sm-1 col-2">
                </div>

                <div class="col-sm-8 col-6">
                  <textarea class="form-control" id="balas-ketik" placeholder="Ketik pesan .." style="overflow-y: auto;"></textarea>
                </div>

                <div class="col-sm-2 col-4">
                  <button class="btn btn-primary p-2 balas-kirim" id="balas-kirim"><i class="fa fa-send"></i></button>
                </div>

              </div>

      </div>
        </div>
    </div>
    <script type="text/javascript">
        textarea = document.querySelector("#balas-ketik");
        textarea.addEventListener('input', autoResize, false);
      
        function autoResize() {
            this.style.height = '130px';
            //this.style.height = this.scrollHeight + 'px';
        }
    </script>
    <?php include 'ajax.php'; ?>
</body>
</html>
