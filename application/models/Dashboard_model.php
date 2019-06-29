<?php

class Dashboard_model extends CI_Model {

	/**
	 * Count All Users
	 */
	public function get_users() {
		$result = array();
		$query = $this->db->query('SELECT COUNT(id) AS total FROM users;')->row_array();
		$result['total'] = $query['total'];
		$query = $this->db->query('SELECT COUNT(id) AS total FROM users WHERE created_at >= (DATE(NOW()) - INTERVAL 7 DAY);')->row_array();
		$result['7days'] = $query['total'];
		return $result;
	}

	/**
	 * Count All Products
	 */
	public function get_products() {
		$result = array();
		$query = $this->db->query('SELECT COUNT(id) AS total FROM products;')->row_array();
		$result['total'] = $query['total'];
		$query = $this->db->query('SELECT COUNT(id) AS total FROM products WHERE updated_at >= (DATE(NOW()) - INTERVAL 7 DAY);')->row_array();
		$result['7days'] = $query['total'];
		return $result;
	}

	/**
	 * Count All Lands
	 */
	public function get_lands() {
		$result = array();
		$query = $this->db->query('SELECT COUNT(id) AS total FROM lands;')->row_array();
		$result['total'] = $query['total'];
		$query = $this->db->query('SELECT COUNT(id) AS total FROM lands WHERE owner IS NOT NULL;')->row_array();
		$result['7days'] = $query['total'];
		return $result;
	}

	/**
	 * Count All Orders
	 */
	public function get_orders() {
		$result = array();
		$query = $this->db->query('SELECT COUNT(id) AS total FROM orders;')->row_array();
		$result['total'] = $query['total'];
		$query = $this->db->query('SELECT COUNT(id) AS total FROM orders WHERE created_at >= (DATE(NOW()) - INTERVAL 7 DAY);')->row_array();
		$result['7days'] = $query['total'];
		return $result;
	}

	/**
	 * Count All Tasks
	 */
	public function get_tasks() {
		$result = array();
		$query = $this->db->query('SELECT COUNT(id) AS total FROM tasks;')->row_array();
		$result['total'] = $query['total'];
		$query = $this->db->query('SELECT COUNT(id) AS total FROM tasks WHERE updated_at >= (DATE(NOW()) - INTERVAL 7 DAY);')->row_array();
		$result['7days'] = $query['total'];
		return $result;
	}

	/**
	 * Count All Incomes
	 */
	public function get_income() {
		$result = array();
		$query = $this->db->query('SELECT SUM(site) AS total FROM income WHERE 1;')->row_array();
		$result['total'] = (double)$query['total'];
		$query = $this->db->query('SELECT SUM(site) AS total FROM withdraw WHERE 1;')->row_array();
		$result['total'] += (double)$query['total'];
		$query = $this->db->query('SELECT SUM(site) AS total FROM income WHERE created_at >= (DATE(NOW()) - INTERVAL 7 DAY);;')->row_array();
		$result['7days'] = (double)$query['total'];
		$query = $this->db->query('SELECT SUM(site) AS total FROM withdraw WHERE updated_at >= (DATE(NOW()) - INTERVAL 7 DAY);')->row_array();
		$result['7days'] += (double)$query['total'];
		return $result;
	}
}
