<script type="text/javascript">
  var tabel = null;
  var calon = null;
    $(document).ready(function() {
        tabel = $('#tb_customer').DataTable({
            "processing": false,
            "responsive":true,
            "serverSide": true,
            "ordering": true, // Set true agar bisa di sorting
            "order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
            "ajax":
            {
                "url": "<?= base_url('datatable/get_pelanggan/'.$jenis);?>", // URL file untuk proses select datanya
                "type": "POST"
            },
            "deferRender": true,
            "aLengthMenu": [[50, 75, 100],[ 50, 75, 100]], // Combobox Limit
            "columns": [
                {"data": 'id_pelanggan',"sortable": false, 
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }  
                },
                { "data": "tanggal" },  
                { "data": "nama_marketing" }, 
                { "data": "nama_pelanggan" },
                { "data": "no_hp" },
                { "data": "kabupaten" },
                { "data": "id_pelanggan",
                "render": 
                function( data, type, row, meta ) {
                  var action = '<div class="btn-group"><button type="button" class="btn btn-info">Action</button><button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown"><span class="sr-only">Toggle Dropdown</span></button><div class="dropdown-menu" role="menu">'+
                  '<button class="dropdown-item btn-edit" data-toggle="modal" data-target="#modal-edit" data-id="'+data+'">Edit</button>'+
                  '<button class="dropdown-item" data-toggle="modal" data-target="#modal-input">Hapus</button>'+
                  '</div></div>';
                    return action;
                }
                },
            ],
        });
        calon = $('#tb_calon').DataTable({
            "processing": false,
            "responsive":true,
            "serverSide": true,
            "ordering": true, // Set true agar bisa di sorting
            "order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
            "ajax":
            {
                "url": "<?= base_url('datatable/get_calon');?>", // URL file untuk proses select datanya
                "type": "POST"
            },
            "deferRender": true,
            "aLengthMenu": [[50, 75, 100],[ 50, 75, 100]], // Combobox Limit
            "columns": [
                {"data": 'id_calon',"sortable": false, 
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }  
                },
                { "data": "tanggal" },  
                { "data": "nama_marketing" }, 
                { "data": "nama_calon" },
                { "data": "no_hp" },
                { "data": "komoditi" },
                { "data": "kabupaten" },
                { "data": "keterangan" },
                { "data": "id_calon",
                "render": 
                function( data, type, row, meta ) {
                  var action = '<div class="btn-group"><button type="button" class="btn btn-info">Action</button><button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown"><span class="sr-only">Toggle Dropdown</span></button><div class="dropdown-menu" role="menu">'+
                  '<button class="dropdown-item btn-calon" data-toggle="modal" data-target="#modal-edit" data-calon="'+data+'">Edit</button>'+
                  '<a href="<?php echo base_url()?>'+'/office/admin/del_calon/'+data+'" class="dropdown-item" onclick="return confirm("Apakah anda yakin ingin membatalkan transaksi ini?")">Hapus</a>'+
                  '</div></div>';
                    return action;
                }
                },
            ],
        });
    });
</script>
<!-- <a href="<?php echo base_url('admin/batal/'.$value->id_transaksi) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin membatalkan transaksi ini?')"><i class="fa fa-ban" aria-hidden="true"></i></a> -->