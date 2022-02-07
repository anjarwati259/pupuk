<section class="content">
  <div class="container">
  	<div class="card card-outline card-primary">
      <div class="card-header">
        <!-- <h3 class="card-title">Data Pegawai</h3> -->

        <div class="">
          <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-input">
            Tambah
          </button>
        </div>
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body pt-1">
      	<div class="scrollmenu">
	        <table class="table" id="example2">
	          <thead>
	            <tr>
	              <th style="max-width: 20px;">No</th>
	              <th>Tanggal</th>
	              <th>Marketing</th>
	              <th style="max-width: 10px;">Nama</th>
	              <th>No. HP</th>
	              <th style="max-width: 50px;">Kabupaten</th>
	              <th>Action</th>
	            </tr>
	          </thead>
	          <tbody>
	          	<?php $no = 1;foreach ($pelanggan as $key => $value) { ?>
	        	<tr>
	        		<td><?php echo $no++; ?></td>
	        		<td><?php echo tanggal(date('Y-m-d',strtotime($value->tanggal_daftar))); ?></td>
	        		<td><?php echo $value->nama_marketing ?></td>
	        		<td style="max-width: 100px;" ><?php echo $value->nama_pelanggan ?></td>
	        		<td><?php echo $value->no_hp ?></td>
	        		<td style="max-width: 100px;"><?php echo $value->kabupaten ?></td>
	        		<td>
                      <div class="btn-group">
	                    <button type="button" class="btn btn-info">Action</button>
	                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
	                      <span class="sr-only">Toggle Dropdown</span>
	                    </button>
	                    <div class="dropdown-menu" role="menu">
	                      <button class="dropdown-item" data-toggle="modal" data-target="#modal-input">Edit</button>
	                      <button class="dropdown-item" data-toggle="modal" data-target="#modal-input">Hapus</button>
	                    </div>
	                  </div>
                    </td>
	        	</tr>
	        <?php } ?>
	          </tbody>
	        </table>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</section>

<!-- modal input pelanggan -->
<div class="modal fade" id="modal-input">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
	    <div class="modal-header">
	      <h4 class="modal-title">Tambah <?php echo $jenis ?></h4>
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	      </button>
	    </div>
	    <div class="modal-body">
	      <div class="row">
	      	<div class="col-md-5">
	      		<div class="form-group">
                    <label class="control-label" for="id_customer">ID</label>
                    <input type="text" id="id_pelanggan" value="<?php echo $id_pelanggan ?>" class="form-control" disabled/>
                </div>
                <div class="form-group">
                    <label class="control-label" for="id_customer">Nama Pelanggan</label>
                    <input type="text" id="nama_pelanggan" class="form-control"/>
                </div>
                <div class="form-group">
                    <label class="control-label" for="id_customer">No. HP</label>
                    <input type="text" id="no_hp" class="form-control"/>
                </div>
                <div class="form-group">
                    <label class="control-label" for="no_hp">Status</label>
                    <select class="form-control" id="status">
                      <option value="0">Organik</option>
                      <option value="1">Adsense</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label" for="id_customer">Marketing</label>
                    <select class="form-control" id="id_marketing">
                        <?php foreach ($marketing as $market) { ?>
                        <option value="<?php echo $market->id_marketing ?>"> <?php echo $market->nama_marketing ?></option>
                      <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label" for="jenis_pelanggan">Jenis Pelanggan</label>
                    <select class="form-control" id="jenis_pelanggan">
                      <option value="Customer">Customer</option>
                      <option value="Mitra">Mitra</option>
                      <option value="Distributor">Distributor</option>
                    </select>
                </div>
	      	</div>
	      	<div class="col-md-1"></div>
	      	<div class="col-md-5">
	      		<div class="form-group">
                    <label class="control-label">Tanggal Daftar</label>
                    <input type="text" class="form-control" id="tanggal_daftar" value="<?php echo date("Y-m-d");?>" disabled>
                </div>
                <div class="form-group">
                    <label class="control-label" for="alamat">Alamat</label>
                    <textarea style="min-height: 120px;" id="alamat" placeholder="Alamat" class="form-control"/></textarea>
                </div>
                <div class="form-group">
                    <label class="control-label">Provinsi</label>
                    <select class="form-control" id="form_prov" name="provinsi">
                        <?php foreach ($provinsi as $provinsi) { ?>
                        <option value="<?php echo $provinsi->kode ?>"><?php echo $provinsi->nama ?></option>
                      <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Kabupaten/Kota</label>
                    <select class="form-control" id="form_kab" name="kabupaten">
                        <option></option>
                    </select>
                </div>
                  <div class="form-group">
                    <label class="control-label">Kecamatan</label>
                    <select class="form-control" id="form_kec" name="kecamatan">
                        <option></option>
                    </select>
                </div>
	      	</div>
	      </div>
	    </div>
	    <div class="modal-footer justify-content-center">
	      <button type="button" class="btn btn-primary" id="input-pelanggan">Simpan</button>
	    </div>
	  </div>
	  <!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->