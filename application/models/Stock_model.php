<?php

class Stock_model extends CI_Model {

	/**
	 * Get stock by id
	 */
	function get_stock($user_id) {
		$result = array();
		$query = 'SELECT SUM(amount) AS sum FROM stocks WHERE user = ' . $user_id . ' GROUP BY user;';
		$data = $this->db->query($query)->row_array();
		$result['stock_total'] = $data['sum'];
		$query = 'SELECT SUM(amount) AS sum FROM stocks WHERE user = ' . $user_id . ' AND DATE(NOW()) = DATE(created_at) GROUP BY user;';
		$data = $this->db->query($query)->row_array();
		$result['stock_today'] = $data['sum'];
		$query = 'SELECT SUM(amount) AS sum FROM stocks WHERE user = ' . $user_id . ' AND DATE(created_at) = DATE(NOW() - INTERVAL 1 DAY) GROUP BY user;';
		$data = $this->db->query($query)->row_array();
		$result['stock_yesterday'] = $data['sum'];
		return $result;
	}

	/**
	 * Get all stocks
	 */
	function get_all_stocks() {
		$this->db->order_by('id', 'desc');
		return $this->db->get('stocks')->result_array();
	}

	/**
	 * function to add new stock
	 */
	function add_stock($params) {
		$this->db->insert('stocks', $params);
		return $this->db->insert_id();
	}

	/**
	 * function to update stock
	 */
	function update_stock($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('stocks', $params);
	}

	/**
	 * function to delete stock
	 */
	function delete_stock($id) {
		return $this->db->delete('stocks', array('id' => $id));
	}
}
