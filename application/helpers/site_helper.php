<?php 
function generate_code($suffix,$id){
    // $addcode = (int)filter_var($num, FILTER_SANITIZE_NUMBER_INT) + 1;
    // $numcode = str_pad($addcode,$length,STR_PAD_LEFT);
    // return $prefix.$numcode;
    $kode = (int) $id;
    $kode = $kode + 1;
    $id = $suffix .str_pad($kode, 3, "0",  STR_PAD_LEFT);
    $check_id = check_pelanggan($id);
    if($check_id){
        $kode = $kode + 1;
    }
    $hasil = $suffix .str_pad($kode, 3, "0",  STR_PAD_LEFT);
    return $hasil;
}
function check_pelanggan($id){
    $CI = get_instance();
    $CI->load->model('admin_model');
    $id_check = $CI->admin_model->check_id($id);
    return $id_check;
}
function rupiah($angka){
    if ($angka==''||$angka==null||$angka=='-') {
       $rupiah = 0;
   }else{
    $rupiah=number_format($angka,0,',','.');
}
return "Rp ".$rupiah;
}
function generate_invoice($prefix,$num,$length = 3){
    $add_code = (int)filter_var($num, FILTER_SANITIZE_NUMBER_INT) + 1;
    $num_code = str_pad($add_code,$length,"0",STR_PAD_LEFT);
    return $prefix.$num_code;
}
function getRomawi($bln){
    switch ($bln){
    case 1: 
        return "I";
    break;
    case 2:
        return "II";
    break;
    case 3:
        return "III";
    break;
    case 4:
        return "IV";
    break;
    case 5:
        return "V";
    break;
    case 6:
        return "VI";
    break;
    case 7:
        return "VII";
    break;
    case 8:
        return "VIII";
    break;
    case 9:
        return "IX";
    break;
    case 10:
        return "X";
    break;
    case 11:
        return "XI";
    break;
    case 12:
        return "XII";
    break;
    }
}
function getBulan($bln){
    switch ($bln){
    case 1: 
        return "Jan";
    break;
    case 2:
        return "Feb";
    break;
    case 3:
        return "maret";
    break;
    case 4:
        return "April";
    break;
    case 5:
        return "Mei";
    break;
    case 6:
        return "Juni";
    break;
    case 7:
        return "Juli";
    break;
    case 8:
        return "Agus";
    break;
    case 9:
        return "Sept";
    break;
    case 10:
        return "Okt";
    break;
    case 11:
        return "Nov";
    break;
    case 12:
        return "Des";
    break;
    }
}

function generate_SO($id,$tgl){
    $tgl_2=strtotime($tgl);
    $tanggal = date('d',$tgl_2);
    $suffix = '-SO-AGI-';
    $bulan = date('m',$tgl_2);
    $tahun = date('Y',$tgl_2);
    $romawi = getRomawi($bulan);
    $kode = (int) $id;
    $kode = $kode + 1;
    $hasil = $tanggal . $suffix . $romawi . '-' . $tahun . '-' . str_pad($kode, 3, "0",  STR_PAD_LEFT);
    $check = check_so($hasil);
    if($check){
        $length = 3;    
        $randid = substr(str_shuffle('0123456789'),1,$length);
         $kode = $randid;  
    }

    $so = $tanggal . $suffix . $romawi . '-' . $tahun . '-' . str_pad($kode, 3, "0",  STR_PAD_LEFT);
    return $so;
}
function check_so($kode){
    $CI = get_instance();
    $CI->load->model('order_model');
    $so_check = $CI->order_model->check_so($kode);
    return($so_check);
}
function generate_else(){
    $tanggal = date('d') ;
    $suffix = '-SO-AGI-';
    $bulan = date('m');
    $tahun = date('Y');
    $romawi = getRomawi($bulan);
    return $tanggal . $suffix . $romawi . '-' . $tahun . '-001';
}
function tanggal($tanggal, $cetak_hari = false){
  $hari = array ( 1 =>    'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu'
      );
      
  $bulan = array (1 =>   'Jan',
        'Feb',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agus',
        'Sept',
        'Okt',
        'Nov',
        'Des'
      );
  $split    = explode('-', $tanggal);
  $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
  
  if ($cetak_hari) {
    $num = date('N', strtotime($tanggal));
    return $hari[$num] . ', ' . $tgl_indo;
  }
  return $tgl_indo;
}

function count_order($data){
    $CI = get_instance();
    $CI->load->model('marketing_model');
    //$order = $data['id'];
    if($data['status']==0){
        $getorder = $CI->marketing_model->count_order($data);
    }else if($data['status']==1){
        $getorder = $CI->marketing_model->order_tgl($data);
    }else if($data['status']==2){
        $getorder = $CI->marketing_model->order_bln($data);
    }else if($data['status']==3){
        $getorder = $CI->marketing_model->order_thn($data);
    }
    $order = $getorder->total;
    return $order;
}
function organik($data){
    $CI = get_instance();
    $CI->load->model('marketing_model');
    if($data['status']==0){
        $getorder = $CI->marketing_model->count_organik($data);
    }else if($data['status']==1){
        $getorder = $CI->marketing_model->organik_tgl($data);
    }else if($data['status']==2){
        $getorder = $CI->marketing_model->organik_bln($data);
    }else if($data['status']==3){
        $getorder = $CI->marketing_model->organik_thn($data);
    }
    $order = $getorder->total;
    return $order;
}
function adsense($data){
    $CI = get_instance();
    $CI->load->model('marketing_model');
    if($data['status']==0){
        $getorder = $CI->marketing_model->count_ads($data);
    }else if($data['status']==1){
        $getorder = $CI->marketing_model->ads_tgl($data);
    }else if($data['status']==2){
        $getorder = $CI->marketing_model->ads_bln($data);
    }else if($data['status']==3){
        $getorder = $CI->marketing_model->ads_thn($data);
    }
    $order = $getorder->total;
    return $order;
}
function tot_order($data){
    $CI = get_instance();
    $CI->load->model('marketing_model');
    if($data['status']==0){
        $getorder = $CI->marketing_model->total_order($data['status']);
    }
    $order = $getorder->total;
    return $order;
}
function tot_organik($data){
    $CI = get_instance();
    $CI->load->model('marketing_model');
    if($data['status']==0){
        $getorder = $CI->marketing_model->total_organik($data['status']);
    }
    $order = $getorder->total;
    return $order;
}
function tot_ads($data){
    $CI = get_instance();
    $CI->load->model('marketing_model');
    if($data['status']==0){
        $getorder = $CI->marketing_model->total_ads($data['status']);
    }
    $order = $getorder->total;
    return $order;
}