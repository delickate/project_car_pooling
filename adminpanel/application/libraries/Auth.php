<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth {
    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('session');
        $this->CI->load->database();
    }

    public function login($username, $password) {
        $this->CI->db->where('username', $username);
        $this->CI->db->where('user_type', 'ADMIN');
        $query = $this->CI->db->get('users'); //echo $this->CI->db->last_query();
        
        if ($query->num_rows() == 1) 
        	{   //echo "record found"; die();

	            $user = $query->row();
				//echo md5($password) ." = ". $user->password; die();
	            if (md5($password) == $user->password)
	            {	
	                $this->CI->session->set_userdata('logged_in', true);
	                $this->CI->session->set_userdata('user_id', $user->id);

	                return true;
	            }
	        }

        return false;
    }

    public function logout() {
        $this->CI->session->unset_userdata('logged_in');
        $this->CI->session->unset_userdata('user_id');
    }

    public function is_logged_in() {
        return $this->CI->session->userdata('logged_in') === true;
    }
}
