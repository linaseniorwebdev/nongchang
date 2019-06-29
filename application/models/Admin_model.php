<?php

class Admin_model extends CI_Model {

	/*
	* Get admin by id
	*/
	function get_admin($id) {
		return $this->db->get_where('admin', array('id' => $id))->row_array();
	}

	/*
	* Get all admins
	*/
	function get_all_admins() {
		$this->db->order_by('id', 'asc');
		return $this->db->get('admin')->result_array();
	}

	/*
	* function to add new admin
	*/
	function add_admin($params) {
		$this->db->insert('admin', $params);
		return $this->db->insert_id();
	}

	/*
	* function to update admin
	*/
	function update_admin($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('admin', $params);
	}

	/*
	* function to delete admin
	*/
	function delete_admin($id) {
		return $this->db->delete('admin', array('id'=>$id));
	}

	/*
	* function to get admin by name
	*/
	function get_by_name($name) {
		return $this->db->get_where('admin', array('username' => $name))->row_array();
	}
}
