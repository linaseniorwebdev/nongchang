<?php

class District_model extends CI_Model {

	/**
	 * Get district by id
	 */
	function get_district($id) {
		return $this->db->get_where('districts', array('id' => $id))->row_array();
	}

	/**
	 * Get all districts
	 */
	function get_district_list($city) {
		$this->db->order_by('id', 'asc');
		return $this->db->get_where('districts',array('city' => $city))->result_array();
	}

	/**
	 * function to add new district
	 */
	function add_district($params) {
		$this->db->insert('districts', $params);
		return $this->db->insert_id();
	}

	/**
	 * function to update district
	 */
	function update_district($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('districts', $params);
	}

	/**
	 * function to delete district
	 */
	function delete_district($id) {
		return $this->db->delete('districts',array('id' => $id));
	}
}
