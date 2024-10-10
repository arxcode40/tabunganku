<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ( ! $this->session->has_userdata('user') OR ! $this->auth_model->validate($this->session->userdata('user')))
		{
			redirect('masuk');
		}
	}

	public function index()
	{
		$this->form_validation->set_rules(
			'application_name', 'nama aplikasi',
			array('max_length[64]', 'required', 'trim')
		);
		$this->form_validation->set_rules(
			'application_theme', 'tema aplikasi',
			array('in_list[light,dark]', 'required', 'trim')
		);

		if ($this->form_validation->run() === FALSE)
		{
			$data['settings'] = $this->setting_model->get();;
			$data['title'] = 'Pengaturan';

			$this->layout->view('setting/preference', $data);
		}
		else
		{
			$this->setting_model->set();

			redirect('pengaturan');
		}
	}
}
