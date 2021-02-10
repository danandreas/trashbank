<?php

function myDate($date){
	
    return !empty($date) ? \Carbon\Carbon::parse($date)->format("Y-m-d") : '';
}

function myDateTime($date){
    return \Carbon\Carbon::parse($date)->format("Y/m/d G:i");
}

function myTime($date){
    return \Carbon\Carbon::parse($date)->format("G:i");
}

function myImagePath($image_name)
{
    return public_path('folder_kamu/sub_folder_kamu/'.$image_name);
}

function mySwitchButton($status, $data_id, $class)
{
	if ($status == "1"){
		$x = 'checked="checked"';
	} else {
		$x = '';
	}
	$text =
	'<div data-id="'.$data_id.'" class="'.$class.' custom-control custom-switch custom-switch-success custom-control-inline">
            <input type="checkbox" name="" '.$x.' class="custom-control-input">
            <label class="custom-control-label"></label>
    </div>';

	return $text;
}

function myCurrency($x)
{
	$text = "Rp " . number_format($x, 0, ',', '.');
	return $text;
}

function myPaymentMethod($x)
{
    if ($x == "1") {
        $text = "Dibayar Langsung";
    } elseif ($x == "2") {
		$text = "Ditabung";
	} elseif ($x == "3") {
		$text = "Barter";
	} else {
		$text = '-';
	}
	return $text;
}

function myUnit($x)
{
    if ($x == "1") {
        $text = "Pcs";
    } elseif ($x == "2") {
		$text = "Kg";
	} else {
		$text = '-';
	}
	return $text;
}
