<?php

class System_model extends CI_Model {

	/**
	 * Get system variable by key
	 */
	public function get_system_variable($key) {
		return $this->db->get_where('system', array('key' => $key))->row_array();
	}

	/**
	 * Get all system variables
	 */
	public function get_all_system_variables() {
		$data = $this->db->get('system')->result_array();
		$result = array();
		foreach ($data as $row) {
			$result[$row['key']] = $row['value'];
		}
		return $result;
	}

	/**
	 * Update system variable
	 */
	public function update_system_variable($key, $value) {
		$this->db->where('key', $key);
		return $this->db->update('system',array('value' => $value));
	}
}
