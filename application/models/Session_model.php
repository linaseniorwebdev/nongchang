<?php

class Session_model extends CI_Model {

	/**
	 * Get session by phone
	 */
	function get_session($phone) {
		$this->db->order_by('id', 'desc');
		return $this->db->get_where('sessions', array('phone' => $phone))->row_array();
	}

	/**
	 * Get real session by phone
	 */
	function get_real_session($phone) {
		$this->db->order_by('id', 'desc');
		return $this->db->get_where('sessions', array('phone' => $phone, 'created_at >=' => date('Y-m-d H:i:s', strtotime('-5 minutes'))))->row_array();
	}

	/**
	 * function to add new session
	 */
	function add_session($params) {
		$this->db->insert('sessions', $params);
		return $this->db->insert_id();
	}
}
