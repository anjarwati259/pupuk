<a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-success" id="tot_notif"><?php echo $jml_order->total ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Notifikasi Order Baru</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php foreach ($order as $order) { ?>
                 <li>
                    <a href="#" data-toggle="modal" data-target="#notif<?= $order->kode_transaksi?>">
                      <div class="pull-left">
                        <img src="<?php echo base_url() ?>assets/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4><?php echo $order->nama_marketing ?></h4>
                      <p>Pesan Belum Dibaca</p>
                    </a>
                  </li>
                <?php } ?>
                  <!-- end message -->
                </ul>
              </li>
              <!-- <li class="footer"><a href="#">See All Messages</a></li> -->
            </ul>