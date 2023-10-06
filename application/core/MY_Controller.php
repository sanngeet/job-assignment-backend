<?php

class MY_Controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Kuwait');
		header('Access-Control-Allow-Credentials: true');

		$allowed_domains = array(
			'http://localhost:4200',
			'http://ssd.loc'
		);
		if ($_SERVER && isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], $allowed_domains)) {
			header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
		} else {
			api_json_res(FALSE, 'Unauthorized', array('message' => 'Invalid'));
		}

		if (file_get_contents('php://input')) {
			$_POST = json_decode(file_get_contents('php://input'), true);
		} else if (!is_array($_POST)) {
			$_POST = (json_decode($_POST, true));
		}
	}
}

//EOF
