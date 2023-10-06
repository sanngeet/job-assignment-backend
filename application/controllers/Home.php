<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->home->steps();
	}

	public function add_step()
	{
		$this->home->add_step();
	}

	public function update_step()
	{
		$this->home->update_step();
	}

	public function delete_step($id)
	{
		$this->home->delete_step($id);
	}

	public function add_item()
	{
		$this->home->add_item();
	}

	public function update_item()
	{
		$this->home->update_item();
	}

	public function delete_item($id)
	{
		$this->home->delete_item($id);
	}
}
