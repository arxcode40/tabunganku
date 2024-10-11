<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	protected $settings;

	public function __construct()
	{
		parent::__construct();

		if ( ! $this->session->has_userdata('user') OR ! $this->auth_model->validate($this->session->userdata('user')))
		{
			redirect('masuk');
		}

		$this->settings = $this->setting_model->get();
	}

	public function index()
	{
		$data['settings'] = $this->settings;
		$data['title'] = 'Dasbor';
		$data['total_members'] = $this->db->count_all('members');
		$data['total_transactions'] = $this->db->count_all('transactions');

		$this->layout->view('dashboard/home', $data);
	}
}
