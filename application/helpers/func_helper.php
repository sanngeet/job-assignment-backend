<?php

function api_json_res($success = FALSE, $results = array(), $isnext = '', $count = '')
{
	$results = $results ? $results : array();
	$res = array('results' => $results);

	if ($isnext) {
		$res['isnext'] = (bool)$isnext;
	}
	if ($count !== '') {
		$res['total_records'] = $count;
	}
	header('Content-Type: application/json');
	echo json_encode(array('success' => $success, 'response' => $res));
	die;
}

function currentDT(){
	return Date('Y-m-d H:i:s');
}

function trim_array($arr)
{
	if (!$arr) {
		return $arr;
	}
	foreach ($arr as &$v) {
		if (!is_array($v)) {
			$v = trim($v);
		}
	}

	return $arr;
}

?>
