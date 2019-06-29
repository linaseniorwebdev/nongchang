<?php

class Province_model extends CI_Model {

	/**
	 * Get province by id
	 */
	function get_province($id) {
		return $this->db->get_where('provinces', array('id' => $id))->row_array();
	}

	/**
	 * Get all provinces
	 */
	function get_all_provinces($filter = true) {
		$this->db->order_by('id', 'desc');
		if ($filter === true) {
			return $this->db->get_where('provinces', array('usage' => 1))->result_array();
		}
		return $this->db->get('provinces')->result_array();
	}

	/**
	 * function to add new province
	 */
	function add_province($params) {
		$this->db->insert('provinces', $params);
		return $this->db->insert_id();
	}

	/**
	 * function to update province
	 */
	function update_province($code, $name) {
		$this->db->where('code', $code);
		return $this->db->update('provinces', array('name' => $name));
	}

	/**
	 * function to delete province
	 */
	function delete_province($id) {
		return $this->db->delete('provinces', array('id' => $id));
	}
}
