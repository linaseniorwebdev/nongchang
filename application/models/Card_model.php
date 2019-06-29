<?php

class Card_model extends CI_Model {

	/**
	 * Get card by id
	 * @param $id
	 * @return array
	 */
	public function get_card($id) {
		return $this->db->get_where('cards', array('id' => $id))->row_array();
	}

	/**
	 * Get card by id
	 * @param $user_id
	 * @return array
	 */
    public function get_default_card($user_id) {
        return $this->db->get_where('cards', array('user' => $user_id, 'last_used' => 1))->row_array();
    }

	/**
	 * Get all cards
	 * @param $user_id
	 * @return array
	 */
	public function get_all_cards($user_id) {
		$this->db->order_by('id', 'asc');
		return $this->db->get_where('cards', array('user' => $user_id))->result_array();
	}

	/**
	 * Function to add new card
	 * @param $params
	 * @return int
	 */
	public function add_card($params) {
		$this->db->insert('cards', $params);
		return $this->db->insert_id();
	}

	/**
	 * Function to update card
	 * @param $id
	 * @param $params
	 * @return bool
	 */
	public function update_card($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('cards', $params);
	}

	/**
	 * Function to delete card
	 * @param $id
	 * @return mixed
	 */
	public function delete_card($id) {
		return $this->db->delete('cards', array('id'=>$id));
	}

	/**
	 * Function to reset card status
	 * @param $id
	 * @return bool
	 */
    public function reset_lasted_used($id) {
        $this->db->where('user', $id);
        return $this->db->update('cards', array('last_used' => 0));
    }
}
