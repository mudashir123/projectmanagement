<?php
class Task_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    
    public function create($data) {
        return $this->db->insert('tasks', $data);
    }

    public function delete($id) {
        return $this->db->delete('tasks', ['id' => $id]);
    }

    public function getByProject($project_id) {
        return $this->db
            ->where('project_id', $project_id)
            ->where('deleted_at', null)
            ->get('tasks')
            ->result();
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update('tasks', $data);
    }

    public function deleteByProject($project_id) {
        return $this->db->where('project_id', $project_id)->update('tasks', ['deleted_at' => date('Y-m-d H:i:s')]);
    }
}