<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RideDetailModel extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_all_ride_details($limit, $offset) {
        return $this->db->get('ride_detail', $limit, $offset)->result();
    }

    public function count_ride_details() {
        return $this->db->count_all('ride_detail');
    }

    public function insert_ride_detail($data) {
        return $this->db->insert('ride_detail', $data);
    }

    public function get_ride_detail($id) {
        return $this->db->get_where('ride_detail', ['id' => $id])->row();
    }

    public function update_ride_detail($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('ride_detail', $data);
    }

    public function delete_ride_detail($id) {
        return $this->db->delete('ride_detail', ['id' => $id]);
    }

    public function get_users_by_type($type) {
        return $this->db->get_where('users', ['type' => $type])->result();
    }

    public function get_locations() {
        return $this->db->get('locations')->result();
    }

    public function get_vehicle_types() {
        return $this->db->get('vehicle_types')->result();
    }
}
