<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-<?php echo $order->kode_transaksi?>">
    <span><i class="fas fa-times"></i></span>
</button>

<!-- Modal -->
<div class="modal fade" id="delete-<?php echo $order->kode_transaksi ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-center">Pesanan Diterima</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        Apakah Anda Yakin Akan Membatalkan Order Ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <a href="<?php echo base_url('mitra/batal/'.$order->kode_transaksi) ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i> Ya, Saya Yakin</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>