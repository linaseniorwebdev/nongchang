<?php

class City_model extends CI_Model {

	/**
	 * Get city by id
	 */
	function get_city($id) {
		return $this->db->get_where('cities', array('id' => $id))->row_array();
	}

	/**
	 * Get all cities
	 */
	function get_city_list($province) {
		$this->db->order_by('id', 'asc');
		return $this->db->get_where('cities', array('province' => $province))->result_array();
	}

	/**
	 * function to add new city
	 */
	function add_city($params) {
		$this->db->insert('cities', $params);
		return $this->db->insert_id();
	}

	/**
	 * function to update city
	 */
	function update_city($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('cities', $params);
	}

	/**
	 * function to delete city
	 */
	function delete_city($id) {
		return $this->db->delete('cities', array('id' => $id));
	}
}
