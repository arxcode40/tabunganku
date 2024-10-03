<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	public function user_token_exists($auth_token)
	{
		$auth_token = json_decode(base64_decode($auth_token), TRUE);

		$this->db->where('id', $auth_token['id']);
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
