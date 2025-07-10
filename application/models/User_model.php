<?php
class User_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function getByEmail($email) {
        return $this->db->get_where('users', ['email' => $email])->row();
    }
    
    public function create($data) {
        return $this->db->insert('users', $data);
    }
}