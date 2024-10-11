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

	public function create()
	{
		$this->form_validation->set_rules(
			'name', 'nama anggota',
			array('max_length[64]', 'required', 'trim')
		);
		$this->form_validation->set_rules(
			'gender', 'jenis kelamin anggota',
			array('in_list[Laki-laki,Perempuan]', 'required', 'trim')
		);
		$this->form_validation->set_rules(
			'email', 'email anggota',
			array('max_length[320]', 'required', 'trim', 'valid_email')
		);
		$this->form_validation->set_rules(
			'tel', 'nomor telepon anggota',
			array('max_length[16]', 'numeric', 'regex_match[/^(08\d{2})(\d{4})(\d{1,})$/]', 'required', 'trim')
		);
		$this->form_validation->set_rules(
			'address', 'alamat anggota',
			array('trim')
		);

		if ($this->form_validation->run() === FALSE)
		{
			$data['settings'] = $this->settings;
			$data['title'] = 'Tambah Data Anggota';
			$data['last_id'] = $this->member_model->last();

			$this->layout->view('member/create', $data);
		}
		else
		{
			$this->member_model->create();

			redirect('anggota');
		}
	}

	public function update($id)
	{
		if ( ! $this->member_model->exists($id))
		{
			show_404();

			return;
		}

		$this->form_validation->set_rules(
			'name', 'nama anggota',
			array('max_length[64]', 'required', 'trim')
		);
		$this->form_validation->set_rules(
			'gender', 'jenis kelamin anggota',
			array('in_list[Laki-laki,Perempuan]', 'required', 'trim')
		);
		$this->form_validation->set_rules(
			'email', 'email anggota',
			array('max_length[320]', 'required', 'trim', 'valid_email')
		);
		$this->form_validation->set_rules(
			'tel', 'nomor telepon anggota',
			array('max_length[16]', 'numeric', 'regex_match[/^(08\d{2})(\d{4})(\d{1,})$/]', 'required', 'trim')
		);
		$this->form_validation->set_rules(
			'address', 'alamat anggota',
			array('trim')
		);

		if ($this->form_validation->run() === FALSE)
		{
			$data['settings'] = $this->settings;
			$data['title'] = 'Ubah Data Anggota';
			$data['member'] = $this->member_model->get($id);

			$this->layout->view('member/update', $data);
		}
		else
		{
			$this->member_model->update($id);

			redirect('anggota');
		}
	}

	public function delete()
	{
		if ( ! $this->member_model->exists($this->input->post('id')))
		{
			show_404();

			return;
		}

		$this->member_model->delete();

		redirect('anggota');
	}

	public function report()
	{
		$data['settings'] = $this->settings;
		$data['settings']['application_theme'] = 'light';
		$data['title'] = 'Laporan Data Anggota';
		$data['print'] = TRUE;
		$data['members'] = $this->member_model->all();

		$this->layout->view('member/report', $data);
	}
}
