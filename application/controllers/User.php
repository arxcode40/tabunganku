<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	private $settings;

	public function __construct()
	{
		parent::__construct();

		if ( ! $this->session->has_userdata('user') OR ! $this->auth_model->validate($this->session->userdata('user')))
		{
			redirect('masuk');
		}

		$this->load->model('user_model');

		$this->settings = $this->setting_model->get();
	}

	public function index()
	{
		$data['profile'] = $this->session->userdata('user');

		if ($this->input->post('username') !== $data['profile']['username'])
		{
			$rules['username'] = array('is_unique[users.username]', 'max_length[16]', 'min_length[8]', 'regex_match[/^[a-z\d]+$/]', 'required', 'trim');
		}
		else
		{
			$rules['username'] = array('max_length[16]', 'min_length[8]', 'regex_match[/^[a-z\d]+$/]', 'required', 'trim');
		}

		$this->form_validation->set_rules('username', 'nama pengguna', $rules['username']);

		if ($this->form_validation->required($this->input->post('current_password')))
		{
			$this->form_validation->set_rules(
				'current_password', 'kata sandi saat ini',
				array('max_length[16]', 'min_length[8]', 'regex_match[/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W)(?!.*\s).+$/]', 'trim'),
				array(
					'regex_match' => 'Bidang {field} harus setidaknya 1 huruf besar, 1 huruf kecil, 1 angka, dan 1 karakter spesial.'
				)
			);
			$this->form_validation->set_rules(
				'new_password', 'kata sandi baru',
				array('differs[current_password]', 'max_length[16]', 'min_length[8]', 'regex_match[/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W)(?!.*\s).+$/]', 'required', 'trim'),
				array(
					'regex_match' => 'Bidang {field} harus setidaknya 1 huruf besar, 1 huruf kecil, 1 angka, dan 1 karakter spesial.'
				)
			);
			$this->form_validation->set_rules(
				'confirm_password', 'konfirmasi kata sandi baru',
				array('differs[current_password]', 'matches[new_password]', 'required', 'trim')
			);
		}

		if ($this->form_validation->run() === FALSE)
		{
			$data['settings'] = $this->settings;
			$data['title'] = 'Profil Saya';

			$this->layout->view('user/profile', $data);
		}
		else
		{
			if ($this->form_validation->required($this->input->post('current_password')))
			{
				if ( ! password_verify($this->input->post('current_password'), $data['profile']['password']))
				{
					$this->session->set_flashdata(
						'alert',
						array(
							'icon' => 'x',
							'status' => 'danger',
							'text' => 'Kata sandi pengguna salah'
						)
					);

					redirect(uri_string());
				}
			}

			$this->user_model->save();

			redirect(uri_string());
		}
	}
}
