<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LocationModel extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_all_locations($limit, $offset) {
        return $this->db->get('locations', $limit, $offset)->result();
    }

    public function count_locations() {
        return $this->db->count_all('locations');
    }

    public function insert_location($data) {
        return $this->db->insert('locations', $data);
    }

    public function get_location($id) {
        return $this->db->get_where('locations', ['id' => $id])->row();
    }

    public function update_location($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('locations', $data);
    }

    public function delete_location($id) {
        return $this->db->delete('locations', ['id' => $id]);
    }
}
