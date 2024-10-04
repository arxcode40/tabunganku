<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends CI_Model {

	public function last()
	{
		$result = $this->db->get('transactions')->last_row('array');

		if ($result === NULL)
		{
			return 'T0000001';
		}
		else
		{
			$last_id = intval(substr($result['id'] ?? 'T0000000', 1));

			return 'T' . str_repeat(0, 7 - strlen($last_id)) . ++$last_id;
		}
	}

	public function exists($id)
	{
		$this->db->where('id', $id);
		$this->db->limit(1);

		return (bool) $this->db->get('transactions')->num_rows();
	}

	public function all()
	{
		$this->db->select('members.id, members.name, SUM(transactions.deposit) AS deposit, SUM(transactions.withdraw) AS withdraw, SUM(transactions.deposit) - SUM(transactions.withdraw) AS total');
		$this->db->join('members', 'members.id = transactions.member_id', 'inner');
		$this->db->group_by(array('members.id', 'members.name'));

		return $this->db->get('transactions')->result_array();
	}

	public function get($id)
	{
		$this->db->where('id', $id);
		$this->db->limit(1);

		return $this->db->get('transactions')->row_array();
	}

	public function create()
	{
		$transaction_data = array(
			'id' => $this->last(),
			'name' => $this->input->post('name'),
			'gender' => $this->input->post('gender'),
			'email' => $this->input->post('email'),
			'tel' => $this->input->post('tel'),
			'address' => $this->input->post('address'),
			'created_at' => mdate('%Y-%m-%d %H:%i:%s'),
			'updated_at' => mdate('%Y-%m-%d %H:%i:%s'),
		);

		$this->db->trans_start();
		$this->db->set($transaction_data);
		$this->db->insert('transactions');
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
			$this->session->set_flashdata(
				'alert',
				array(
					'icon' => 'x',
					'status' => 'danger',
					'text' => 'Data transaksi gagal ditambahkan'
				)
			);
		}
		else
		{
			$this->session->set_flashdata(
				'alert',
				array(
					'icon' => 'check',
					'status' => 'success',
					'text' => 'Data transaksi berhasil ditambahkan'
				)
			);
		}
	}

	public function update($id)
	{
		$transaction_data = array(
			'name' => $this->input->post('name'),
			'gender' => $this->input->post('gender'),
			'email' => $this->input->post('email'),
			'tel' => $this->input->post('tel'),
			'address' => $this->input->post('address'),
			'updated_at' => mdate('%Y-%m-%d %H:%i:%s'),
		);

		$this->db->trans_start();
		$this->db->set($transaction_data);
		$this->db->where('id', $id);
		$this->db->update('transactions');
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
			$this->session->set_flashdata(
				'alert',
				array(
					'icon' => 'x',
					'status' => 'danger',
					'text' => 'Data transaksi gagal diubah'
				)
			);
		}
		else
		{
			$this->session->set_flashdata(
				'alert',
				array(
					'icon' => 'check',
					'status' => 'success',
					'text' => 'Data transaksi berhasil diubah'
				)
			);
		}

		$this->db->reset_query();
	}

	public function delete()
	{
		$this->db->trans_start();
		$this->db->where('id', $this->input->post('id'));
		$this->db->delete('transactions');
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
			$this->session->set_flashdata(
				'alert',
				array(
					'icon' => 'x',
					'status' => 'danger',
					'text' => 'Data transaksi gagal dihapus'
				)
			);
		}
		else
		{
			$this->session->set_flashdata(
				'alert',
				array(
					'icon' => 'check',
					'status' => 'success',
					'text' => 'Data transaksi berhasil dihapus'
				)
			);
		}

		$this->db->reset_query();
	}
}
