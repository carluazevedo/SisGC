<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if (!$this->session->has_userdata('identity')) {
			redirect('auth');
		}
	}

	public function index() {
		redirect('viagens');
	}
}
