<?php

class Destination_model extends CI_Model {

	/**
	 * Get destination by id
	 * @param $id
	 * @return array
	 */
	public function get_by_id($id) {
		return $this->db->get_where('destinations', array('id' => $id))->row_array();
	}

	/**
	 * Get destination by id
	 * @param $id
	 * @return array
	 */
	public function get_detail($id) {
		$query = 'SELECT destinations.id, provinces.name AS province, cities.name AS city, districts.name AS district, destinations.detail FROM destinations, provinces, cities, districts WHERE destinations.district = districts.id AND districts.city = cities.id AND cities.province = provinces.id AND destinations.id = ' . $id . ';';
		return $this->db->query($query)->row_array();
	}

	/**
	 * Get destinations and informations
	 * @param $user
	 * @return array
	 */
	public function get_destinations($user) {
		$query = 'SELECT destinations.id, destinations.receipt, destinations.phone, provinces.name AS province, cities.name AS city, districts.name AS district, destinations.detail, destinations.status FROM destinations, provinces, cities, districts WHERE destinations.province = provinces.id AND destinations.city = cities.id AND destinations.district = districts.id AND destinations.visible = 1 AND destinations.user = ' . $user . ' ORDER BY destinations.id;';
		return $this->db->query($query)->result_array();
	}

	public function get_default_destination($user){
        $query = 'SELECT destinations.id, provinces.name AS province, cities.name AS city, districts.name AS district, destinations.detail FROM destinations, provinces, cities, districts WHERE destinations.district = districts.id AND districts.city = cities.id AND cities.province = provinces.id AND destinations.user = ' . $user . ' AND destinations.status = 1;';
        return $this->db->query($query)->row_array();
    }
	/**
	 * Get all destinations
	 */
	public function get_all_destinations() {
		$this->db->order_by('id', 'asc');
		return $this->db->get('destinations')->result_array();
	}

	/**
	 * Function to add new destination
	 * @param $params
	 * @return int
	 */
	public function add_destination($params) {
		$this->db->insert('destinations', $params);
		return $this->db->insert_id();
	}

	/**
	 * Function to update destination
	 * @param $id
	 * @param $params
	 * @return bool
	 */
	public function update_destination($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('destinations', $params);
	}

	/**
	 * Function to delete destination
	 * @param $id
	 * @return mixed
	 */
	public function delete_destination($id) {
		return $this->db->delete('destinations', array('id' => $id));
	}

	/**
	 * Function to set all status to 0
	 * @param $user
	 * @return bool
	 */
	public function reset_status($user) {
		$this->db->where('user', $user);
		return $this->db->update('destinations', array('status' => 0));
	}
}
