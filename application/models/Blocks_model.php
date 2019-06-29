<?php

class Blocks_model extends CI_Model {

	/**
	 * Get blocks
	 */
	function list_blocks($province = null, $city = null, $district = null) {
		$cond = array();
		if ($province) $cond['blocks.province'] = $province;
		if ($city) $cond['blocks.city'] = $city;
		if ($district) $cond['blocks.district'] = $district;
		$this->db->select('blocks.id, blocks.name, blocks.description, blocks.picture, provinces.name AS province, cities.name AS city, districts.name AS district');
		$this->db->from('blocks');
		$this->db->where($cond);
		$this->db->join('provinces', 'blocks.province = provinces.id');
		$this->db->join('cities', 'blocks.city = cities.id', 'left');
		$this->db->join('districts', 'blocks.district = districts.id', 'left');
		return $this->db->get()->result_array();
	}

	/**
	 * Get block by id
	 */
	function get_block($id) {
		return $this->db->get_where('blocks', array('id' => $id))->row_array();
	}

	/**
	 * Get all blocks
	 */
	function get_all_blocks() {
		$this->db->order_by('id', 'desc');
		return $this->db->get('blocks')->result_array();
	}

	/**
	 * function to add new block
	 */
	function add_block($params) {
		$this->db->insert('blocks', $params);
		return $this->db->insert_id();
	}

	/**
	 * function to update block
	 */
	function update_block($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('blocks', $params);
	}

	/**
	 * function to delete block
	 */
	function delete_block($id) {
		return $this->db->delete('blocks',array('id' => $id));
	}
}
