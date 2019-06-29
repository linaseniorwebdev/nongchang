<?php

class Delivery_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	/*
	* Get delivery by id
	*/
	function get_delivery($id) {
		return $this->db->get_where('deliveries',array('id'=>$id))->row_array();
	}

	/*
	* Get all deliveries
	*/
	function get_all_deliveries() {
		$this->db->order_by('id', 'desc');
		return $this->db->get('deliveries')->result_array();
	}

	/*
	* function to add new delivery
	*/
	function add_delivery($params) {
		$this->db->insert('deliveries',$params);
		return $this->db->insert_id();
	}

	/*
	* function to update delivery
	*/
	function update_delivery($id,$params) {
		$this->db->where('id',$id);
		return $this->db->update('deliveries',$params);
	}

	/*
	* function to delete delivery
	*/
	function delete_delivery($id) {
		return $this->db->delete('deliveries',array('id'=>$id));
	}
}
