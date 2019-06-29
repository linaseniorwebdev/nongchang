<?php

class Malls_model extends CI_Model {

	/**
	 * Get mall by user id
	 * @param $user_id
	 * @return array
	 */
	public function get_user_mall($user_id) {
		$this->db->order_by('id', 'asc');
		return $this->db->get_where('malls', array('owner' => $user_id))->row_array();
	}

	public function get_mall($id){
        $this->db->order_by('id', 'asc');
        return $this->db->get_where('malls', array('id' => $id))->row_array();
    }
	/**
	 * Get all withdraw
	 */
	public function get_all_malls() {
		$this->db->order_by('id', 'asc');
		return $this->db->get('malls')->result_array();
	}

	/**
	 * Function to add new withdraw
	 * @param $params
	 * @return int
	 */
	public function add_mall($params) {
		$this->db->insert('malls', $params);
		return $this->db->insert_id();
	}

	/**
	 * Function to update withdraw
	 * @param $id
	 * @param $params
	 * @return bool
	 */
	public function update_mall($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('malls', $params);
	}

	/**
	 * Function to delete withdraw
	 * @param $id
	 * @return mixed
	 */
	public function delete_mall($id) {
		return $this->db->delete('malls', array('id' => $id));
	}
}
