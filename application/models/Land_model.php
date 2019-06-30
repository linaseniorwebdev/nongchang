<?php

class Land_model extends CI_Model {

	private $table, $column_order, $column_search, $order;

	/**
	 * Construct
	 */
	public function __construct() {
		parent::__construct();

		$this->table = 'lands';
		$this->column_order = array(null, 'id', 'map', 'landnum', 'type', 'block', 'detail', 'owner', 'sold_at');
		$this->column_search = array('landnum', 'detail');
		$this->order = array('id' => 'asc');
	}

	public function getRows($postData) {
		$this->_get_datatables_query($postData);
		if ($postData['length'] != -1) {
			$this->db->limit($postData['length'], $postData['start']);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function countAll() {
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function countFiltered($postData) {
		$this->_get_datatables_query($postData);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function _get_datatables_query($postData) {
		$this->db->from($this->table);
		$i = 0;
		foreach($this->column_search as $item) {
			// if datatable send POST for search
			if($postData['search']['value']){
				// first loop
				if ($i == 0) {
					$this->db->group_start();
					$this->db->like($item, $postData['search']['value']);
				} else {
					$this->db->or_like($item, $postData['search']['value']);
				}

				if (count($this->column_search) - 1 == $i) {
					$this->db->group_end();
				}
			}
			$i++;
		}

		if(isset($postData['order'])) {
			$this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
		} else if(isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	/**
	 * Get land by id
	 * @param $id
	 * @return array
	 */
	public function get_land($land_id) {
		return $this->db->get_where('lands', array('id' => $land_id))->row_array();
	}

	public function get_index_land() {
		$this->db->from('lands');
		$this->db->where('`intro` IS NOT NULL')->where('`owner` IS NULL')->limit(2);
		return $this->db->get()->result_array();
	}
	/**
	 * Get land by block id
	 * @param $block_id
	 * @param $land_type
	 * @return array
	 */
    public function get_block_lands($block_id, $land_type) {
        return $this->db->get_where('lands', array('block' => $block_id, 'type' => $land_type))->result_array();
    }

	/**
	 * Get all lands
	 * @param $user_id
	 * @return
	 */
	public function get_all_lands($user_id) {
		$query = 'SELECT lands.id, lands.landnum, land_type.value AS type, blocks.name AS block_name, blocks.description AS block_description, blocks.picture AS block_image, provinces.name AS province, lands.detail, lands.map, lands.sold_at FROM lands, land_type, blocks, provinces WHERE lands.type = land_type.id AND lands.block = blocks.id AND blocks.province = provinces.id AND lands.owner = ' . $user_id . ' ORDER BY lands.id;';
		return $this->db->query($query)->result_array();
	}

	public function get_sold_lands($user_id){
        $query = 'SELECT lands.id, lands.landnum, land_type.value AS type, blocks.name AS block_name, blocks.description AS block_description, blocks.picture AS block_image, provinces.name AS province, lands.detail, lands.map, lands.area, lands.sold_at FROM lands, land_type, blocks, provinces WHERE lands.type = land_type.id AND lands.block = blocks.id AND blocks.province = provinces.id AND lands.owner = ' . $user_id . ' And lands.sold_at IS NOT NULL ORDER BY lands.id;';
        return $this->db->query($query)->result_array();
    }
	/**
	 * Function to add new land
	 * @param $params
	 * @return int
	 */
	public function add_land($params) {
		$this->db->insert('lands', $params);
		return $this->db->insert_id();
	}

	/**
	 * Function to update land
	 * @param $id
	 * @param $params
	 * @return bool
	 */
	public function update_land($id, $params) {
		$this->db->where('id', $id);
		return $this->db->update('lands', $params);
	}

	/**
	 * Function to delete land
	 * @param $id
	 * @return mixed
	 */
	public function delete_land($id) {
		return $this->db->delete('lands', array('id' => $id));
	}
}
