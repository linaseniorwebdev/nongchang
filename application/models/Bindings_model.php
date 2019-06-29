<?php

class Bindings_model extends CI_Model {

	/**
	 * Get binding by land id - Frontend
	 * @param $land
	 * @return
	 */
	public function get_bindings_by_land($land) {
		$query = 'SELECT channels.* FROM channels, bindings WHERE bindings.channel = channels.id AND bindings.land = ' . $land . ' ORDER BY channels.id;';
		return $this->db->query($query)->result_array();
	}

	/**
	 * Get binding by land id - Backend
	 * @param $land
	 * @return
	 */
	public function get_bindings_by_land_back($land) {
		$this->db->order_by('id', 'asc');
		return $this->db->get_where('bindings', array('land' => $land))->result_array();
	}

	/**
	 * Get binding by id
	 * @param $id
	 * @return array
	 */
	public function get_binding($id) {
		$this->db->order_by('id', 'asc');
		return $this->db->get_where('bindings', array('id' => $id))->row_array();
	}

	/**
	 * Get all binding
	 */
	public function get_all_binding() {
		$this->db->order_by('id', 'asc');
		return $this->db->get('bindings')->result_array();
	}

	/**
	 * Function to add new binding
	 * @param $params
	 * @return int
	 */
	public function add_binding($params) {
		$this->db->insert('bindings', $params);
		return $this->db->insert_id();
	}

	/**
	 * Function to update binding
	 * @param $id
	 * @param $params
	 * @return bool
	 */
	public function update_binding($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('bindings', $params);
	}

	/**
	 * Function to delete binding by land
	 * @param $land
	 * @return mixed
	 */
	public function delete_bindings($land) {
		return $this->db->delete('bindings', array('land' => $land));
	}
}
