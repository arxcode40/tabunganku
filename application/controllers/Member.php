<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	protected $settings;

	public function __construct()
	{
		parent::__construct();

		if ( ! $this->session->has_userdata('user') OR ! $this->auth_model->validate($this->session->userdata('user')))
		{
			redirect('masuk');
		}

		$this->load->model('member_model');

		$this->settings = $this->setting_model->get();
	}

	public function index()
	{
		$data['settings'] = $this->settings;
		$data['title'] = 'Data Anggota';
		$data['members'] = $this->member_model->all();

		$this->layout->view('member/home', $data);
	}
}
