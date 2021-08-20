
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $order->total ?></h3>

              <p>Total Order</p>
            </div>
            <div class="icon">
              <i class="fa fa-cart-arrow-down"></i>
            </div>
            <a href="<?php echo base_url('marketing/belum_bayar') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $mitra->total ?></h3>

              <p>Mitra</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?php echo base_url('admin/pelanggan/mitra') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $dist->total ?></h3>

              <p>Distributor</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
            <a href="<?php echo base_url('admin/pelanggan/distributor') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $customer->total ?></h3>

              <p>Customer</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="<?php echo base_url('admin/pelanggan/customer') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        
        <section class="col-lg-7 connectedSortable">

          <!-- solid sales graph -->
          <div class="box box-solid bg-teal-gradient">
            <div class="box-header">
              <i class="fa fa-th"></i>

              <h3 class="box-title">Grafik Penjualan</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
            </div>
            <div class="box-body border-radius-none">
              <div class="chart" id="line" style="height: 300px;"></div>
            </div>
            <!-- /.box-body -->
            <!-- <div class="box-footer no-border">
              <div class="row">
                <div class="col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">
                  <input type="text" class="knob" data-readonly="true" value="<?php echo !empty($POC) ? $POC->total : '0';?>" data-width="60" data-height="60"
                         data-fgColor="#39CCCC">

                  <div class="knob-label">POC 1 Liter</div>
                </div>
                <div class="col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">
                  <input type="text" class="knob" data-readonly="true" value="<?php echo !empty($POC500) ? $POC500->total : '0';?>" data-width="60" data-height="60"
                         data-fgColor="#39CCCC">

                  <div class="knob-label">POC 500ml</div>
                </div>
                <div class="col-xs-3 text-center">
                  <input type="text" class="knob" data-readonly="true" value="<?php echo !empty($ternak) ? $ternak->total : '0';?>" data-width="60" data-height="60"
                         data-fgColor="#39CCCC">

                  <div class="knob-label">Nutrisi Ternak</div>
                </div>
                <div class="col-xs-3 text-center">
                  <input type="text" class="knob" data-readonly="true" value="<?php echo !empty($ikan) ? $ikan->total : '0';?>" data-width="60" data-height="60"
                         data-fgColor="#39CCCC">

                  <div class="knob-label">Nutrisi Ikan</div>
                </div>
              </div>
            </div> -->
          </div>
        </section>

        <div class="col-md-4">
          <!-- /.info-box -->
          <!-- Info Boxes Style 2 -->
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-shopping-bag"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PENJUALAN HARIAN</span>
              <span class="info-box-number"><?php echo $harian->total ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-shopping-basket"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PENJUALAN MINGGUAN</span>
              <span class="info-box-number"><?php echo $mingguan->total?></span>

            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-shopping-bag"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PENJUALAN BULANAN</span>
              <span class="info-box-number"><?php echo $bulanan->total?> </span>

            </div>
            <!-- /.info-box-content -->
          </div>
        </div>

      </div>
      <!-- /.row -->

<script type="text/javascript">
  $(function () {

  'use strict';

  var line = new Morris.Line({
    element          : 'line',
    resize           : true,
    data             : <?php echo $hari ?>,
    xkey             : 'tanggal_transaksi',
    ykeys            : ['total'],
    labels           : ['Total'],
    lineColors       : ['#D3D3D3'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#efefef',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    gridTextSize     : 10
  });
});
</script>