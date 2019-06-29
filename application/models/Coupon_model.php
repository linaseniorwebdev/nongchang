<?php

class Coupon_model extends CI_Model {

	/**
	 * Get coupon by id
	 * @param $id
	 * @return array
	 */
	public function get_coupon($id) {
		return $this->db->get_where('coupons', array('id' => $id))->row_array();
	}

	/**
	 * Get all coupons
	 */
	public function get_all_coupons() {
		$this->db->order_by('id', 'asc');
		return $this->db->get('coupons')->result_array();
	}

	/**
	 * Function to add new coupon
	 * @param $params
	 * @return int
	 */
	public function add_coupon($params) {
		$this->db->insert('coupons', $params);
		return $this->db->insert_id();
	}

	/**
	 * Function to update coupon
	 * @param $id
	 * @param $params
	 * @return bool
	 */
	public function update_coupon($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('coupons', $params);
	}

	/**
	 * Function to delete coupon
	 * @param $id
	 * @return mixed
	 */
	public function delete_coupon($id) {
		return $this->db->delete('coupons', array('id' => $id));
	}
}
