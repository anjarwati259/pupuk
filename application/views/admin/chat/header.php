
<html>
    <head>
        <title>Whatsapp</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/chat/style.css"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script>
            function abrirChat(){
                window.location.href="chat.html";
            }
        </script>
    </head>
    <body>
        <div class="container-fluit">
            <div class="row">
                <div class="col-3">
    
                    <div class="row wa-navbar">
                        <div class="col-8">
                            <img src="<?php echo base_url() ?>assets/chat/images/profile.png" class="rounded-circle"/>
                            <label>Ardhino</label>
                        </div>
                    </div>
                    
                    <?php foreach ($member as $member) {?>
                    <div class="row wa-item-chat" onClick="abrirChat()">
                        <div class="col-2">
                            <img src="<?php echo base_url() ?>assets/chat/images/profile.png" class="rounded-circle"/>
                        </div>
                        <div class="col-8">
                            <b>Melina</b><br/>
                            <p class="wa-preview-message">sudah Bisa?</p>
                        </div>
                        <div class="col-2" style="text-align: right; top: 20px;">
                            <span></span>
                            <span class="badge badge-pill wa-badge">54</span>
                        </div>
                    </div>
                    <hr/>
                    <?php } ?>
                </div>