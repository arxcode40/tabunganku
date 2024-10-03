<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	protected $settings;
	protected $login_attempts;

	public function __construct()
	{
		parent::__construct();

		$this->settings = $this->setting_model->get();
		$this->login_attempts = $this->session->tempdata('login_attempts') ?? 0;
	}

	public function login()
	{
		if($this->session->has_userdata('auth_token'))
		{
			if($this->auth_model->user_token_exists($this->session->userdata('auth_token')))
			{
				redirect('');
			}
		}

		$login_attempts_expire = 60 * 1;
		$this->session->set_tempdata('login_attempts', $this->login_attempts, $login_attempts_expire);

		$this->form_validation->set_rules(
			'username', 'nama pengguna',
			array('max_length[16]', 'min_length[8]', 'regex_match[/^[a-z\d]+$/]', 'required', 'trim')
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

			$auth = $this->auth_model->attempt();

			if ( ! $auth)
			{
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

			if ( ! password_verify($this->input->post('password'), $auth['password']))
			{
				$this->session->set_tempdata('login_attempts', ($this->login_attempts + 1) ?? 1, $this->login_attempts_expire);
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

			unset($auth['password']);
			$auth['logged_at'] = mdate('%Y-%m-%d %H:%i:%s');
			$this->session->set_userdata('auth_token', base64_encode(json_encode($auth)));

			redirect('');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('auth_token');

		redirect('masuk');
	}
}
