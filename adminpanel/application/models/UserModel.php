<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {
    public function insert_user($data) {
        return $this->db->insert('users', $data);
    }

    public function get_user_by_username($username) {
        return $this->db->get_where('users', ['username' => $username])->row();
    }
}
