<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends CI_Model {

	public function last()
	{
		$result = $this->db->get('members')->last_row('array');

		if ($result === NULL)
		{
			return 'M0000001';
		}
		else
		{
			$last_id = (int) substr($result['id'], 1);

			return 'M' . str_repeat(0, 7 - strlen($last_id)) . ++$last_id;
		}
	}

	public function exists($id)
	{
		$this->db->where('id', $id);
		$this->db->limit(1);

		return (bool) $this->db->get('members')->num_rows();
	}

	public function all()
	{
		return $this->db->get('members')->result_array();
	}

	public function get($id)
	{
		$this->db->where('id', $id);
		$this->db->limit(1);

		return $this->db->get('members')->row_array();
	}

	public function create()
	{
		$member_data = array(
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
		$this->db->set($member_data);
		$this->db->insert('members');
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
			$this->session->set_flashdata(
				'alert',
				array(
					'icon' => 'x',
					'status' => 'danger',
					'text' => 'Data anggota gagal ditambahkan'
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
					'text' => 'Data anggota berhasil ditambahkan'
				)
			);

			$this->session->set_flashdata('affected_rows', $member_data['id']);
		}
	}

	public function update($id)
	{
		$member_data = array(
			'name' => $this->input->post('name'),
			'gender' => $this->input->post('gender'),
			'email' => $this->input->post('email'),
			'tel' => $this->input->post('tel'),
			'address' => $this->input->post('address'),
			'updated_at' => mdate('%Y-%m-%d %H:%i:%s'),
		);

		$this->db->trans_start();
		$this->db->set($member_data);
		$this->db->where('id', $id);
		$this->db->update('members');
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
			$this->session->set_flashdata(
				'alert',
				array(
					'icon' => 'x',
					'status' => 'danger',
					'text' => 'Data anggota gagal diubah'
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
					'text' => 'Data anggota berhasil diubah'
				)
			);

			$this->session->set_flashdata('affected_rows', $id);
		}

		$this->db->reset_query();
	}

	public function delete()
	{
		$this->db->trans_start();
		$this->db->where('id', $this->input->post('id'));
		$this->db->delete('members');
		$this->db->reset_query();
		$this->db->where('member_id', $this->input->post('id'));
		$this->db->delete('transactions');
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
			$this->session->set_flashdata(
				'alert',
				array(
					'icon' => 'x',
					'status' => 'danger',
					'text' => 'Data anggota gagal dihapus'
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
					'text' => 'Data anggota berhasil dihapus'
				)
			);
		}

		$this->db->reset_query();
	}
}
