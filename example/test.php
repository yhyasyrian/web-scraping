<?php
/*
	* Web Scraping With PHP
	* You Need Work By cURL & RegEx In preg_match & Arrays
*/
function merge_array(array $arrayKeys,array $arrayValues){
	if(count($arrayKeys) != count($arrayValues)){return false;}
	$array = [];
	$i = 0;
	foreach($arrayKeys as $key => $value){
		$array[$value] = $arrayValues[$i++];
	}
	return $array;
}
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; WebScraping; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4324.182 Safari/537.36');
curl_setopt($ch, CURLOPT_URL, 'https://who.is/whois/google.com');
$result = curl_exec($ch);
curl_close($ch);
$RegExKey = '#<div class="col-md-4 queryResponseBodyKey">(.*)</div>#';
$RegExValue = '#<div class="col-md-8 queryResponseBodyValue">(.*)</div>#';
preg_match_all($RegExKey,$result,$returnKey);
preg_match_all($RegExValue,$result,$returnValue);
if(isset($returnValue[1][2]) and !empty($returnValue[1][2])){
	$result = ['ok'=>true];
	unset($returnKey[1][3]);
	$result['result'] = merge_array($returnKey[1],$returnValue[1]);
	echo json_encode($result,128|256);
}else{
	$result = ['ok'=>false];
	echo json_encode($result,128|256);
}
