<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

	protected $settings;

	public function __construct()
	{
		parent::__construct();

		if ( ! $this->session->has_userdata('user') OR ! $this->auth_model->validate($this->session->userdata('user')))
		{
			redirect('masuk');
		}

		$this->load->model('member_model');
		$this->load->model('transaction_model');

		$this->settings = $this->setting_model->get();
	}

	public function index()
	{
		$data['settings'] = $this->settings;
		$data['title'] = 'Data Transaksi';
		$data['transactions'] = $this->transaction_model->all();

		$this->layout->view('transaction/home', $data);
	}

	public function detail($id)
	{
		if ( ! $this->member_model->exists($id))
		{
			show_404();

			return;
		}

		$member = $this->member_model->get($id);

		$data['settings'] = $this->settings;
		$data['title'] = 'Data Transaksi ' . $member['name'];
		$data['member'] = $member;
		$data['transactions'] = $this->transaction_model->detail($id);

		$this->layout->view('transaction/detail', $data);
	}

	public function create($id)
	{
		if ( ! $this->member_model->exists($id))
		{
			show_404();

			return;
		}

		$this->form_validation->set_rules(
			'date', 'tanggal transaksi',
			array('exact_length[10]', 'regex_match[/^((19|20)\d{2})-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/]', 'required', 'trim')
		);
		$this->form_validation->set_rules(
			'deposit', 'nominal pemasukan',
			array('regex_match[/^(0|([1-9][0-9]{0,2})(\.\d{3})*?)$/]', 'required', 'trim')
		);
		$this->form_validation->set_rules(
			'withdraw', 'nominal pengeluaran',
			array('regex_match[/^(0|([1-9][0-9]{0,2})(\.\d{3})*?)$/]', 'required', 'trim')
		);

		if ($this->form_validation->run() === FALSE)
		{
			$data['settings'] = $this->settings;
			$data['title'] = 'Tambah Data Transaksi';
			$data['member'] = $this->member_model->get($id);
			$data['last_id'] = $this->transaction_model->last();

			$this->layout->view('transaction/create', $data);
		}
		else
		{
			$this->transaction_model->create($id);

			redirect('transaksi/' . $id);
		}
	}

	public function update($id, $member_id)
	{
		if ( ! $this->member_model->exists($member_id) OR ! $this->transaction_model->exists($id))
		{
			show_404();

			return;
		}

		$this->form_validation->set_rules(
			'date', 'tanggal transaksi',
			array('exact_length[10]', 'regex_match[/^((19|20)\d{2})-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/]', 'required', 'trim')
		);
		$this->form_validation->set_rules(
			'deposit', 'nominal pemasukan',
			array('regex_match[/^(0|([1-9][0-9]{0,2})(\.\d{3})*?)$/]', 'required', 'trim')
		);
		$this->form_validation->set_rules(
			'withdraw', 'nominal pengeluaran',
			array('regex_match[/^(0|([1-9][0-9]{0,2})(\.\d{3})*?)$/]', 'required', 'trim')
		);

		if ($this->form_validation->run() === FALSE)
		{
			$data['settings'] = $this->settings;
			$data['title'] = 'Ubah Data Transaksi';
			$data['member'] = $this->member_model->get($member_id);
			$data['transaction'] = $this->transaction_model->get($id);

			$this->layout->view('transaction/update', $data);
		}
		else
		{
			$this->transaction_model->update($id);

			redirect('transaksi/' . $member_id);
		}
	}

	public function delete($id)
	{
		if ( ! $this->member_model->exists($id) OR ! $this->transaction_model->exists($this->input->post('id')))
		{
			show_404();

			return;
		}

		$this->transaction_model->delete();

		redirect('transaksi/' . $id);
	}

	public function report($id)
	{
		if ( ! $this->member_model->exists($id))
		{
			show_404();

			return;
		}
		
		$data['settings'] = $this->settings;
		$data['settings']['application_theme'] = 'light';
		$member = $this->member_model->get($id);
		$data['title'] = 'Laporan Data Transaksi ' . $member['name'];
		$data['transactions'] = $this->transaction_model->detail($id);

		$this->layout->view('transaction/report', $data);
	}

}