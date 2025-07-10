<?php
class Project_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getAllByUser($user_id) {
        return $this->db->get_where('projects', ['user_id' => $user_id])->result();
    }

    public function create($data) {
        return $this->db->insert('projects', $data);
    }

    public function find($id) {
        return $this->db->get_where('projects', ['id' => $id])->row();
    }

    public function update($id, $data) {
        return $this->db->update('projects', $data, ['id' => $id]);
    }
    
    public function delete($id) {
        return $this->db->delete('projects', ['id' => $id]);
    }
}