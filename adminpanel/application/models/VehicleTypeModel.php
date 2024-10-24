<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VehicleTypeModel extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_all_vehicle_types($limit, $offset) {
        return $this->db->get('vehicle_types', $limit, $offset)->result();
    }

    public function count_vehicle_types() {
        return $this->db->count_all('vehicle_types');
    }

    public function insert_vehicle_type($data) {
        return $this->db->insert('vehicle_types', $data);
    }

    public function get_vehicle_type($id) {
        return $this->db->get_where('vehicle_types', ['id' => $id])->row();
    }

    public function update_vehicle_type($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('vehicle_types', $data);
    }

    public function delete_vehicle_type($id) {
        return $this->db->delete('vehicle_types', ['id' => $id]);
    }
}
