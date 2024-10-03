<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	public function validate($user)
	{
		$this->db->where('id', $user['id']);
		$this->db->where('username', $user['username']);
		$this->db->limit(1);

		return (bool) $this->db->get('users')->num_rows();
	}

	public function attempt()
	{
		$this->db->where('username', $this->input->post('username'));
		$this->db->limit(1);

		return $this->db->get('users')->row_array();
	}
}
