<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function save()
	{
		$user = $this->session->userdata('user');
		$user_data = array(
			'username' => $user['username'],
			'password' => $user['password']
		);

		if ($this->form_validation->required($this->input->post('username')))
		{
			$user_data['username'] = $this->input->post('username');
		}

		if ($this->form_validation->required($this->input->post('current_password')))
		{
			$user_data['password'] = password_hash($this->input->post('new_password'), PASSWORD_DEFAULT);
		}

		$this->db->trans_start();
		$this->db->set($user_data);
		$this->db->where('id', $user['id']);
		$this->db->update('users');
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
			$this->session->set_flashdata(
				'alert',
				array(
					'icon' => 'x',
					'status' => 'danger',
					'text' => 'Profil gagal disimpan'
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
					'text' => 'Profil berhasil disimpan'
				)
			);

			$user['username'] = $user_data['username'];
			$user['password'] = $user_data['password'];
			
			$this->session->set_userdata('user', $user);
		}

		$this->db->reset_query();
	}
}
