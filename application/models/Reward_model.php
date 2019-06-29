<?php

class Reward_model extends CI_Model {

	/**
	 * Get rewards by id
	 * @param $id
	 * @return array
	 */
	public function get_reward($id) {
		return $this->db->get_where('rewards', array('id' => $id))->row_array();
	}

	/**
	 * Get all rewards
	 */
	public function get_all_rewards() {
		$result = array();
		$rewards = $this->db->get('rewards')->result_array();
		foreach ($rewards as $reward) {
			$result[(int)$reward['id']] = $reward['values'];
		}
		return $result;
	}

	/**
	 * Function to update rewards
	 * @param $id
	 * @param $params
	 * @return bool
	 */
	public function update_reward($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('rewards', $params);
	}
}
