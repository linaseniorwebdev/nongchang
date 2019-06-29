<?php

class Point_model extends CI_Model {

	/**
	 * Get point by user id
	 * @param $user_id
	 * @return array
	 */
	public function get_point($user_id) {
		$this->db->order_by('id', 'asc');
		return $this->db->get_where('points', array('user' => $user_id))->row_array();
	}

	/**
	 * Function to add new point
	 * @param $params
	 * @return int
	 */
	public function add_point($params) {
		$this->db->insert('points', $params);
		return $this->db->insert_id();
	}

	/**
	 * Function to update point
	 * @param $id
	 * @param $params
	 * @return bool
	 */
	public function update_point($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('points', $params);
	}
}
