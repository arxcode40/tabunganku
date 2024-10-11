<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	protected $settings;

	public function __construct()
	{
		parent::__construct();

		$this->settings = $this->setting_model->get();
	}

	public function login()
	{
		if ($this->session->has_userdata('user'))
		{
			if ($this->auth_model->validate($this->session->userdata('user')))
			{
				redirect('');
			}
		}

		$login_attempts = $this->session->tempdata('login_attempts') ?? 0;
		$login_attempts_expire = 60 * 1;
		$this->session->set_tempdata('login_attempts', $login_attempts, $login_attempts_expire);

		$this->form_validation->set_rules(
			'username', 'nama pengguna',
			array('max_length[16]', 'min_length[8]', 'regex_match[/^[a-z\d]+$/]', 'required', 'trim')
			,
			array(
				'regex_match' => 'Bidang {field} hanya dapat berisi huruf besar dan angka.'
			)
		);
		$this->form_validation->set_rules(
			'password', 'kata sandi',
			array('max_length[16]', 'min_length[8]', 'regex_match[/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W)(?!.*\s).+$/]', 'required', 'trim'),
			array(
				'regex_match' => 'Bidang {field} harus setidaknya 1 huruf besar, 1 huruf kecil, 1 angka, dan 1 karakter spesial.'
			)
		);

		if ($this->form_validation->run() === FALSE)
		{
			$data['settings'] = $this->settings;
			$data['title'] = 'Masuk';

			$this->layout->view('auth/login', $data);
		}
		else
		{
			if ($this->session->tempdata('login_attempts') >= 2)
			{
				$this->session->set_flashdata(
					'alert',
					array(
						'icon' => 'x',
						'status' => 'danger',
						'text' => 'Terlalu banyak percobaan'
					)
				);

				redirect(uri_string());
			}

			$user = $this->auth_model->attempt();

			if ( ! $user)
			{
				$this->session->set_tempdata('login_attempts', ($login_attempts + 1) ?? 1, $this->login_attempts_expire);
				$this->session->set_flashdata(
					'alert',
					array(
						'icon' => 'x',
						'status' => 'danger',
						'text' => 'Nama pengguna tidak ditemukan'
					)
				);

				redirect(uri_string());
			}

			if ( ! password_verify($this->input->post('password'), $user['password']))
			{
				$this->session->set_tempdata('login_attempts', ($login_attempts + 1) ?? 1, $this->login_attempts_expire);
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

			$this->session->unset_tempdata('login_attempts');
			$this->session->set_userdata('user', $user);

			redirect('');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('user');

		redirect('masuk');
	}
}
