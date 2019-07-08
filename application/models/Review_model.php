<?php

class Review_model extends CI_Model {

	/**
	 * Get review by id
	 * @param $id
	 * @return array
	 */
	public function get_review($id) {
		return $this->db->get_where('reviews', array('id' => $id))->row_array();
	}
 	/**
	 * Get all reviews
	 */
 	public function get_order_review($order_id) {
		return $this->db->get_where('reviews', array('order' => $order_id))->row_array();
	}
	/**
	 * Get all reviews
	 */
	public function get_all_reviews() {
		$this->db->order_by('id', 'desc');
		return $this->db->get('reviews')->result_array();
	}

	/**
	 * Function to add new review
	 * @param $params
	 * @return int
	 */
	public function add_review($params) {
		$this->db->insert('reviews', $params);
		return $this->db->insert_id();
	}

	/**
	 * Function to update review
	 * @param $id
	 * @param $params
	 * @return bool
	 */
	public function update_review($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('reviews', $params);
	}

	/**
	 * Function to delete review
	 * @param $id
	 * @return mixed
	 */
	public function delete_review($id) {
		return $this->db->delete('reviews', array('id' => $id));
	}
}
