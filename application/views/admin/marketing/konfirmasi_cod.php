<button class="btn btn-success btn-xs" data-toggle="modal" data-target="#cod<?php echo $order->kode_transaksi?>"><i class="fa fa-check"></i> Konfirmasi</button>

<div class="modal fade" id="cod<?php echo$order->kode_transaksi?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Order #<strong><?php echo $order->kode_transaksi ?></strong></h4>
      </div>
      <div class="modal-body">
        <?php echo form_open(base_url('admin/order/cod/'.$order->kode_transaksi)); ?>
        <form role="form">
          <div class="box-body">
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                   <label >No Resi</label>
                    <input type="text" name="no_resi" placeholder="No Resi" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Tanggal Bayar</label>

                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="tanggal_bayar" class="form-control pull-right" id="datepicker" value="<?php echo date("Y-m-d") ?>">
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-md-6">
                  <!-- potongan COD -->
                  <?php 
                  $total_bayar = (int) round(($order->total_transaksi * 3)/100);
                  $total = $order->total_bayar + $total_bayar;
                   ?>
                   <label >Jumlah Transfer</label>
                    <div class="input-group">
                      <span class="input-group-addon">Rp</span>
                      <input type="text"  value="<?php echo number_format($total,'0',',','.') ?>" class="form-control">
                      <input type="hidden" name="total_bayar" value="<?php echo $total ?>" class="form-control">
                    </div>
                </div>
                
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Konfirmasi</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>