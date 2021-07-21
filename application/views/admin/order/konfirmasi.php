<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#konfirmasi<?= $order->kode_transaksi?>">
  <i class="fa fa-check"></i> Konfirmasi
</button>

<!-- Modal -->
<div class="modal fade" id="konfirmasi<?php echo$order->kode_transaksi?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Order #<strong><?php echo $order->kode_transaksi ?></strong></h4>
      </div>
      <div class="modal-body">
        <?php echo form_open(base_url('admin/order/konfirmasi/'.$order->kode_transaksi)); ?>
        <form role="form">
          <div class="box-body">
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                   <label >Nama Bank</label>
                    <input type="text" name="nama_bank" placeholder="Bank BRI" class="form-control">
                </div>
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
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                   <label >Ongkos Kirim</label>
                    <div class="input-group">
                      <span class="input-group-addon prc">Rp</span>
                      <input type="number" value="<?php echo $order->ongkir ?>" name="ongkir" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                   <label >Jumlah Transfer</label>
                    <div class="input-group">
                      <span class="input-group-addon prc">Rp</span>
                      <input type="number" name="total_bayar" value="<?php echo $order->total_bayar ?>" class="form-control">
                    </div> 
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <label >Ekspedisi</label>
                    <input type="text" name="expedisi" value="<?php echo $order->expedisi ?>" placeholder="Expedisi" class="form-control">
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Transfer Ke</label>
                    <br>
                    <div class="form-group">
                      <label>
                        <input type="radio" name="id_rekening" class="flat-red" value="2" checked>
                        Bank BCA
                      </label>
                      <label>
                        <input type="radio" name="id_rekening" class="flat-red" value="1">
                        Bank Mandiri
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-12">
                   <label >No Resi</label>
                    <input type="text" name="no_resi" placeholder="No Resi" class="form-control">
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Konfirmasi</button>
          </div>
        </form>
        <?php echo form_close() ?>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>