<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_Model {

	public function get() {
		$settings = $this->db->get('settings')->result_array();

		foreach ($settings as $setting)
		{
			$result[$setting['name']] = $setting['value'];
		}

		return $result;
	}

	public function set()
	{
		$setting_data = array(
			array(
				'name' => 'application_name',
				'value' => $this->input->post('application_name')
			),
			array(
				'name' => 'application_theme',
				'value' => $this->input->post('application_theme')
			)
		);

		$this->db->trans_start();
		$this->db->update_batch('settings', $setting_data, 'name');
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE)
		{
			$this->session->set_flashdata(
				'alert',
				array(
					'icon' => 'x',
					'status' => 'danger',
					'text' => 'Pengaturan gagal disimpan'
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
					'text' => 'Pengaturan berhasil disimpan'
				)
			);
		}

		$this->db->reset_query();
	}
}
