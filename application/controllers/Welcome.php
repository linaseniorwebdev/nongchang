<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()	{
		$this->load->model('Land_model');
		$data = $this->Land_model->get_land();
		var_dump($data);
	}
}
