<?php 
function generate_code($prefix,$num,$length = 6){
	$addcode = (int)filter_var($num, FILTER_SANITIZE_NUMBER_INT) + 1;
	$numcode = str_pad($addcode,$length,STR_PAD_LEFT);
	return $prefix.$numcode;
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

function generate_SO(){
	$tanggal = date('d') ;
	$suffix = '/SO/AGI/';
	$bulan = date('m');
	$tahun = date('Y');
	$romawi = getRomawi($bulan);
	return $tanggal . $suffix . $romawi . '/' . $tahun;
}