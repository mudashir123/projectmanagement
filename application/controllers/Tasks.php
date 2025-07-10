<?php
class Tasks extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library(['session']);
        if (!$this->session->userdata('user_id')) redirect('login');
        $this->load->model('Task_model');
    }

    public function store() {
        $title = $this->input->post('title');
        $project_id = $this->input->post('project_id');
        if ($title && $project_id) {
            $this->Task_model->create([
                'title' => $title,
                'project_id' => $project_id
            ]);
        }
    }

    public function delete($id) {
        $this->Task_model->update($id, ['deleted_at' => date('Y-m-d H:i:s')]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function update() {
        $id = $this->input->post('id');
        $title = $this->input->post('title');
        if ($id && $title) {
            $this->Task_model->update($id, ['title' => $title]);
        }
    }
}