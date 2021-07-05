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