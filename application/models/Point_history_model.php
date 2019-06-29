<?php

class Point_history_model extends CI_Model {

	/**
	 * Get point_history by id
	 */
	function get_point_history($id) {
		$this->db->order_by('id', 'asc');
		return $this->db->get_where('point_history', array('user' => $id))->row_array();
	}

	/**
	 * Get all point_history
	 */
	function get_all_point_history($user = null) {
		$this->db->order_by('id', 'asc');
		return $this->db->get('point_history')->result_array();
	}

	/**
	 * Function to add new point_history
	 */
	function add_point_history($params) {
		$this->db->insert('point_history', $params);
		return $this->db->insert_id();
	}
}
